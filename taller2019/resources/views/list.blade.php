@extends('layouts.app')

<div id="users-list">
    @if(count($users) >= 1)
    @foreach($users as $user)
        <div class="user-item col-md-10 pull-left panel panel-default">
            <div class="panel-body">
                <div class="data">
                    <h4 class="movie-title">{{$user->name}}</h4>
                    <p>{{$user->email}}</p>
                </div>
                
                <!--BOTONES DE ACCIÓN-->
                <a class="btn btn-success">Ver</a>
                @if(\Auth::user()->id==$user->id)
                    <a href="{{ route('userEdit', ['user_id' => $user->id]) }}" class="btn btn-warning">Editar</a>

                    <a href="#KevinModal{{$user->id}}" role="button" class="btn btn-primary" data-toggle="modal">Eliminar</a>
                 
                    <!-- Modal / Ventana / Overlay en HTML -->
                    <div id="KevinModal{{$user->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Seguro que quieres borrar este user?</p>
                                    <p class="text-warning"><small>{{$user->name}}</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ url('/delete-user/'.$user->id)}}" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    @else
        <div class="alert alert-warning">No hay users actualmente!!</div>
    @endif

    <div class="clearfix"></div>
</div>