<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\ProductVariantItemDataTable;
use AndyCommerce\Core\Services\ProductCoreService;
use AndyCommerce\Core\Services\ProductVariantCoreService;
use AndyCommerce\Core\Services\ProductVariantItemCoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $datatables, $username, $variantId)
    {
        

        $variant = ProductVariantCoreService::findOrFail($variantId);

        return $datatables->render('vendor.products.product-variant-item.index', compact( 'variant'));
    }

    public function store(Request $request)
    {
        ProductVariantItemCoreService::store($request);

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('vendor.products-variant-item.index', ['username' => Auth::user()->username, 
        
        'variantId' => $request->variant_id]);
    }

    public function create($username, $productId, $variantId)
    {
        $variant = ProductVariantCoreService::findOrFail($variantId);

        $product = ProductCoreService::findOrFail($productId);

        return view('vendor.products.product-variant-item.create', compact('variant', 'product'));
    }

    public function edit($username, $variantItemId)
    {
        $variantItem = ProductVariantItemCoreService::findOrFail($variantItemId);
        return view('vendor.products.product-variant-item.edit', compact('variantItem'));
    }

    public function update(Request $request, $username, $variantItemId)
    {
        $variantItem = ProductVariantItemCoreService::update($request, $username, $variantItemId);

        toastr('Updated Successfully!', 'success', 'success');

        

        return redirect()->route('vendor.products-variant-item.index', ['username' => Auth::user()->username, 'variantId' => $variantItem->variation_id]);
    }

    public function destroy($username, $variantItemId){
        $variantItem = ProductVariantItemCoreService::findOrFail($variantItemId);
        $variantItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }

    public function changeStatus(Request $request)
    {
        $variantItem = ProductVariantItemCoreService::findOrFail($request->id);

        $variantItem->status = $request->status == 'true' ? 1 : 0;

        $variantItem->save();

        return response(['status' => 'success', 'message' => 'Status has been updated Succuessfully!']);
    }
}
