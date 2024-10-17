<?php

namespace AndyCommerce\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }


    public function productVariantItems(){
        return $this->hasMany(ProductVariantItem::class);
    }
}
