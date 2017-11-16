<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\StoreDelegates;
use App\Http\Requests\StoreProduct;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DelegatesController extends Controller
{
	public function index()
	{
		$users = User::where('admin',2)->get();
//		dd($users);
		return view('admin.delegates.index', compact('users'));

	}//end of index

	public function create()
	{
		$stores=Store::all();
		return view('admin.delegates.create',compact('stores'));

	}//end of create

	public function store(StoreDelegates $request)
	{
		$user = new User();
		$user->name = $request->name;
		$user->password = bcrypt($request->password);
		$user->store_id=$request->store_id;
		$user->email=$request->email;
		$user->admin=2;
		$user->save();

		return redirect()->route('delegates.index');

	}//end of store

	public function edit(User $user)
	{
//		dd($user);
		$stores=Store::all();

		return view('admin.delegates.edit', compact('user','stores'));

	}//end of edit

	public function update(StoreDelegates $request, User $user)
	{
		$user->name = $request->name;
		$user->password = bcrypt($request->password);
		$user->store_id=$request->store_id;
		$user->email=$request->email;
		$user->admin=2;
		$user->save();
		return redirect()->route('delegates.index');

	}//end of update

	public function destroy(User $user)
	{
		$user->delete();
		return redirect()->route('delegates.index');

	}//end of destroy

}
