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
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();
    }

    public static function update(Request $request, string $username, string $id)
    {
        $request->validate([
            
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantItem =  ProductVariantItem::findOrFail($id);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
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