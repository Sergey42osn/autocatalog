<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model extends Model
{
    protected $fillable = ['id_brand','name'];

    public function catalog()
    {
    	return $this->hasMany('App\Detail');
    }
}
