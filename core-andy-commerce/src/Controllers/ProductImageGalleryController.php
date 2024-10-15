<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\ProductImageGalleryDataTable;
use AndyCommerce\Core\Services\ProductCoreService;
use AndyCommerce\Core\Services\ProductImageGalleryCoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductImageGalleryDataTable $dataTable)
    {

        $product = ProductCoreService::findOrFail($request->product);
        return $dataTable->render('vendor.products.image-gallery.index', compact(
            'product'
        ));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        ProductImageGalleryCoreService::store($request, Auth::user()->id);

        toastr('Uploaded Sucessfully..', 'success');

        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userrname,string $id)
    {
       $brand = ProductImageGalleryCoreService::findOrFail($id);

       $brand->delete();

       return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }
}
