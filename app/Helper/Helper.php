<?php

use App\Models\Category;
use Illuminate\Support\Facades\File;

 function uploadImage($imageRequest){
        $image = $imageRequest->image;
        $image_name = time() . '.' . $image->extension();
        $imageRequest->image->move(public_path('images'), $image_name);
        $filename = $imageRequest->hashName();
        return  $filename;

    }

 function updateImage($request,$categories){
    if($request->hasFile('image')){
        $destenations = 'images/' . $categories->image;
        if(File::exists($destenations)){
            File::delete($destenations);
        }
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename=time().'.'.$extention;
        $file->move('images/' . $filename);
    }
    return $filename;
 }


  function categories(){
    $catgories = Category::all();
    return $catgories;
}
