<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='posts';
    protected $fillable = [
        'title','content','image','users_id','categorys_id'
    ];


    //relacion de uno a muchos inversa
    public function user(){

        return $this->belongsTo('App\User','user_id');
    }

    public function category(){

        return $this->belongsTo('App\models\Category','category_id');
    }
}

