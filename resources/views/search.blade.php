{{--
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Result of Search</h3>
            </div>

            <div class="col-md-4">
                <form action="{{route('search')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control form-group" type="text" placeholder=" Search from name">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-2">
                <a href="{{route('client.index')}}" class="btn btn-sm btn-success">Back to list</a>
            </div>

        </div>

        <table class="table table-hover table-sm">
            <tr>
                <th width="50px"><b>No.</b></th>
                <th width="300px"><b>Name</b></th>
                <th>Date of birth</th>
            </tr>

            @foreach ($clients as $client)

                <tr>
                    <td><b>{{++$i}}</b></td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->birthDate}}</td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection--}}
