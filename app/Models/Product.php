<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Subcategory;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SearchableTrait;
    use HasFactory;
    protected $guarded = [];

    public function subcategory() {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function categories(){
       return $this->belongsTo(Category::class, 'category_id');
    }

}
