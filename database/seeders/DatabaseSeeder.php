<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('rahasia')
        ]);

        $payloadsProductCategories = [
            [
                "name" => "Gadget dan aksesoris"
            ],
            [
                "name" => "Fashion"
            ],
            [
                "name" => "Kebutuhan rumah tangga"
            ]
        ];

        foreach ($payloadsProductCategories as $category) {
            CategoryProduct::create($category);
        }

        $payloadsProducts = [
            [
                "name" => "majoo Pro",
                'category_id' => CategoryProduct::where('name', 'Gadget dan aksesoris')->first()->id,
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, provident optio quos excepturi nisi sit possimus odit vel delectus ad cum? Magni nisi obcaecati deleniti voluptates aut rerum alias modi.',
                'image' => 'images/standard_repo.png',
                'price' => '2750000'
            ],
            [
                "name" => "majoo Advance",
                'category_id' => CategoryProduct::where('name', 'Gadget dan aksesoris')->first()->id,
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, provident optio quos excepturi nisi sit possimus odit vel delectus ad cum? Magni nisi obcaecati deleniti voluptates aut rerum alias modi.',
                'image' => 'images/paket-advance.png',
                'price' => '2750000'
            ],
            [
                "name" => "majoo Lifestyle",
                'category_id' => CategoryProduct::where('name', 'Gadget dan aksesoris')->first()->id,
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, provident optio quos excepturi nisi sit possimus odit vel delectus ad cum? Magni nisi obcaecati deleniti voluptates aut rerum alias modi.',
                'image' => 'images/paket-lifestyle.png',
                'price' => '2750000'
            ],
            [
                "name" => "majoo Desktop",
                'category_id' => CategoryProduct::where('name', 'Gadget dan aksesoris')->first()->id,
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, provident optio quos excepturi nisi sit possimus odit vel delectus ad cum? Magni nisi obcaecati deleniti voluptates aut rerum alias modi.',
                'image' => 'images/paket-desktop.png',
                'price' => '2750000'
            ]
        ];

        foreach ($payloadsProducts as $product) {
            Product::create($product);
        }
    }
}
