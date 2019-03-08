<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    protected $table = 'comments';
    //Relacion Muchos a Uno
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    use SoftDeletes;
    protected $dates = ['deletedat'];
}
