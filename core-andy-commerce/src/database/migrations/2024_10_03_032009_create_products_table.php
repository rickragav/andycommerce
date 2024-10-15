<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Identification Fields
            $table->id();
            $table->uuid('shopper_id');
            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->integer('child_category_id')->nullable();
            $table->integer('brand_id');

            // Product Details
            $table->string('name');
            $table->string('slug');
            $table->string('sku')->nullable();
 
            // Descriptions
            $table->text('short_description');
            $table->text('long_description');

            // Seo
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_image')->nullable();

            // Media
            $table->text('thumb_image');
            $table->text('video_link')->nullable();

            // Pricing and Offers
            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();

            // Inventory and Stock
            $table->integer('qty');

            // Product Features and Types
            $table->enum('product_type', ['physical', 'digital'])->default('physical');
            $table->string('product_feature_type')->nullable();

            // Statuses
            $table->boolean('status');
            $table->boolean('is_variant');
            $table->integer('is_approved')->default(0);

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
