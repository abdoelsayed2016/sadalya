<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
	public function product(){
		return $this->belongsTo('App\Product','product_id','id');
	}
	public function store(){
		return $this->belongsTo('App\Store','store_id','id');
	}
}
