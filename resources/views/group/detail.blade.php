@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Group detail</h3>
                    </div>

                    <div class="col-lg-6">
                        <h3>Clients in group</h3>
                    </div>
                </div>
                <hr>
            </div>
        </div>

       <div class="row">
           <div class="col-lg-6">
               <div class="col-md-12">
                   <div class="form-group">
                       <strong>Name : </strong> {{$groups->name}}
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <strong>Description : </strong> {{$groups->description}}
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <strong>Client quantity (max) : </strong> {{$groups->client_quantity}}
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                       <strong>Administrator : </strong> {{$admin->name}}
                   </div>
               </div>
           </div>
           <div class="panel-body col-lg-6">
               <ul class="list-group">
                   @foreach($groups->client as $client)
                       <div>
                               <form id="unlinkUser" action="" method="post">
                                   <a href="{{route('client.show', $client->id)}}" class="list-group-item list-group-item-action">
                                       {{$client->name}}
                                       @if($client->name == $admin->name)
                                           (Admin)
                                           <button disabled class="btn btn-sm btn-light"><i class="far fa-trash-alt"></i></button>
                                       @else
                                           <button class="btn btn-sm btn-light"><i class="far fa-trash-alt"></i></button>
                                       @endif
                                   @csrf
                                   @method('PATCH')
                               </form>
                           </a>
                       </div>
                   @endforeach
               </ul>
           </div>
       </div>
        <br>
        <div class="col-md-12" align="center">
            <a href="{{route('group.index')}}" class="btn btn-sm btn-success">Back</a>
        </div>
    </div>

    <script>
        $( document ).ready(function() {
            $('#unlinkUser').submit(function() {
                var c = confirm("Do you really want unlink this user?");
                return c;
            });
        });

    </script>
@endsection