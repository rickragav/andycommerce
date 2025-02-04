<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\ProductVariantDataTable;
use AndyCommerce\Core\Models\ProductVariantItem;
use AndyCommerce\Core\Services\ProductCoreService;
use AndyCommerce\Core\Services\ProductVariantCoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        //$product = ProductCoreService::findOrFail($request->product);
        return $dataTable->render('vendor.products.product-variant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.products.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,  ProductVariantDataTable $dataTable)
    {
        ProductVariantCoreService::store($request, Auth::user()->id);

        toastr('Created Sucessfully..', 'success', 'success');

        return $dataTable->render('vendor.products.product-variant.index');
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
        $variant = ProductVariantCoreService::findOrFail($id);

        return view('vendor.products.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, string $id)
    {
        $variant = ProductVariantCoreService::update($request, $username, Auth::user()->id, $id);

        toastr('Updated Sucessfully..', 'success', 'success');

        return redirect()->route('vendor.products-variant.index', ['username' => Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userrname, string $id)
    {
        $variant = ProductVariantCoreService::findOrFail($id);

        $variantItemCheck = ProductVariantItem::where('variation_id', $variant->id)->count();

        if ($variantItemCheck > 0) {
            return response(['status' => 'error', 'message' => 'This variant contain variant items in it delete the variant items first for delete this variant!']);
        }

        $variant->delete();

        return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariantCoreService::findOrFail($request->id);

        $variant->status = $request->status == 'true' ? 1 : 0;

        $variant->save();

        return response(['status' => 'success', 'message' => 'Status has been updated Succuessfully!']);
    }
}
