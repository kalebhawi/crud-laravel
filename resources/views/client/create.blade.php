@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>New Client</h3>
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

        <form action="{{route('client.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <strong>Name</strong>
                    <input type="text" name="name" class="form-control" placeholder="Ex.: Mohamed Alsharif" required
                           required minlength="3" maxlength="32">
                </div>

                <div class="col-md-6">
                    <strong>CPF</strong>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="Ex.: 000.000.000-00"
                           required minlength="11" maxlength="14">
                </div>

                <div class="col-md-6">
                    <strong>Date of birth</strong>
                    <input type="date" name="birthDate" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <strong>Address</strong>
                    <input type="text" name="address" class="form-control" placeholder="Ex.: Rua Bento Gonçalves, 0000"
                           required>
                    <hr>
                </div>

                <div class="col-md-6">
                        <strong>Group</strong>
                        <select class="form-control form-control-md" name="group_id" id="group_id">
                            @foreach($groups as $group)
                                @if($group->client_quantity >= ($group->clientsInGroup)) {{--TODO: mostrar somente grupos com quantity < maximo--}}
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endif
                            @endforeach
                        </select>
                </div>

                <div class="col-md-12">
                    <hr>
                    <strong>Phones</strong>
                    <div class="row" id="phone-form">
                        <div class="col-md-2">
                             DDD
                            <input class="form-control" type="text" name="ddd[]" placeholder="Ex.: 51">
                        </div>
                        <div class="col-md-6">
                             Number
                            <input class="form-control" type="text" name="number[]"
                                   placeholder="Ex.: 9 9999-9999">
                        </div>
                        <div class="col-md-3">
                             Type
                            <select name="type[]" class="form-control">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                                <option value="Mobile">Mobile</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                             Add
                            <button type="button" id="add-row" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i></button>
                        </div>
                        <br>
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

    <script>
        $(document).ready(function () {
            $("#add-row").click(function () {
                $("#phone-form").append("<div class='col-md-12'>"+
                    "<div class='row' id=''>"+
                    "<div class='col-md-2'>"+
                    "<input class='form-control' type='text' name='ddd[]'placeholder='Ex.: 51'>" +
                    "</div>"+
                    "<div class='col-md-6'>" +
                    "<input class='form-control' type='text' name='number[]' placeholder='Ex.: 9 9999-9999'>" +
                    "</div>"+
                    "<div class='col-md-3'>" +
                    "<select name='type[]' class='form-control'>"+
                    "<option value='home'>Home</option>" +
                    "<option value='work'>Work</option>"+
                    "<option value='mobile'>Mobile</option>"+
                    "</select>"+
                    "</div>"+
                    "<div class='col-md-1'>"+
                    "<button type='button' onclick='$(this).parent().parent().remove();' id='btnDelete' class='btn btn-danger'><i class=\"fas fa-minus-circle\"></i></button>"+
                    "</button>"+
                    " </div>"+
                    " </div>"+
                    " </div>");
            });
        });
    </script>

@endsection