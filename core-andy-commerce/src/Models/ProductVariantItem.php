<?php

namespace AndyCommerce\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function productVariant(){
        return $this->belongsTo(ProductVariant::class,'variation_id');
    }
}
