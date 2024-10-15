<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Str;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=>'Admin user',
                'username'=>'adminuser',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'status'=>'active',
                'password'=> Hash::make('password'),
                'id' => (string) Str::uuid(),
            ],
            [
                'name'=>'Vendor user',
                'username'=>'vendoruser',
                'email'=>'vendor@gmail.com',
                'role'=>'vendor',
                'status'=>'active',
                'password'=>Hash::make('password'),
                'id' => (string) Str::uuid(),
            ],
            [
                'name'=>'user',
                'username'=>'user',
                'email'=>'user@gmail.com',
                'role'=>'user',
                'status'=>'active',
                'password'=>Hash::make('password'),
                'id' => (string) Str::uuid(),
            ],
            [
                'name'=>'Admin user',
                'username'=>'adminuser',
                'email'=>'admin2@gmail.com',
                'role'=>'admin',
                'status'=>'active',
                'password'=> Hash::make('password'),
                'id' => (string) Str::uuid(),
            ],
            [
                'name'=>'Vendor user',
                'username'=>'vendoruser',
                'email'=>'vendor2@gmail.com',
                'role'=>'vendor',
                'status'=>'active',
                'password'=>Hash::make('password'),
                'id' => (string) Str::uuid(),
            ],
            [
                'name'=>'user',
                'username'=>'user',
                'email'=>'user2@gmail.com',
                'role'=>'user',
                'status'=>'active',
                'password'=>Hash::make('password'),
                'id' => (string) Str::uuid(),
            ]
            ]);
    }
}
