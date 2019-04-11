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
        $groups = Group::name($request->name)->paginate(10);
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
        return view('group.create', compact('clients', 'admins'));
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



        return redirect()->route('group.index')
            ->with('success', 'New group created successfully');
    }
}
