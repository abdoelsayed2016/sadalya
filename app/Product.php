<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productDetail(){
	    return $this->hasMany('App\ProductDetail','product_id','id');
    }
	public function category(){
		return $this->belongsTo('App\Category','category_id','id');
	}
	public function type(){
		return $this->belongsTo('App\Type','type_id','id');
	}

}
