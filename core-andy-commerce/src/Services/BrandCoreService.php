<?php

namespace AndyCommerce\Core\Services;

use AndyCommerce\Core\Models\Brand;
use Illuminate\Http\Request;
use Str;

class BrandCoreService
{
   

    public function __construct()
    {
    }

    public static function store(Request $request, $shopper_id)
    {
        $request->validate([
            "logo"=> ['','required','max:2000'],
            'name'=> ['required','max:200'],
            'is_featured'=> ['required'],
            'status'=> ['required']
        ]);
        $brand = new Brand();

        $brand->logo = $request->logo;
        $brand->name = $request->name;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->shopper_id = $shopper_id;
        $brand->slug = Str::slug($request->name);
        $brand->save();
        
    }

    public static function update(Request $request, string $shopper_id, string $id)
    {
        $request->validate([
            "logo"=> ['url','max:2000'],
            'name'=> ['required','max:200'],
            'is_featured'=> ['required'],
            'status'=> ['required']
        ]);
        $brand = Brand::findOrFail($id);

        $brand->logo = empty(!$request->logo) ? $request->logo: $brand->logo;
        $brand->name = $request->name;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->shopper_id = $shopper_id;
        $brand->slug = Str::slug($request->name);
        $brand->save();

        return $brand;
    }

    public static function edit(string $id){
        return Brand::findOrFail($id);
    }

    

    public static function findOrFail(string $id){
        return Brand::findOrFail($id);
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
