@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Group list</h3>
            </div>
            <div class="col-md-4">
                <form action="{{route('group.index', ['name' => 'name'])}}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control form-control-sm form-group" name="name" type="text"
                                   placeholder=" Search from name">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-2">
                <a href="{{route('group.create')}}" class="btn btn-sm btn-success">Register new group</a>
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
                    <th width="200px"><b>Name</b></th>
                    <th><b>Description</b></th>
                    <th width="150px"><b>Client quantity</b></th>
                    <th width="100px"><b>Admin</b></th>
                    <th width="150px"><b>Actions</b></th>
                </tr>
                @foreach($groups as $group)

                    <tr>
                        <td>{{$group->name}}</td>
                        <td>{{$group->description}}</td>
                        <td>{{$group->client_quantity}}</td>
                        <td>{{$group->admin}}</td>
                        <td>
                            <form action="{{route('group.destroy', $group->id)}}" method="post">
                                <a class="btn btn-sm btn-light" href="{{route('group.show', $group->id)}}"><i
                                            class="far fa-eye"></i></a>
                                <a class="btn btn-sm btn-light" href="{{route('group.edit', $group->id)}}"><i
                                            class="far fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-light"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
        {!! $groups->links() !!}
        <div class="col-md-12" align="center">
            <a class="btn btn-sm btn-success" href="{{route('client.index')}}">Show clients</a>
        </div>
    </div>


@endsection