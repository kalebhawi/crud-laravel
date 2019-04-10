<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Client;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $groups = Group::latest()->name($request->name)->paginate(10);
        return view('group.index', compact('groups'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function show($id)
    {
        $group = Group::find($id);
        return view('group.detail', compact('group'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
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

        return redirect()->route('client.index')
            ->with('success', 'New client created successfully');
    }

}
