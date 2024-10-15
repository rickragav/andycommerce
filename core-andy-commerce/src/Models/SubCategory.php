<?php

namespace AndyCommerce\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function childCategories(){
        return $this->hasMany(childCategory::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
