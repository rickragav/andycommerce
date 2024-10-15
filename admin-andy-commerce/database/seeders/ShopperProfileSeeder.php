<?php

namespace Database\Seeders;

use AndyCommerce\Core\Models\Shopper;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShopperProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("email","vendor2@gmail.com")->first();
        $vendor = new Shopper();
        $vendor->banner = 'upload/123.jpg';
        $vendor->phone = '7904342859';
        $vendor->email = 'vendor2@gmail.com';
        $vendor->address = 'chennai';
        $vendor->description = 'andy commerce vendor';
        $vendor->shopper_id = $user->id;
        $vendor->save();
    }
}
