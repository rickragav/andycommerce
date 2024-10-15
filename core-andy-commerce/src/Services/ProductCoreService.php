<?php

namespace AndyCommerce\Core\Services;

use AndyCommerce\Core\Models\Product;
use Illuminate\Http\Request;
use Str;

class ProductCoreService
{
    public function __construct() {}

    public static function store(Request $request, $shopper_id)
    {
        $request->validate([
            // Required Core Details
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
        
            // Descriptions
            'short_description' => ['required'],
            'long_description' => ['required'],
        
            // Media
            'image' => ['', 'required'],
        
            // Product Features
            'is_variant'=> ['required'],
            'status' => ['required'],
        
            // SEO Metadata
            'meta_title' => ['nullable', 'max:200'],
            'meta_description' => ['nullable', 'max:250'],
            'meta_image' => ['nullable', ''],
        ]);
        

        $product = new Product();

        // Identification and Ownership
        $product->shopper_id = $shopper_id; // Shopper's ID
        $product->thumb_image = $request->image; // Thumbnail image
        $product->slug = Str::slug($request->name); // Slug for the product
        
        // Basic Product Details
        $product->name = $request->name; // Product name
        $product->category_id = $request->category; // Category ID
        $product->sub_category_id = $request->sub_category; // Sub-category ID
        $product->child_category_id = $request->child_category; // Child category ID
        $product->brand_id = $request->brand; // Brand ID
        
        // Pricing and Inventory
        $product->price = $request->price; // Regular price
        $product->offer_price = $request->offer_price; // Offer price
        $product->offer_start_date = $request->offer_start_date; // Offer start date
        $product->offer_end_date = $request->offer_end_date; // Offer end date
        $product->qty = $request->qty; // Quantity available
        
        // Descriptions
        $product->short_description = $request->short_description; // Short description
        $product->long_description = $request->long_description; // Long description
        $product->video_link = $request->video_link; // Video link
        $product->sku = $request->sku; // SKU (Stock Keeping Unit)
        
        // Product Features
        $product->product_feature_type = $request->product_feature_type; // Product feature type
        $product->is_variant = $request->is_variant; // Is this product a variant?
        $product->is_approved = 1; // Approval status
        
        // SEO Metadata
        $product->meta_title = $request->seo_title; // SEO title
        $product->meta_description = $request->seo_description; // SEO description
        $product->meta_image = $request->meta_image; // SEO meta image
        
        // Status
        $product->status = $request->status; // Product status
        
        // Save the Product
        $product->save();
        
    }

    public static function update(Request $request, string $username, string $shopper_id, string $id)
    {
        $request->validate([
            // Required Core Details
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
        
            // Descriptions
            'short_description' => ['required'],
            'long_description' => ['required'],
        
            // Media
            'image' => ['', 'nullable'],
        
            // Product Features
            'is_variant'=> ['required'],
            'status' => ['required'],
        
            // SEO Metadata
            'meta_title' => ['nullable', 'max:200'],
            'meta_description' => ['nullable', 'max:250'],
            'meta_image' => ['nullable', ''],
        ]);

        $product = Product::findOrFail($id);
        // Identification and Ownership
        $product->shopper_id = $shopper_id; // Shopper's ID
        $product->thumb_image = empty(!$request->image) ? $request->image : $product->thumb_image; // Thumbnail image
        $product->slug = Str::slug($request->name); // Slug for the product
        
        // Basic Product Details
        $product->name = $request->name; // Product name
        $product->category_id = $request->category; // Category ID
        $product->sub_category_id = $request->sub_category; // Sub-category ID
        $product->child_category_id = $request->child_category; // Child category ID
        $product->brand_id = $request->brand; // Brand ID
        
        // Pricing and Inventory
        $product->price = $request->price; // Regular price
        $product->offer_price = $request->offer_price; // Offer price
        $product->offer_start_date = $request->offer_start_date; // Offer start date
        $product->offer_end_date = $request->offer_end_date; // Offer end date
        $product->qty = $request->qty; // Quantity available
        
        // Descriptions
        $product->short_description = $request->short_description; // Short description
        $product->long_description = $request->long_description; // Long description
        $product->video_link = $request->video_link; // Video link
        $product->sku = $request->sku; // SKU (Stock Keeping Unit)
        
        // Product Features
        $product->product_feature_type = $request->product_feature_type; // Product feature type
        $product->is_variant = $request->is_variant; // Is this product a variant?
        $product->is_approved = 1; // Approval status
        
        // SEO Metadata
        $product->meta_title = $request->seo_title; // SEO title
        $product->meta_description = $request->seo_description; // SEO description
        $product->meta_image = empty(!$request->meta_image) ? $request->meta_image : $product->meta_image; // SEO meta image
        
        // Status
        $product->status = $request->status; // Product status
        
        // Save the Product
        $product->save();
    }

    public static function edit(string $id)
    {
        return null;
    }

    public static function findOrFail(string $id)
    {
        return Product::findOrFail($id);
    }

    // Get All Categories For Shopper
    public static function getAllCategoriesByShopperId(string $shopperId) {}

    // Get All Categories
    public static function getAllCategories() {}
}
