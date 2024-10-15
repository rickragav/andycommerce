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
        Schema::create('shoppers', function (Blueprint $table) {
            $table->id();
            $table->text('banner');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('description');
            $table->text('fb_link')->nullable();
            $table->text('tw_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->uuid('shopper_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoppers');
    }
};
