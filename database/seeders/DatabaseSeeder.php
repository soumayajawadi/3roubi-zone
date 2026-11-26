<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Lien sora el huile
        $imageHuile = 'https://i.pinimg.com/736x/03/04/bb/0304bb47ae96f38e522856c414365160.jpg';

        // Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        // Client test
        User::create([
            'name'     => 'Client Test',
            'email'    => 'client@3roubi.tn',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        // Zones
        Zone::insert([
            ['name' => 'France', 'shipping_cost' => 9.90],
            ['name' => 'Europe', 'shipping_cost' => 14.90],
            ['name' => 'Monde',  'shipping_cost' => 24.90],
        ]);

        // Catégories
        $categories = ['Épices', 'Huiles', 'Pâtisseries'];
        foreach ($categories as $c) {
            Category::create(['name' => $c, 'slug' => Str::slug($c)]);
        }

        // Produits : [nom, prix, catégorie, image]
        $produits = [
            ['Harissa artisanale',            6.50,  'Épices',      'https://i.pinimg.com/736x/3b/9c/fa/3b9cfa0e493c569333766f07bf1dcfc4.jpg'],
            ["Huile d'olive extra vierge 1L", 15.00, 'Huiles',      $imageHuile],
            ['Makroudh Kairouan',             8.00,  'Pâtisseries', 'https://i.pinimg.com/736x/f2/3d/88/f23d88543f63814e6ba3feb7383a0032.jpg'],
            ['Ka3k Wa9a',                     12.00, 'Pâtisseries', 'https://i.pinimg.com/736x/7a/d1/bf/7ad1bfb534c0c056eddcb2cd758219e6.jpg'],
            ['Baklewa',                       18.00, 'Pâtisseries', 'https://i.pinimg.com/736x/71/26/66/712666f31ee24bfc38afb52f7e63a573.jpg'],
            ['Mloukheya',                     14.00, 'Épices',      'https://i.pinimg.com/1200x/bf/2f/27/bf2f27c40e125f08ea231767ee64960b.jpg'],
            ['Bsisa',                         7.00,  'Épices',      'https://i.pinimg.com/736x/33/1b/28/331b280769f6f75c826c6cfab901a0e3.jpg'],
            ['Hlow',                          10.00, 'Pâtisseries', 'https://i.pinimg.com/736x/c9/ce/1a/c9ce1a8a3bbefd9db7d2435e42596cf7.jpg'],
            ['Zouza',                         9.00,  'Pâtisseries', 'https://i.pinimg.com/736x/1a/48/0a/1a480af2524f2c2e8efe483b3b6e93e2.jpg'],
            ['Ghraiba',                       9.50,  'Pâtisseries', 'https://i.pinimg.com/736x/19/6a/1b/196a1bd5bdc71b6a581cdf012f62792c.jpg'],
            ['Couscous traditionnel',         5.50,  'Épices',      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5mtlgrLcgqSub8rNP57i9hdGh1LQzuNCBJr9KQZJEvQ&s=10'],
            ['3sal Hor',                      25.00, 'Épices',      'https://i.pinimg.com/736x/e3/88/af/e388af60f0c1408eb457a46d763d54e8.jpg'],
            ['Hwarat',                        11.00, 'Épices',      'https://i.pinimg.com/736x/f4/9f/50/f49f50310040b8216f02b6b80121346d.jpg'],
        ];

        foreach ($produits as [$name, $price, $catName, $image]) {
            $category = Category::where('name', $catName)->first();

            Product::create([
                'name'              => $name,
                'slug'              => Str::slug($name),
                'price'             => $price,
                'stock'             => 50,
                'category_id'       => $category->id,
                'short_description' => 'Produit tunisien authentique',
                'image'             => $image,
            ]);
        }
    }
}