<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Requests\StoreProduct;
use App\Product;
use App\ProductDetail;
use App\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
	public function index()
	{
		$products = Product::all();
		////
		return view('admin.products.index', compact('products'));

	}//end of index

	public function create()
	{
		$categoies=Category::all();
		$product_types=ProductType::all();
		return view('admin.products.create',compact('categoies','product_types'));

	}//end of create

	public function store(StoreProduct $request)
	{
		$product=new Product();
		$product->name=$request->name;
		$product->price=$request->price;
		$product->product_type_id='';
		$product->company=$request->company;
		$product->origin=$request->origin;
		$product->discount=$request->discount;
		$product->concentrate=$request->concentrate;
		$product->category_id=$request->category_id;
		$product->type_id=$request->type_id;
		$product->save();
//		$i=0;
		if($request->count && $request->date)
		{
			foreach ($request->count as $k=>$c){
				$productDetail=new ProductDetail();
				$productDetail->product_id=$product->id;
				$productDetail->count=$c;
				$productDetail->date=$request->date[$k];
				$productDetail->save();
			}
		}
		return redirect()->route('products.index');

	}//end of store

	public function edit(Product $product)
	{
		$categoies=Category::all();
		$product_types=ProductType::all();
		$productDetails=$product->productDetail;
		return view('admin.products.edit', compact('product_types','categoies','product','productDetails'));

	}//end of edit

	public function update(StoreProduct $request, Product $product)
	{
		$product->name=$request->name;
		$product->price=$request->price;
		$product->product_type_id='';
		$product->company=$request->company;
		$product->origin=$request->origin;
		$product->discount=$request->discount;
		$product->concentrate=$request->concentrate;
		$product->category_id=$request->category_id;
		$product->type_id=$request->type_id;
		$product->save();
		$product->productDetail()->delete();
		if($request->count && $request->date)
		{
			foreach ($request->count as $k=>$c){
				$productDetail=new ProductDetail();
				$productDetail->product_id=$product->id;
				$productDetail->count=$c;
				$productDetail->date=$request->date[$k];
				$productDetail->save();
			}
		}
		return redirect()->route('products.index');

	}//end of update
	public function show(Product $product){
		$productdetails=$product->productDetail;
		return view('admin.products.show',compact('product','productdetails'));
	}
	public function destroy(Category $category)
	{
		$category->delete();
		return redirect()->route('categories.index');

	}//end of destroy
	public function outdate(){
		$date_month=date('Y-m-d', strtotime('+1 months'));
//		dd($date_month);
		$productdetails=ProductDetail::whereDate('date','<=',$date_month)->get();
		return view('admin.products.outdate',compact('productdetails'));
	}
	public function count(){
//		$date_month=date('Y-m-d', strtotime('+1 months'));
//		dd($date_month);
		$products=Product::all();
		$counts=[];
		foreach ($products as $prdouct)
		{
			if(! $prdouct->productDetail->isEmpty())
			{
				$sum=$prdouct->productDetail->sum('count');
				$counts[]=$sum;
			}
			else{
				$counts[]=0;
			}
		}
		return view('admin.products.count',compact('products','counts'));
	}

}
