<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['id_model','name', 'code', 'price_new', 'price_old'];

     public function brand()
    {
    	return $this->belongsTo('App\Model');
    }
}
