<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed wilayas and communes first
        $this->call(WilayaCommuneSeeder::class);
        
        // Seed slider images
        $this->call(SliderImageSeeder::class);

        // --- Users ---
        $users = collect([
            // ['name' => 'Karim Boulanger', 'email' => 'karim@example.com', 'phone' => '0551001100', 'type' => 'details', 'status' => 'active', 'address' => 'Algiers centre', 'commune_id' => 554],
            ['name' => 'Karim Boulanger', 'email' => 'redouanedaddi316@gmail.com', 'phone' => '0551001100', 'type' => 'details', 'status' => 'active', 'address' => 'Algiers centre', 'commune_id' => 554],
            ['name' => 'Saliha Pâtissière', 'email' => 'saliha@example.com', 'phone' => '0552002200', 'type' => 'details', 'status' => 'active', 'address' => 'Oran centre', 'commune_id' => 1110],
            ['name' => 'Ali Grossiste', 'email' => 'ali@example.com', 'phone' => '0553003300', 'type' => 'gros', 'status' => 'active', 'address' => 'Blida', 'commune_id' => 284],
            ['name' => 'Nour Client', 'email' => 'nour@example.com', 'phone' => '0554004400', 'type' => 'details', 'status' => 'pending', 'address' => 'Constantine', 'commune_id' => 887],
            ['name' => 'Rachid Client', 'email' => 'rachid@example.com', 'phone' => '0555005500', 'type' => 'details', 'status' => 'disabled', 'address' => 'Setif', 'commune_id' => 675],
        ])->map(fn($u) => User::create(array_merge($u, [
            'password' => Hash::make('password'),
        ])));

        // --- Brands ---
        $brands = collect([
            ['name' => 'ChocoDz', 'description' => 'Local Algerian chocolate brand', 'is_active' => true],
            ['name' => 'DzSweets', 'description' => 'Traditional Algerian sweets', 'is_active' => true],
            ['name' => 'Biscotti', 'description' => 'Biscuits and croissants brand', 'is_active' => true],
            ['name' => 'Algeria Creams', 'description' => 'Fresh cream for cakes', 'is_active' => true],
            ['name' => 'Oriental Delight', 'description' => 'Makrout, Baklawa, and more', 'is_active' => false],
        ])->map(fn($b) => Brand::create($b));

        // --- Categories ---
        $categories = collect([
            ['name' => 'Cakes', 'parent_id' => null, 'is_active' => true, 'image' => 'pictures/categories/1/1.png'],
            ['name' => 'Pastries', 'parent_id' => null, 'is_active' => true, 'image' => 'pictures/categories/2/2.png'],
            ['name' => 'Biscuits', 'parent_id' => null, 'is_active' => true, 'image' => 'pictures/categories/3/3.png'],
            ['name' => 'Chocolates', 'parent_id' => null, 'is_active' => true, 'image' => 'pictures/categories/4/4.png'],
            ['name' => 'Baklava', 'parent_id' => null, 'is_active' => true, 'image' => 'pictures/categories/5/5.png'],
            ['name' => 'Birthday Cakes', 'parent_id' => 1, 'is_active' => true, 'image' => 'pictures/categories/6/6.png'], // child of Cakes
            ['name' => 'Croissants', 'parent_id' => 2, 'is_active' => true, 'image' => 'pictures/categories/7/7.png'],   // child of Pastries
        ])->map(fn($c) => Category::create($c));

        // --- Products ---
        $products = collect([
            ['name' => 'Chocolate Cake', 'size' => 'Large', 'brand_id' => $brands[0]->id, 'category_id' => $categories[0]->id, 'use_case' => 'Birthday', 'description' => 'Rich chocolate cream', 'caracteristics' => json_encode([
                'flavor' => 'chocolate',
                'weight' => '2.5 kg',
                'diameter' => '28 cm',
                'layers' => 3,
                'filling' => 'chocolate ganache',
                'topping' => 'chocolate shavings',
                'allergens' => ['gluten', 'dairy', 'eggs'],
                'shelf_life' => '5 days',
                'storage' => 'refrigerated',
                'serving_size' => '12-15 people'
            ]), 'reference' => 'CK-001', 'price1' => 2500, 'price2' => 2300, 'stock' => 10, 'discount' => 10, 'is_new' => true,
                'image1' => 'pictures/products/1/1_1.jpg',
                'image2' => 'pictures/products/1/1_2.jpg',
                'image3' => 'pictures/products/1/1_3.jpg',
                'image4' => 'pictures/products/1/1_4.jpg',
                'image5' => 'pictures/products/1/1_5.jpg',
            ],

            ['name' => 'Baklava Assortment', 'size' => 'Medium', 'brand_id' => $brands[4]->id, 'category_id' => $categories[4]->id, 'use_case' => 'Family', 'description' => 'Traditional Algerian baklava', 'caracteristics' => json_encode([
                'nuts' => 'almond',
                'quantity' => '24 pieces',
                'weight' => '800g',
                'dimensions' => '20x15 cm',
                'syrup' => 'honey and rose water',
                'layers' => '40 phyllo sheets',
                'allergens' => ['gluten', 'nuts', 'dairy'],
                'shelf_life' => '3 weeks',
                'storage' => 'room temperature',
                'origin' => 'Algerian traditional',
                'serving_size' => '6-8 people'
            ]), 'reference' => 'BK-002', 'price1' => 1800, 'price2' => 1700, 'stock' => 15, 'discount' => 5, 'is_new' => false,
                'image1' => 'pictures/products/2/2_1.jpg',
                'image2' => 'pictures/products/2/2_2.jpg',
                'image3' => 'pictures/products/2/2_3.jpg',
                'image4' => 'pictures/products/2/2_4.jpg',
                'image5' => 'pictures/products/2/2_5.jpg',
            ],

            ['name' => 'Croissant au Beurre', 'size' => 'Small', 'brand_id' => $brands[2]->id, 'category_id' => $categories[6]->id, 'use_case' => 'Breakfast', 'description' => 'Buttery croissant', 'caracteristics' => json_encode([
                'type' => 'butter',
                'weight' => '65g',
                'dimensions' => '12x6 cm',
                'layers' => 27,
                'butter_content' => '25%',
                'baking_temperature' => '200°C',
                'allergens' => ['gluten', 'dairy', 'eggs'],
                'shelf_life' => '2 days',
                'storage' => 'room temperature',
                'serving_temperature' => 'warm',
                'pairing' => 'coffee, tea, jam'
            ]), 'reference' => 'CR-003', 'price1' => 200, 'price2' => 180, 'stock' => 50, 'discount' => 0, 'is_new' => true,
                'image1' => 'pictures/products/3/3_1.jpg',
                'image2' => 'pictures/products/3/3_2.jpg',
                'image3' => 'pictures/products/3/3_3.jpg',
                'image4' => 'pictures/products/3/3_4.jpg',
                'image5' => 'pictures/products/3/3_5.jpg',
            ],

            ['name' => 'Makrout el Louz', 'size' => 'Medium', 'brand_id' => $brands[1]->id, 'category_id' => $categories[4]->id, 'use_case' => 'Wedding', 'description' => 'Almond based sweet', 'caracteristics' => json_encode([
                'syrup' => 'honey',
                'main_ingredient' => 'almond paste',
                'weight' => '500g',
                'quantity' => '16 pieces',
                'shape' => 'diamond',
                'texture' => 'soft and chewy',
                'allergens' => ['nuts', 'dairy'],
                'shelf_life' => '2 weeks',
                'storage' => 'refrigerated',
                'traditional_recipe' => true,
                'serving_size' => '4-6 people',
                'occasion' => 'weddings, celebrations'
            ]), 'reference' => 'MK-004', 'price1' => 1500, 'price2' => 1400, 'stock' => 20, 'discount' => 0, 'is_new' => false,
                'image1' => 'pictures/products/4/4_1.jpg',
                'image2' => 'pictures/products/4/4_2.jpg',
                'image3' => 'pictures/products/4/4_3.jpg',
                'image4' => 'pictures/products/4/4_4.jpg',
                'image5' => 'pictures/products/4/4_5.jpg',
            ],

            ['name' => 'Strawberry Cake', 'size' => 'Large', 'brand_id' => $brands[3]->id, 'category_id' => $categories[5]->id, 'use_case' => 'Birthday', 'description' => 'Strawberry whipped cream', 'caracteristics' => json_encode([
                'flavor' => 'strawberry',
                'weight' => '2.8 kg',
                'diameter' => '30 cm',
                'layers' => 4,
                'filling' => 'strawberry compote',
                'topping' => 'fresh strawberries',
                'cream_type' => 'whipped cream',
                'allergens' => ['gluten', 'dairy', 'eggs'],
                'shelf_life' => '4 days',
                'storage' => 'refrigerated',
                'serving_size' => '15-18 people',
                'decoration' => 'edible flowers'
            ]), 'reference' => 'CK-005', 'price1' => 2800, 'price2' => 2600, 'stock' => 8, 'discount' => 15, 'is_new' => true,
                'image1' => 'pictures/products/5/5_1.jpg',
                'image2' => 'pictures/products/5/5_2.jpg',
                'image3' => 'pictures/products/5/5_3.jpg',
                'image4' => 'pictures/products/5/5_4.jpg',
                'image5' => 'pictures/products/5/5_5.jpg',
            ],
        ])->map(fn($p) => Product::create($p));

        // --- Orders ---
        $orders = collect([
            ['client_id' => $users[3]->id, 'client_name' => 'Nour Client', 'client_phone' => '0554004400', 'commune_id' => 25, 'payment_status' => 'pending', 'payment_method' => 'cash', 'is_verified' => false, 'order_status' => 'pending', 'total_price' => 2500, 'notes' => 'Deliver in the morning'],
            ['client_id' => $users[4]->id, 'client_name' => 'Rachid Client', 'client_phone' => '0555005500', 'commune_id' => 19, 'payment_status' => 'full_paid', 'payment_method' => 'bank_transfer', 'is_verified' => true, 'order_status' => 'confirmed', 'total_price' => 1800, 'notes' => 'Urgent order'],
            ['client_id' => null, 'client_name' => 'Guest Client', 'client_phone' => '0556006600', 'commune_id' => 16, 'payment_status' => 'partial_paid', 'payment_method' => 'ccp', 'is_verified' => false, 'order_status' => 'processing', 'total_price' => 2000, 'notes' => null],
        ])->map(fn($o) => Order::create($o));

        // --- Order Products ---
        OrderProduct::create(['order_id' => $orders[0]->id, 'product_id' => $products[0]->id, 'qte' => 1, 'price' => 2500]);
        OrderProduct::create(['order_id' => $orders[1]->id, 'product_id' => $products[1]->id, 'qte' => 1, 'price' => 1800]);
        OrderProduct::create(['order_id' => $orders[2]->id, 'product_id' => $products[2]->id, 'qte' => 10, 'price' => 200]);
    }
}
