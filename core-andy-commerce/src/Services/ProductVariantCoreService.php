<?php

namespace AndyCommerce\Core\Services;

use AndyCommerce\Core\Models\ProductVariant;
use Illuminate\Http\Request;
use Str;

class ProductVariantCoreService
{
    public function __construct()
    {
    }

    public static function store(Request $request, $shopper_id)
    {
        $request->validate([
            'product' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'status' => ['required'],
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->shopper_id = $shopper_id;
        $productVariant->save();

    }

    public static function update(Request $request, string $username, string $shopper_id, string $id)
    {
        $request->validate([
            
            'name' => ['required', 'max:200'],
            'status' => ['required'],
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;
        $productVariant->shopper_id = $shopper_id;
        $productVariant->save();

        return $productVariant;
    }

    public static function edit(string $id)
    {
        return null;
    }

    public static function findOrFail(string $id)
    {
        return ProductVariant::findOrFail($id);
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
