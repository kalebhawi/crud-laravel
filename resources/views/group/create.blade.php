@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>New Group</h3>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Whooops!</strong> there where some problems with your input. <br>
                <ul>
                    @foreach($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('group.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <strong>Name</strong>
                    <input type="text" name="name" class="form-control" placeholder="Ex.: Admin's Group" required
                           required minlength="3" maxlength="32">
                </div>

                <div class="col-md-12">
                    <strong>Description</strong>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Ex.: Group for admins" required>
                </div>

                <div class="col-md-6">
                    <strong>Client quantity</strong>
                    <input type="number" name="client_quantity" class="form-control" placeholder="Ex.: 10" required>
                </div>

                <div class="col-md-6">
                    <strong>Admin</strong>

                    <select class="form-control form-control-md" name="admin" id="admin" required>

                        <option selected value="">Select an administrator</option>

                    @foreach($clients as $client)
                        @if( $client->id  != $client->group->admin)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endif
                    @endforeach
                        <option value="" disabled>If haven't users, register one</option>
                    </select>
                </div>

                <div class="col-md-12" align="center">
                    <br>
                    <a href="{{route('group.index')}}" class="btn btn-sm btn-success">Back</a>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection