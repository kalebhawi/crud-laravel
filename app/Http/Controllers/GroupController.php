<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

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
}
