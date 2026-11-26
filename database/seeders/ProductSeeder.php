<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Épices',       'Harissa artisanale',        6.50,  'https://i.pinimg.com/736x/3b/9c/fa/3b9cfa0e493c569333766f07bf1dcfc4.jpg'],
            ['Huiles',       "Huile d'olive extra vierge", 15.00, null],
            ['Pâtisseries',  'Makroudh Kairouan',         8.00,  'https://i.pinimg.com/736x/f2/3d/88/f23d88543f63814e6ba3feb7383a0032.jpg'],
            ['Artisanat',    'Tapis Kairouan',            120.00, null],
            ['Pâtisseries',  'Ka3k Wa9a',                 12.00, 'https://i.pinimg.com/736x/7a/d1/bf/7ad1bfb534c0c056eddcb2cd758219e6.jpg'],
            ['Pâtisseries',  'Baklewa',                   18.00, 'https://i.pinimg.com/736x/71/26/66/712666f31ee24bfc38afb52f7e63a573.jpg'],
            ['Épices',       'Mloukheya',                 14.00, 'https://i.pinimg.com/1200x/bf/2f/27/bf2f27c40e125f08ea231767ee64960b.jpg'],
            ['Épices',       'Bsisa',                      7.00, 'https://i.pinimg.com/736x/33/1b/28/331b280769f6f75c826c6cfab901a0e3.jpg'],
            ['Pâtisseries',  'Hlow',                      10.00, 'https://i.pinimg.com/736x/c9/ce/1a/c9ce1a8a3bbefd9db7d2435e42596cf7.jpg'],
            ['Pâtisseries',  'Zouza',                      9.00, 'https://i.pinimg.com/736x/1a/48/0a/1a480af2524f2c2e8efe483b3b6e93e2.jpg'],
            ['Épices',       'Couscous traditionnel',      5.50, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5mtlgrLcgqSub8rNP57i9hdGh1LQzuNCBJr9KQZJEvQ&s=10'],
            ['Épices',       '3sal Hor',                  25.00, 'https://i.pinimg.com/736x/e3/88/af/e388af60f0c1408eb457a46d763d54e8.jpg'],
            ['Épices',       'Hwarat',                    11.00, 'https://i.pinimg.com/736x/f4/9f/50/f49f50310040b8216f02b6b80121346d.jpg'],
        ];

        foreach ($products as [$cat, $name, $price, $image]) {
            $category = Category::firstOrCreate(['name' => $cat]);

            Product::updateOrCreate(
                ['name' => $name],
                [
                    'category_id' => $category->id,
                    'description' => 'Produit tunisien authentique',
                    'price'       => $price,
                    'image'       => $image,
                ]
            );
        }
    }
}