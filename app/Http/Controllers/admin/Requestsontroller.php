<?php

namespace App\Http\Controllers\admin;

use App\StoreProduct;
use App\RequestManger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Requestsontroller extends Controller
{
	public function index()
	{
		$requestMangers=RequestManger::all();
		return view('admin.requests.index', compact('requestMangers'));

	}//end of index
	public function accept(RequestManger $request){

		$products=$request->product;
		$request_count=[];
		$i=0;
		foreach($products as $product)
		{
			$request_count[]=$request->requestProducts()->where('product_id',$product->id)->get()->sum('count');
			$product_count=$product->productDetail->sum('count');
			if($product_count<$request_count[$i])
				return redirect()->back()->withErrors(['the requests quantities are less than available']);

			$i++;
		}
		$j=0;
		foreach($products as $product)
		{
			$count=$request_count[$j];
			$productDetails=$product->productDetail()->orderby('date')->get();
//			dd($productDetails);
			$x=0;
			foreach ($productDetails as $productDetail)
			{
				$current_count=$productDetail->count;
				$x+=$current_count;
				if($x>$count)
				{
					$t=$x-$count;
					$productDetail->count=$t;
					$productDetail->save();
					break;
				}elseif($x<$count)
				{
					$productDetail->delete();
				}else{
					$productDetail->delete();
				break;
				}
			}
			$storeProduct=StoreProduct::where('product_id',$product->id)->where('store_id',$request->store_id)->first();
//			dd($storeProduct);
			if($storeProduct)
			{
				$storeProduct->count+=$count;
				$storeProduct->save();
			}else
			{
				$sp=new StoreProduct();
				$sp->product_id=$product->id;
				$sp->store_id=$request->store_id;
				$sp->count=$count;
				$sp->save();

			}
		}

		$request->read=1;
		$request->save();
		return redirect()->back();

	}
}
