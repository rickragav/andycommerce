<?php

namespace AndyCommerce\Core\Services;

use AndyCommerce\Core\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Str;

class ProductVariantItemCoreService {

    public function __construct() {

    }

    public static function store(Request $request)

    {

        $request->validate([
            'variant_id' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->variation_id = $request->variant_id;
        if ($request->variant_id == 2) {
            $variantItem->color_code = $request->color_code;
        }
        $variantItem->name = $request->name;
        $variantItem->save();
    }

    public static function update(Request $request, string $username, string $id)
    {
        $request->validate([
            
            'name' => ['required', 'max:200'],
        ]);

        $variantItem =  ProductVariantItem::findOrFail($id);
        $variantItem->name = $request->name;
        $variantItem->save();

        return $variantItem;
    }

    public static function edit(string $id){
        return null;
    }

    public static function findOrFail(string $id){
        return ProductVariantItem::findOrFail($id);
    }


     // Get All Categories For Shopper
     public static function getAllCategoriesByShopperId(string $shopperId)
     {
         
     }

     // Get All Categories
    public static function getAllCategories()
    {
        
    }

    
}