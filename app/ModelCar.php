<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCar extends Model
{
		protected $table = 'model_cars';

     public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function catalog()
    {
    	return $this->hasMany('App\Detail');
    }
}
