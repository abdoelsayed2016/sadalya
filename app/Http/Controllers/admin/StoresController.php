<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\StoreStores;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoresController extends Controller
{
	public function index()
	{
		$stores = Store::all();
		return view('admin.stores.index', compact('stores'));

	}//end of index

	public function create()
	{
		return view('admin.stores.create');

	}//end of create

	public function store(StoreStores $request)
	{
		$store = new Store();
		$store->name = $request->name;
		$store->address = $request->address;
		$store->save();

		return redirect()->route('stores.index');

	}//end of store

	public function edit(Store $store)
	{
		return view('admin.stores.edit', compact('store'));

	}//end of edit

	public function update(StoreStores $request, Store $user)
	{
		$store = new Store();
		$store->name = $request->name;
		$store->address = $request->address;
		$store->save();
		return redirect()->route('stores.index');

	}//end of update

	public function destroy(Store $store)
	{
		$store->delete();
		return redirect()->route('stores.index');

	}//end of destroy

}
