@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Client list</h3>
            </div>

            <div class="col-md-4">
                <form action="{{route('client.index', ['name' => 'name'])}}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control form-control-sm form-group" name="name" type="text" placeholder=" Search from name">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-2">
                <a href="{{route('client.create')}}" class="btn btn-sm btn-success">Register new client</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div id="alertMsg" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$message}}
                <button type="button" class="close" id="btnClose" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <table class="table table-hover table-sm">
            <tr>
                <th width="50px"><b>No.</b></th>
                <th width="300px"><b>Name</b></th>
                <th>Date of birth</th>
                <th>Group</th>
                <th width="180px"><b>Action</b></th>
            </tr>

            @if (!count($clients))
                <tr>
                    <td colspan="3">No clients found</td>
                    <td><a class="btn btn-sm btn-dark" href="{{route('client.index')}}">Show all clients</a></td>
                </tr>
            @endif

            @foreach ($clients as $client)

                <tr>
                    <td><b>{{++$i}}</b></td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->birthDate}}</td>
                    <td>{{$client->group->name}}</td>
                    <td>
                        <form action="{{route('client.destroy', $client->id)}}" method="post">
                            <a class="btn btn-sm btn-light" href="{{route('client.show', $client->id)}}"><i class="far fa-eye"></i></a>
                            <a class="btn btn-sm btn-light" href="{{route('client.edit', $client->id)}}"><i class="far fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $clients->links() !!}
        <div class="col-md-12" align="center">
            <a class="btn btn-sm btn-success" href="{{route('group.index')}}">Show groups</a>
        </div>
    </div>
@endsection