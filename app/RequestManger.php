<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestManger extends Model
{
    protected $table='requests';
    public function product(){
    	return $this->belongsToMany('App\Product','request_products','request_id','product_id');
    }
	public function requestProducts(){
		return $this->hasMany('App\RequestProduct','request_id','id');
	}
	public function user(){
		return $this->belongsTo('App\User','user_id','id');
	}
	public function store(){
		return $this->belongsTo('App\Store','store_id','id');
	}
}
