<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Phone;
use App\Group;
use DB;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::with('group')->name($request->name)->paginate(10);
        //dd($clients);
        return view('client.index', compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::orderBy('name')->get();
        return view('client.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'birthDate' => 'required',
            'address' => 'required',
            'group_id' => 'required',
            'ddd' => 'required',
            'number' => 'required',
            'type' => 'required',
        ]);
        //dd($request->name, $request->cpf, $request->birthDate, $request->address,$request->ddd, $request->type, $request->number);
        $client = Client::create($request->only('name', 'cpf', 'birthDate', 'address', 'group_id'));
        $phones = [];

        for ($i = 0; $i < count($request->ddd); $i++) {
            $phones[$i] = [
                'ddd' => $request->ddd[$i],
                'number' => $request->number[$i],
                'type' => $request->type[$i]
            ];
            // array_push($phones, [$request->ddd[$i], $request->number[$i], $request->type[$i]]);
        }

        $client->phones()->createMany($phones);

        return redirect()->route('client.index')
            ->with('success', 'New client created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::with('phones', 'group')->find($id);
        return view('client.detail', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = Group::orderBy('name')->get();
        $client = Client::with('phones', 'group')->find($id);
        return view('client.edit', compact('client', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'birthDate' => 'required',
            'address' => 'required'
        ]);
        $client = Client::with('phones')->find($id);
        $client->name = $request->get('name');
        $client->cpf = $request->get('cpf');
        $client->birthDate = $request->get('birthDate');
        $client->address = $request->get('address');

        $phones = [];
        for ($i = 0; $i < count($request->ddd); $i++) {
            $phone = null;
            if (isset($request->id_phone[$i])) {
                $phone = Phone::find($request->id_phone[$i]);
            } else {
                $phone = new Phone();
            }

            $phone->ddd = $request->ddd[$i];
            $phone->number = $request->number[$i];
            $phone->type = $request->type[$i];

            array_push($phones, $phone);
        }

        $old_phones = DB::select('select * from phones where client_id = ?', [$id]);
        if (count($phones) < count($old_phones)) {
            DB::delete('delete from phones where client_id = ?', [$id]);

            $phones = [];
            for ($i = 0; $i < count($request->ddd); $i++) {
                $phones[$i] = [
                    'ddd' => $request->ddd[$i],
                    'number' => $request->number[$i],
                    'type' => $request->type[$i]
                ];
            }
            $client->phones()->createMany($phones);
        } else {
            $client->phones()->saveMany($phones);
        }
        $client->save();
        return redirect()->route('client.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id)
    {
        Client::destroy($id);
        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }
}
