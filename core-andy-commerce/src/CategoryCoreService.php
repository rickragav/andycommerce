<?php

namespace AndyCommerce\Core;

use AndyCommerce\Core\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Str;

class CategoryCoreService {

    public function __construct() {

    }

    public static function store(Request $request, $shopper_id)
    {
        $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'banner'=>['nullable','url'],
            'name' => [
                'required',
                'max:200',
                // Add unique validation where name is unique for the vendor_id
                Rule::unique('categories')->where(function ($query) use ($shopper_id) {
                    return $query->where('shopper_id', $shopper_id);
                }),
            ],
            'status' => ['required'],
        ]);




        $category = new Category();
        $category->shopper_id = $shopper_id;
        $category->banner = $request->banner;
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        $category->save();

        return $category;
    }

    public static function update(Request $request, string $username, string $shopper_id, string $id)
    {
        
        
        
        $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'banner'=>['nullable','url'],
            Rule::unique('categories')
                ->where(function ($query) use ($shopper_id) {
                    return $query->where('shopper_id', $shopper_id);
                })
                ->ignore($id),
            'status' => ['required'],
        ]);

        $category = Category::findOrFail($id);
       
        $category->shopper_id = $shopper_id;
        $category->banner = empty(!$request->banner) ? $request->banner: $category->banner;
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        return $category->save();
    }

    public static function findOrFail(string $id){
        return Category::findOrFail($id);
    }


     // Get All Categories For Shopper
     public static function getAllCategoriesByShopperId(string $shopperId)
     {
         try {
             $categories = Category::with([
                 'subCategories.childCategories' => function ($query) {
                     $query->where('status', 1); // Applies to both subCategories and childCategories
                 },
             ])
                 ->where('shopper_id', $shopperId)
                 ->where('status', 1)
                 ->get();
 
             // Return a standardized JSON response
             return response()->json([
                 'status' => 'success',
                 'data' => $categories,
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Failed to retrieve categories.',
                 'error' => $e->getMessage(),
             ]);
         }
     }

     // Get All Categories
    public static function getAllCategories()
    {
        try {
            $categories = Category::with('subCategories.childCategories')->get();

            // Return a standardized JSON response
            return response()->json([
                'status' => 'success',
                'data' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve categories.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    
}