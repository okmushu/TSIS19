<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\User;
use App\Movie;



class UserController extends Controller
{
    public function channel($user_id){
    	$user = User::find($user_id);

    	if(!is_object($user)){
    		return redirect()->route('home');
    	}

    	$movies = Movie::where('user_id',$user_id)->paginate(5);

    	return view('user.channel', array(
    		'user' => $user,
    		'movies' => $movies
    	));
    }

        public function update($user_id, Request $request){
        $validatedData = $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = \Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->update();
        return redirect()->route('home')->with(array('message' => 'El usuario se ha actualizado correctamente'));
    }

    public function edit($id){
        $user = \Auth::user();
        return view('edit', array(
            'user' => $user
        ));
    }

    public function list()
    {
        $users = User::all();
        return view('list', array(
            'users' => $users 
        ));
    }
    public function delete($user_id){
        $user =  \Auth::user();
        $user_id = \Auth::user()->id;
        if($user_id == \Auth::user()->id){
            $user->delete();
            $message = array('message' => 'Imagen eliminada');
        }else{
            $message = array('message' => 'Imagen no eliminada');
        }
        return redirect()->route('home')->with($message);
    }
}