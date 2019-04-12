<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Client;
use DB;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $groups = Group::with('client')->name($request->name)->paginate(10);
        return view('group.index', compact('groups'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function show($id)
    {
        $admin = Group::admin($id);
        $groups = Group::with('client')->find($id);
        return view('group.detail', compact('groups', 'admin'));
    }

    public function create()
    {
        $clients = Client::with('group')->orderBy('name')->get();
        //dd($clients[0]->group->admin);
        return view('group.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'client_quantity' => 'required',
            'admin' => 'required',
        ]);
        Group::create($request->only('name', 'description', 'client_quantity', 'admin'));

        $idGroup = Group::select('id')
            ->where('name', $request->name)
            ->first();

        DB::table('clients')
            ->where('id', $request->admin)
            ->update(array('group_id' => $idGroup['id']));

        return redirect()->route('group.index')
            ->with('success', 'New group created successfully');
    }

    public function edit($id)
    {
        $admin = Group::admin($id);
        $clients = Client::with('group')->orderBy('name')->get();
        $group = Group::with('client')->find($id);
        return view('group.edit', compact('group', 'admin', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'client_quantity' => 'required',
            'admin' => 'required',
        ]);
        $group = Group::with('client')->find($id);
        $group->name = $request->get('name');
        $group->description = $request->get('description');
        $group->client_quantity = $request->get('client_quantity');
        $group->admin = $request->get('admin');
        $group->save();

        return redirect()->route('group.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy($id)
    {
        Group::destroy($id);
        return redirect()->route('group.index')
            ->with('success', 'Group deleted successfully');
    }


    public static function unlinkUser($id)
    {
        $client = Client::find($id);
        $client->group_id = 0;
        $client->save();
    }
}
