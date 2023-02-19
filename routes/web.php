<?php

use App\Http\Livewire\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\filterCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});
// Route::group([
//     'prefix=>LaravelLocalization::setLocale()',
//     'middleware'=>['auth', 'verified','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
// ], function () {
//     Route::get('/dashboard', function () {
//         return view('welcome');
//     })->name('dashboard');
//  });

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');


//categories
// Route::group(
// [
//  'prefix=>LaravelLocalization::setLocale()',
// 'middleware'=>['role:admin','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
// ],
// function () {
Route::get('lang/change', [CategoryController::class, 'change'])->name('changeLang');
Route::get('/categories',[CategoryController::class,'index'])->name('categories');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
Route::post('/categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
Route::get('/categories/Add',[CategoryController::class,'create'])->name('categories.create');
Route::any('/categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::any('/categories/delete/{id}',[CategoryController::class,'destroy'])->name('categories.delete');

// sub categories
    Route::get('lang/change', [SubCategoryController::class, 'change'])->name('changeLang');
    Route::get('/sub_categories',[SubCategoryController::class,'index']);
    Route::get('featchData',[SubCategoryController::class,'featchData']);
    Route::get('edit/{id}',[SubCategoryController::class,'edit']);
    Route::put('update/{id}',[SubCategoryController::class,'update']);
    Route::delete('delete/{id}',[SubCategoryController::class,'destroy']);
    Route::post('sub_categories',[SubCategoryController::class,'store']);
    // end sub category

// });


//start product
    Route::get('lang/change', [productController::class, 'change'])->name('changeLang');
    Route::resource('products', productController::class);
    //Route::get('deleteing/{id}',[productController::class,'destroy'])->name('delete');
    Route::get('/section/{id}', [productController::class, 'getsubcategories']);
//end product


// Route::get('/products', function () {
//     return view('products');
// })->name('products');
// filter category
//Route::any('/filter_categories',[filterCategoryController::class,'index'])->name('filter_categories');
//end fillter category

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
