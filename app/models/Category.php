<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categorys';
    protected $fillable = [
        'name'
    ];

    //relacion de uno a miuchos
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }
}
