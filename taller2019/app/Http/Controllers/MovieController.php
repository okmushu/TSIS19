<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Movie;
use App\Comment;


class MovieController extends Controller
{
    public function createMovie(){
        return view('movie.createMovie');
    }
    public function saveMovie(Request $request){
        $validatedData = $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $movie = new Movie();
        $user = \Auth::user();
        $movie->user_id = $user->id;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        //Subida de la miniatura
        $image = $request->file('image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $movie->image = $image_path;
        }
        //Subida del video
        $movie->save();
        return redirect()->route('home')->with(array(
            'message'=> 'La imagen se ha subido correctamente'
        ));
    }
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 400);
    }
    public function delete($movie_id){
        $user = \Auth::user();
        $movie = Movie::find($movie_id);
        if($user && $movie->user_id == $user->id){
            $movie->delete();
            $message = array('message' => 'Imagen eliminada');
        }else{
            $message = array('message' => 'Imagen no eliminada');
        }
        return redirect()->route('home')->with($message);
    }
    public function edit($id){
        $user = \Auth::user();
        $movie = Movie::findOrFail($id);
        if($user && $movie->user_id == $user->id){
            return view('movie.edit', array('movie' => $movie));
        }else{
            return redirect()->route('home');
        }
    }
    public function getMovieDetail($movie_id){
        $movie = Movie::find($movie_id);
        return view('movie.detail', array(
            'movie' => $movie
        ));
    }
    public function update($video_id, Request $request){
    	$validatedData = $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
        $movie = new Movie();
        $user = \Auth::user();
        $movie->user_id = $user->id;
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        //Subida de la miniatura
        $image = $request->file('image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $movie->image = $image_path;
        }
        $movie->update();
        return redirect()->route('home')->with(array('message' => 'La imagen se ha actualizado correctamente'));
    }
}