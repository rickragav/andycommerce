<?php

namespace AndyCommerce\Core\Services;

use AndyCommerce\Core\Models\ProductImageGallery;
use Illuminate\Http\Request;
use Str;

class ProductImageGalleryCoreService
{
    public function __construct() {}

    public static function store(Request $request, $shopper_id)
    {
        $imagePaths = []; // Declare the array

        // Custom validation rule for comma-separated URLs
        $request->validate([
            'image' => [
                'required',
                function ($attribute, $value, $fail) use (&$imagePaths) { // Use the array in the closure
                    // Splitting the value into individual URLs
                    $urls = explode(',', $value);

                    foreach ($urls as $url) {
                        $url = trim($url); // Trim any surrounding spaces
                        // Validate each URL using PHP's filter_var()
                        if (!filter_var($url, FILTER_VALIDATE_URL)) {
                           // $fail("The {$attribute} contains an invalid URL: {$url}");
                        }

                        // Add valid URLs to the imagePaths array
                        $imagePaths[] = $url;
                    }
                },
                'max:3000'
            ],
        ]);

        // Now imagePaths will contain the valid URLs
        foreach ($imagePaths as $imagePath) {
            $productImageGalley = new ProductImageGallery();
            $productImageGalley->shopper_id = $shopper_id;
            $productImageGalley->image = $imagePath;
            $productImageGalley->product_id = $request->product;
            $productImageGalley->save();
        }
    }


    public static function update(Request $request, string $username, string $shopper_id, string $id) {}

    public static function edit(string $id)
    {
        return null;
    }

    public static function findOrFail(string $id){
        return ProductImageGallery::findOrFail($id);
    }

    // Get All Categories For Shopper
    public static function getAllCategoriesByShopperId(string $shopperId) {}

    // Get All Categories
    public static function getAllCategories() {}
}
