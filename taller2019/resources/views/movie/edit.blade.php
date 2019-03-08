@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar {{$movie->title}}</h2>
            <hr/>
            <form action="{{ route('updateMovie', ['movie_id' => $movie->id]) }}" method="post" enctype="multipart/form-data" class="col-lg-7">
                {!! csrf_field() !!}

                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" pattern="[A-Za-z0-9 ]+" value="{{$movie->title}}"/>
                </div>

                <div class="form-group">
                    <label for="title">Descripcion</label>
                    <textarea class="form-control" id="description" name="description" pattern="[A-Za-z0-9]+ " value="{{$movie->description}}"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Imagen</label>
                    @if(Storage::disk('images')->has($movie->image))
                        <div class="video-image-thumb">
                            <div class="video-image-mask">
                                <img src="{{ url('/image/'.$movie->image)}}" class="video-image"/>
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control" id="image" name="image" accept="image/*"/>
                </div>

                <button type="submit" class="btn btn-success">Modificar Pelicula</button>
            </form>
        </div>
    </div>
@endsection