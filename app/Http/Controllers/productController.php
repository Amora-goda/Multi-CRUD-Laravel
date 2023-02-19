<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class productController extends Controller
{

    public function __construct()
{
   $this->middleware('role:admin')->except(['index','create']);

}

public function change(Request $request)
{
    App::setLocale($request->lang);
    session()->put('locale', $request->lang);

    return redirect()->back();
}

    public function index()
    {
                $products = Product::with('subcategory','categories')->get();
                return view('products.index', compact('products'));

    }


    public function create()
    {
        $categories = Category::all();
        return view('products.create',compact('categories'));

    }

    public function getsubcategories($id){
        $subcategories = DB::table("subcategories")->where("category_id", $id)->pluck("name", "id");
        //dd($products);
        return json_encode($subcategories);
    }


    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'price' => 'required|numeric',
            'subcategory'=>'required|exists:subcategories,id',
            'category'=>'required|exists:categories,id',
            'image'=>'nullable|mimes:jpeg,png,jpg',
        ]);

            $image = $request->image;
            $image_name = time() . '.' . $image->extension();
            $request->image->move(public_path('images'), $image_name);

            Product::create([
                'name' => $request->name,
                'category_id'=>$request->category,
                'subcategory_id'=>$request->subcategory,
                'price'=>$request->price,
                'image' => 'images/' . $image_name,
            ]);
             return redirect('products')->with(['success' => 'تم ألاضافة بنجاح']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::all();

        $product =  Product::with('subcategory')->findOrFail($id);
        //dd($id);
        return view('products.edit', compact('product','categories'));

    }


    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => ['required', Rule::unique('products', 'id')->ignore($request->name)],
            'subcategory'=>'required|exists:subcategories,id',
            'category'=>'required|exists:categories,id',
            'image'=>'nullable|mimes:jpeg,png,jpg',
        ]);
        $product = Product::find($id);

        // $image = updateImage($request, $product);
        if ($request->image != '') {
            if ($product->image != ''  && $product->image != null) {
                $file_old = $product->image;
                unlink($file_old);
            }
            $image = $request->image;
            $image_new = time() . '.' . $image->extension();
            $request->image->move(public_path('images'), $image_new);
            $product->update(['image' => 'images/' . $image_new]);
        }

        $product->update([
            'name' => $request->name,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->subcategory,
            'price'=>$request->price,
        ]);

        return redirect('/products')->with('success', 'Product Edit Successfully');

    }


    public function destroy($id)
    {

        $imagePath = Product::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {

            unlink($filePath);

            Product::where('id', $id)->delete();
           // dd(123);
        } else {

            Product::where('id', $id)->delete();
        }

        return redirect('/products')->with('success', 'Product deleted Successfully');

    }
}
