<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
	public function index()
	{
		$categories = Category::all();
		////
		return view('admin.categories.index', compact('categories'));

	}//end of index

	public function create()
	{
		return view('admin.categories.create');

	}//end of create

	public function store(StoreCategory $request)
	{
		$category = new Category();
		$category->name = $request->name;
		$category->save();

		return redirect()->route('categories.index');

	}//end of store

	public function edit(Category $category)
	{
		return view('admin.categories.edit', compact('category'));

	}//end of edit

	public function update(StoreCategory $request, Category $category)
	{
		$category->name = $request->name;
		$category->save();

		return redirect()->route('categories.index');

	}//end of update

	public function destroy(Category $category)
	{
		$category->delete();
		return redirect()->route('categories.index');

	}//end of destroy

}
