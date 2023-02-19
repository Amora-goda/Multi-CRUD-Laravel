<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\filterCategory;
use Illuminate\Http\Request;


class filterCategoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $keyword = $request->has('keyword') ? $request->get('keyword') : null;
    //     $selected_price = $request->has('price') ? $request->get('price') : null;
    //     $selected_category = $request->has('category') ? $request->get('category') : null;


    //     $categories = filterCategory::all();

    //     $products = Product::with(['category']);

    //     if ($keyword != null){
    //         $products = $products->search($keyword);
    //     }

    //     if ($selected_price != null) {
    //         $products = $products->when($selected_price, function ($query) use ($selected_price){
    //            if ($selected_price == 'price_0_500') {
    //                $query->whereBetween('price', [0, 500]);
    //            } elseif ($selected_price == 'price_501_1500') {
    //                $query->whereBetween('price', [501, 1500]);
    //            } elseif ($selected_price == 'price_1501_3000') {
    //                $query->whereBetween('price', [1501, 3000]);
    //            } elseif ($selected_price == 'price_3001_5000') {
    //                $query->whereBetween('price', [3001, 5000]);
    //            }
    //         });
    //     }

    //     if ($selected_category != null) {
    //         $products = $products->whereCategoryId($selected_category);
    //     }


    //     $products = $products->orderByDesc('id');
    //     $products = $products->paginate(9);

    //     return view('filter.filterCategory', compact('products', 'categories','keyword', 'selected_price', 'selected_category'));
    // }



}
