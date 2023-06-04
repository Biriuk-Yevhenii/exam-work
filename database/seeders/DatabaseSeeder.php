<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Biriuk Yevhenii Admin',
            'email' => 'biriuk.yevhenii@gmz31.com',
            'password'=> Hash::make('12345678'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Biriuk Yevhenii',
            'email' => 'yevgenbeeryuk@gmail.com',
            'password'=> Hash::make('12345678'),
        ]);
        

        \App\Models\Category::factory()->create([
            'name' => "Men's Business Suits",
            'description' => 'men',
        ]);
        \App\Models\Category::factory()->create([
            'name' => "Women's Business Suits",
            'description' => 'girl',
        ]);

        
        \App\Models\Catalog::factory()->create([
            'title' => 'Emerald demi-season three-piece suit single-breasted men`s emerald Andreas Moskin suit',
            'content' => "Following the legendary Italian tailoring tradition, Andreas Moskin clothing is made from the finest Italian fabrics with the utmost attention to every detail and seam. When we talk about quality, no compromises are accepted. That's why we've never sold clothes, but a way of life. We never followed trends, we set them and brought them back to timeless elegance.",
            'price' => 600.84 ,
            'category_id' => 1
        ]);
        \App\Models\Catalog::factory()->create([
            'title' => 'Gray demi-season two-piece single-breasted men`s gray Andreas Moskin suit',
            'content' => "Following the legendary Italian tailoring tradition, Andreas Moskin clothing is made from the finest Italian fabrics with the utmost attention to every detail and seam. When we talk about quality, no compromises are accepted. That's why we've never sold clothes, but a way of life. We never followed trends, we set them and brought them back to timeless elegance.",
            'price' => 463.62 ,
            'category_id' => 1
        ]);
    }
}
