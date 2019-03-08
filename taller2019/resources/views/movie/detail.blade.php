@extends('layouts.app')

@section('content')
    <div class="col-md-11 col-md-offset-1 pull-right">
        <h2>{{$movie->title}}</h2>
        <hr/>

        <div class="panel panel-default video-data">
            <div class="panel-heading">
                <div class="panel-title">
                    Subido por <strong>{{$movie->user->name}}</strong> el {{ \FormatTime::LongTimeFilter($movie->created_at) }}
                </div>
            </div>
            <div class="panel-body">
                {{$movie->description}}
            </div>
        </div>

    </div>
@endsection