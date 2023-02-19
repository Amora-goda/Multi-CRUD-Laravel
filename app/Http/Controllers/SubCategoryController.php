<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
use WithPagination;
public function index()
{
    $categories = Category::all();
    $subcategories = Subcategory::with('category')->get();
    return view('subcategory.subcategory', compact('subcategories','categories'));
}

public function featchData()
{
    $subcategories = Subcategory::latest('id')->with('category')->get();
    return response()->json([
        'subcategories' => $subcategories,
    ]);
}

public function store(Request $request)
{
    $this->validate($request, [
        'name' => 'required|string',
        'category_id' => 'required|numeric',
    ]);
    Subcategory::create([
        'name' => $request->name,
        'category_id'=>$request->category_id,
    ]);
        return response()->json([
            'status' => 200,
            'msg' => 'saved succssefully...'
        ]);
}


public function show($id)
{
    //
}

public function edit($id)
{
    $subcategories =Subcategory::with('category')->find($id);
    return response()->json([
        'subcategories' => $subcategories,
    ]);
}


public  function update(Request $request,$id)
{

    $subcategories = Subcategory::find($id);


    //update data
    $subcategories->update([
        'name' => $request->name,
        'category_id'=>$request->category_id,
    ]);

    return response()->json([
        'status' => true,
        'msg' => 'updated sucssefully',
    ]);
}
public function change(Request $request)
{
    App::setLocale($request->lang);
    session()->put('locale', $request->lang);

    return redirect()->back();
}


public function destroy(Request $request)
{
    $subcategories = Subcategory::find($request->id);
    $subcategories->delete();
    if ($subcategories) {
        return response()->json([
            'status' => true,
            'msg' => 'deleted succssefully...'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'msg' => 'faild to delete...'
        ]);
    }
}
}
