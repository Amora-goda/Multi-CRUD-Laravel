<?php

namespace App\Models;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function subcategories(){ return $this->hasMany(Subcategory::class, 'category_id'); }
     public function products() {return $this->hasMany(Product::class, 'category_id');}
}
