<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Personal',
            'Business / Corporate',
            'Tech',
            'Food',
            'Travel',
            'Health & Fitness',
            'Finance',
            'Fashion & Lifestyle',
            'Education',
            'Gaming',
            'Entertainment',
            'News & Commentary',
            'Creative Writing',
            'Affiliate / Monetization',
            'Niche / Hobby',
        ];

        foreach ($types as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}
