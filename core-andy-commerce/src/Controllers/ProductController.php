<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\ProductDataTable;
use AndyCommerce\Core\Facades\Product;
use AndyCommerce\Core\Models\Brand;
use AndyCommerce\Core\Models\Category;
use AndyCommerce\Core\Models\ChildCategory;
use AndyCommerce\Core\Models\SubCategory;
use AndyCommerce\Core\Services\ProductCoreService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('shopper_id', Auth::user()->id)->get();
        $brands = Brand::where('shopper_id', Auth::user()->id)->get();
        return view('vendor.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        ProductCoreService::store($request, Auth::user()->id);

        toastr('Created Sucessfully..', 'success');

        return redirect()->route('vendor.products.index', ['username' => Auth::user()->username]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username, string $id)
    {
        $product = ProductCoreService::findOrFail($id);
        $subCategories = SubCategory::where('shopper_id', Auth::user()->id)
            ->where('category_id', $product->category_id)
            ->get();
        $childCategories = ChildCategory::where('shopper_id', Auth::user()->id)
            ->where('sub_category_id', $product->sub_category_id)
            ->get();
        $categories = Category::where('shopper_id', Auth::user()->id)->get();
        $brands = Brand::where('shopper_id', Auth::user()->id)->get();
        return view('vendor.products.edit', compact('product', 'categories', 'subCategories', 'childCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, string $id)
    {
        ProductCoreService::update($request, $username, Auth::user()->id, $id);

        toastr('Updated Sucessfully..', 'success');

        return redirect()->route('vendor.products.index', ['username' => Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get all product sub categories
     */

    public function getSubCategories(Request $request)
    {
        $subCategory = SubCategory::where('category_id', $request->id)->get();
        return $subCategory;
    }

    public function getChildCategories(Request $request)
    {
        $childCategory = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childCategory;
    }
}
