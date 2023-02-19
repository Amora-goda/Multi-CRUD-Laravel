<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\App as FacadesApp;

class CategoryController extends Controller
{


    public function index()
    {
        // $categories = Subcategory::with('category')->get();
        $categories = Category::all();
        //    dd($categories);
        return view('category.category', compact('categories'));
    }

    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $image = $request->image;
            $image_name = time() . '.' . $image->extension();
            $request->image->move(public_path('images'), $image_name);
            Category::create([
                'name' => $request->name,
                'image' => 'images/' . $image_name,
            ]);

            DB::commit();
            return redirect()->route('categories')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {

        $categories =  Category::findOrFail($id);
        // dd($categories);
        return view('category.edit', compact('categories'));
    }

    public function update(CategoryRequest $request, $id)
    {


        $categories = Category::find($id);

        // $image = updateImage($request, $categories);
        if ($request->image != '') {
            if ($categories->image != ''  && $categories->image != null) {
                $file_old = $categories->image;
                unlink($file_old);
            }
            $image = $request->image;
            $image_new = time() . '.' . $image->extension();
            $request->image->move(public_path('images'), $image_new);
            $categories->update(['image' => 'images/' . $image_new]);
        }
        $categories->update([
            'name' => $request->name,

        ]);

        return redirect('/categories')->with('success', 'Category Edit Successfully');
    }

    public function destroy($id)
    {

        $imagePath = Category::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {

            unlink($filePath);

            Category::where('id', $id)->delete();

        } else {

            Category::where('id', $id)->delete();
        }

        return redirect('/categories')->with('success', 'Category deleted Successfully');
    }
}
