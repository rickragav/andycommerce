<?php

// Vendor Routes

use AndyCommerce\Core\Controllers\BrandController;
use AndyCommerce\Core\Controllers\CategoryController;
use AndyCommerce\Core\Controllers\ChildCategoryController;
use AndyCommerce\Core\Controllers\ProductController;
use AndyCommerce\Core\Controllers\ProductImageGalleryController;
use AndyCommerce\Core\Controllers\ProductVariantController;
use AndyCommerce\Core\Controllers\ProductVariantItemController;
use AndyCommerce\Core\Controllers\SliderController;
use AndyCommerce\Core\Controllers\SubCategoryController;
use AndyCommerce\Core\Controllers\VendorProfileController;
use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('{username}')->group(function () {


    // Dashboard Route
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');


    // Profile
    Route::resource('/profile', VendorProfileController::class);

    // // Dashboard Route
    // Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

    // Slider Resource Route
    Route::resource('/slider', SliderController::class);

    // Category Routes
    Route::put('/category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('/category', CategoryController::class);

    // Subcategory Routes
    Route::put('/subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
    Route::resource('/sub-category', SubCategoryController::class);

    // Child Category Routes
    Route::put('/childcategory/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
    Route::get('/get-subcategory', [ChildCategoryController::class, 'getSubCategories'])->name('get-subCategories');
    Route::resource('/child-category', ChildCategoryController::class);

    // Brand Routes
    Route::put('/brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
    Route::resource('/brand', BrandController::class);

    // Product Routes
    Route::get('/product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
    Route::get('/product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
    Route::put('/product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
    Route::resource('/products', ProductController::class);

    // Product Image Gallery
    Route::resource('/products-image-gallery', ProductImageGalleryController::class);

    // Product Variant
    Route::put('/products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
    Route::resource('/products-variant', ProductVariantController::class);


    // Product Variant Item
    Route::get('/products-variant-item/{productId}/{variantId}',[ProductVariantItemController::class,'index'])->name('products-variant-item.index');
    Route::get('/products-variant-item/create/{productId}/{variantId}',[ProductVariantItemController::class,'create'])->name('products-variant-item.create');
    Route::post('/products-variant-item',[ProductVariantItemController::class,'store'])->name('products-variant-item.store');
    Route::get('/products-variant-item-edit/{variantItemId}',[ProductVariantItemController::class,'edit'])->name('products-variant-item.edit');
    Route::put('/products-variant-item-update/{variantItemId}',[ProductVariantItemController::class,'update'])->name('products-variant-item.update');
    Route::delete('/products-variant-item-destroy/{variantItemId}',[ProductVariantItemController::class,'destroy'])->name('products-variant-item.destroy');
    Route::put('/products-variant-item-status',[ProductVariantItemController::class,'changeStatus'])->name('products-variant-item.change-status');


});
