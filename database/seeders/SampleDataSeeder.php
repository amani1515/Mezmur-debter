<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Poem;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            'Religious Poems',
            'Traditional Poems',
            'Modern Poems'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Create subcategories
        $religious = Category::where('name', 'Religious Poems')->first();
        $traditional = Category::where('name', 'Traditional Poems')->first();
        $modern = Category::where('name', 'Modern Poems')->first();

        $subcategories = [
            ['name' => 'Praise Songs', 'category_id' => $religious->id],
            ['name' => 'Prayer Poems', 'category_id' => $religious->id],
            ['name' => 'Folk Songs', 'category_id' => $traditional->id],
            ['name' => 'Love Poems', 'category_id' => $traditional->id],
            ['name' => 'Contemporary', 'category_id' => $modern->id],
            ['name' => 'Social Commentary', 'category_id' => $modern->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::firstOrCreate($subcategory);
        }

        // Create sample poems
        $poems = [
            [
                'title' => 'የእግዚአብሔር ምስጋና',
                'author' => 'Anonymous',
                'body' => "እግዚአብሔር ሆይ አንተን እመስግናለሁ\nበየቀኑ ምህረትህን ስለምታሳየኝ\nበጸሎቴ ውስጥ አንተን እጠራለሁ\nምክንያቱም አንተ ታማኝ ነህ",
                'subcategory_id' => Subcategory::where('name', 'Praise Songs')->first()->id
            ],
            [
                'title' => 'ለእናቴ',
                'author' => 'ተስፋዬ ገብረአብ',
                'body' => "እናቴ ሆይ አንቺ ብርሃኔ ነሽ\nበጨለማ ጊዜ የምታበራኝ\nፍቅርሽ እንደ ወርቅ ነው\nለዘላለም የማይረሳ",
                'subcategory_id' => Subcategory::where('name', 'Love Poems')->first()->id
            ],
            [
                'title' => 'የዘመናችን ችግር',
                'author' => 'ዳዊት መኮንን',
                'body' => "ዛሬ ዓለም ተቀይራለች\nቴክኖሎጂ ሁሉን ይዛለች\nግን ፍቅር እየጠፋ ነው\nሰላም እየራቀ ነው",
                'subcategory_id' => Subcategory::where('name', 'Social Commentary')->first()->id
            ]
        ];

        foreach ($poems as $poem) {
            Poem::firstOrCreate(['title' => $poem['title']], $poem);
        }
    }
}