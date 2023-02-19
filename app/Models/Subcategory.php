<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    public $timestamps = true;
    protected $fillable = array('name','category_id');

    public function category() {return $this->belongsTo(Category::class,'category_id');}
    public function products() {return $this->hasMany(Product::class,'subcategory_id');}
}
