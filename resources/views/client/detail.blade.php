@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Client detail</h3>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Name : </strong> {{$client->name}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>CPF : </strong> {{$client->cpf}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Birth date : </strong> {{$client->birthDate}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>Address : </strong> {{$client->address}}
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <strong>Group:</strong> @if(!empty($client->group)) {{$client->group['name']}} - <a href="{{route('group.show', $client->group['id'])}}">More info</a> @endif
            </div>

            <div class="col-md-12">
                <hr>
                <div class="form-group">
                        <strong>Phones : </strong><br>
                        @foreach($client->phones as $phone)
                            <i class="fas fa-circle" style="color: green"></i>
                            ( {{$phone['ddd']}} ) {{$phone['number']}} - {{$phone['type']}} <br>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <a href="{{route('client.index')}}" class="btn btn-sm btn-success">Back</a>
                </div>
            </div>
        </div>
@endsection