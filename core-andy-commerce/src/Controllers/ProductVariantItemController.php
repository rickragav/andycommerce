<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\ProductVariantItemDataTable;
use AndyCommerce\Core\Services\ProductCoreService;
use AndyCommerce\Core\Services\ProductVariantCoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $datatables, $username, $productId, $variantId)
    {
        $product = ProductCoreService::findOrFail($productId);

        $variant = ProductVariantCoreService::findOrFail($variantId);

        return $datatables->render('vendor.products.product-variant-item.index', compact('product', 'variant'));
    }
}
