<?php

namespace App\Http\Controllers\manger;

use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Product;
use App\RequestManger;
use App\RequestProduct;
use App\StoreProduct;

class RequestsController extends Controller
{
	public function index()
	{
		$requestMangers=RequestManger::where('user_id',auth()->user()->id)->get();
		return view('manger.requests.index', compact('requestMangers'));

	}//end of index

	public function create()
	{
		$products=Product::all();

		return view('manger.requests.create',compact('products'));
	}//end of create

	public function store(StoreRequest $request)
	{
		$requestManger=new RequestManger();
		$requestManger->read=0;
		$requestManger->user_id=auth()->user()->id;
		$requestManger->store_id=auth()->user()->store->id;

		$requestManger->save();
//		dd($requestManger);
		foreach ($request->product_id as $k=>$product_id)
		{
			$count=($request->count);
			$requestProduct=new RequestProduct();
			$requestProduct->product_id=$product_id;
			$requestProduct->count=$count[$k];
			$requestProduct->request_id=$requestManger->id;
			$requestProduct->save();
		}

		return redirect()->route('requests.index');

	}//end of store


	public function destroy(RequestManger $request)
	{
		$request->requestProducts()->delete();
		$request->delete();
		return redirect()->route('requests.index');

	}//end of destroy
	public function show(RequestManger $request){

		$requestProducts=$request->requestProducts;
		return view('manger.requests.show',compact('request','requestProducts'));

	}
	public function storeProduct(){
		$storeProducts=StoreProduct::where('store_id',auth()->user()->store_id)->get();
		return view('manger.stores.index',compact('storeProducts'));
	}

}
