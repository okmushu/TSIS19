<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', array(
    'as' => 'home',
    'uses' => 'HomeController@index'
));
//Rutas del controlador de Movies
Route::get('/crear-movie',array(
        'as' => 'createMovie',
        'middleware' => 'auth',
        'uses' => 'MovieController@createMovie'
));
Route::post('/guardar-pelicula',array(
    'as' => 'saveMovie',
    'middleware' => 'auth',
    'uses' => 'MovieController@saveMovie'
));
Route::get('/image/{filename}', array(
    'as' => 'imageMovie',
    'uses' => 'MovieController@getImage'
));
Route::get('/movie/{movie_id}', array(
    'as' => 'detailMovie',
    'uses' => 'MovieController@getMovieDetail'
));
Route::get('/movie-file/{filename}', array(
    'as' => 'fileMovie',
    'uses' => 'MovieController@getMovie'
));
Route::get('delete-movie/{movie_id}', array(
    'as' => 'movieDelete',
    'middleware' => 'auth',
    'uses' => 'MovieController@delete'
));
Route::get('editar-movie/{movie_id}', array(
    'as' => 'movieEdit',
    'middleware' => 'auth',
    'uses' => 'MovieController@edit'
));
Route::post('/update-movie/{movie_id}',array(
    'as' => 'updateMovie',
    'middleware' => 'auth',
    'uses' => 'MovieController@update'
));
Route::get('/editar-user/{user_id}', array(
    'as' => 'userEdit',
    'middleware' => 'auth',
    'uses' => 'UserController@edit'
));
Route::post('/update-user/{user_id}',array(
    'as' => 'updateUser',
    'middleware' => 'auth',
    'uses' => 'UserController@update'
));
Route::get('/canal/{user_id}', array(
    'as' => 'channel',
    'uses' => 'UserController@channel'
));
Route::get('/list', array(
    'as' => 'list',
    'uses' => 'UserController@list'
));
// Cache
Route::get('/clear-cache', function(){
    $code = Artisan::call('cache:clear');
});
Route::get('delete-user/{user_id}', array(
    'as' => 'userDelete',
    'middleware' => 'auth',
    'uses' => 'UserController@delete'
));

Route::get('/buscar/{search?}/{filter?}', [
    'as' => 'movieSearch',
    'uses' => 'MovieController@search'
]);
