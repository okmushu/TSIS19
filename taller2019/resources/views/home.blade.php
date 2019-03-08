@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div id="movie-list">
                @foreach($movies as $movie)
                    <div class="movie-item col-md-10 pull-left panel panel-default">
                        <div class="panel-body">
                            <!--imagen-->
                            @if(Storage::disk('images')->has($movie->image))
                                <div class="movie-image-thumb col-md-3 pull-left">
                                    <div class="movie-image-mask">
                                        <img src="{{ url('/image/'.$movie->image)}}" class="movie-image"/>
                                    </div>
                                </div>
                            @endif
                            <div class="data">
                                <h4 class="movie-title"><a href=" {{ route('detailMovie', ['movie_id' => $movie->id]) }}"> {{$movie->title}} </a></h4>
                                <p>{{$movie->user->name.' '.$movie->user->surname}}</p>
                            </div>

                            <!--Botones de accion-->
                            <a href="{{ route('detailMovie', ['movie_id' => $movie->id]) }}" class="btn btn-success">Ver</a>
                            @if(Auth::check() && Auth::user()->id == $movie->user->id)
                                <a href="{{ route('movieEdit', ['movie_id' => $movie->id]) }}" class="btn btn-warning">Editar</a>

                                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                <a href="#kevinModal{{$movie->id}}" role="button" class="btn btn-primary" data-toggle="modal">Eliminar</a>

                                <!-- Modal / Ventana / Overlay en HTML -->
                                <div id="kevinModal{{$movie->id}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">¿Estás seguro?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Seguro que quieres borrar esta imagen?</p>
                                                <p class="text-warning"><small>{{$movie->title}}</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <a href="{{ url('/delete-movie/'.$movie->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{$movies->links()}}

    </div>
</div>
@endsection