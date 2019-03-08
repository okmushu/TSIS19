<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    protected  $table = 'movies';
    //Relacion Uno a Muchos
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    //Relacion Muchos a Uno
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    use SoftDeletes;
    protected $dates = ['deletedat'];
    protected $fillable = ['user_id','title','description','image'];
}
