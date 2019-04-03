@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Edit Client</h3>
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

        <form action="{{route('client.update',$client->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <strong>Name</strong>
                    <input type="text" name="name" class="form-control" value="{{$client->name}}">
                </div>
                <div class="col-md-6">
                    <strong>CPF</strong>
                    <input name="cpf" class="form-control" placeholder="CPF" value="{{$client->cpf}}">
                </div>

                <div class="col-md-6">
                    <strong>Date of birth</strong>
                    <input type="date" name="birthDate" class="form-control" placeholder="Date of birth"
                           value="{{$client->birthDate}}">
                </div>

                <div class="col-md-12">
                    <strong>Address</strong>
                    <input type="text" name="address" class="form-control" placeholder="Address"
                           value="{{$client->address}}">
                </div>

                <div class="col-md-12">
                    <strong>Phones</strong><br>
                    <div class="row">
                        <div class="col-md-2">
                            <strong>DDD</strong>
                        </div>
                        <div class="col-md-6">
                            <strong>Number</strong>
                        </div>
                        <div class="col-md-3">
                            <strong>Type</strong>
                        </div>
                    </div>
                    <div class="col-md-12" id="phones">
                        @foreach($client->phones as $phone)
                            <input type="hidden" id="id_phone[]" name="id_phone[]" value="{{$phone['id']}}">
                            <div class="row col-md-12" id="phone-form">
                                <div class="col-md-2">
                                    <input type="text" name="ddd[]" class="form-control" placeholder="ddd"
                                           value="{{$phone['ddd']}}">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="number[]" class="form-control" placeholder="number"
                                           value="{{$phone['number']}}">
                                </div>
                                <div class="col-md-3">
                                    <select name="type[]" class="form-control">
                                        <option value="{{$phone['type']}}">{{$phone['type']}}</option>
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                        <option value="Mobile">Mobile</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type='button' onclick='$(this).parent().parent().remove();' id='btnDelete'
                                            class="btn btn-sm btn-light"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <br>
                            Add Phone
                            <button type="button" id="add-row" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="col-md-12" align="center">
                        <br>
                        <a href="{{route('client.index')}}" class="btn btn-sm btn-success">Back</a>
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </div>
        </form>

    </div>
    {{--FUNCIONANDO !!--}}
    <script>
        $(document).ready(function () {
            $("#add-row").click(function () {
                $("#phones").append("<div class='row col-md-12'>" +
                    "<div class='col-md-2'>" +
                    "<input class='form-control' type='text' name='ddd[]'placeholder='Ex.: 51'>" +
                    "</div>" +
                    "<div class='col-md-6'>" +
                    "<input class='form-control' type='text' name='number[]' placeholder='Ex.: 9 9999-9999'>" +
                    "</div>" +
                    "<div class='col-md-3'>" +
                    "<select name='type[]' class='form-control'>" +
                    "<option value='home'>Home</option>" +
                    "<option value='work'>Work</option>" +
                    "<option value='mobile'>Mobile</option>" +
                    "</select>" +
                    "</div>" +
                    "<div class='col-md-1'>" +
                    "<button type='button' onclick='$(this).parent().parent().remove();' id='btnDelete' class=\"btn btn-sm btn-light\"><i class=\"far fa-trash-alt\"></i></button>" +
                    "</button>" +
                    " </div>" +
                    " </div>");
            });
        });
    </script>
@endsection