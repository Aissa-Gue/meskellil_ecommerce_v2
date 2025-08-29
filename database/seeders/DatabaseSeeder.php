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

        // --- Users ---
        $users = collect([
            ['name' => 'Karim Boulanger', 'email' => 'karim@example.com', 'phone' => '0551001100', 'type' => 'details', 'status' => 'active', 'address' => 'Algiers centre', 'wilaya_id' => 16],
            ['name' => 'Saliha Pâtissière', 'email' => 'saliha@example.com', 'phone' => '0552002200', 'type' => 'details', 'status' => 'active', 'address' => 'Oran centre', 'wilaya_id' => 31],
            ['name' => 'Ali Grossiste', 'email' => 'ali@example.com', 'phone' => '0553003300', 'type' => 'gros', 'status' => 'active', 'address' => 'Blida', 'wilaya_id' => 9],
            ['name' => 'Nour Client', 'email' => 'nour@example.com', 'phone' => '0554004400', 'type' => 'details', 'status' => 'pending', 'address' => 'Constantine', 'wilaya_id' => 25],
            ['name' => 'Rachid Client', 'email' => 'rachid@example.com', 'phone' => '0555005500', 'type' => 'details', 'status' => 'disabled', 'address' => 'Setif', 'wilaya_id' => 19],
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
            ['name' => 'Cakes', 'parent_id' => null, 'is_active' => true],
            ['name' => 'Pastries', 'parent_id' => null, 'is_active' => true],
            ['name' => 'Biscuits', 'parent_id' => null, 'is_active' => true],
            ['name' => 'Chocolates', 'parent_id' => null, 'is_active' => true],
            ['name' => 'Baklava', 'parent_id' => null, 'is_active' => true],
            ['name' => 'Birthday Cakes', 'parent_id' => 1, 'is_active' => true], // child of Cakes
            ['name' => 'Croissants', 'parent_id' => 2, 'is_active' => true],   // child of Pastries
        ])->map(fn($c) => Category::create($c));

        // --- Products ---
        $products = collect([
            ['name' => 'Chocolate Cake', 'size' => 'Large', 'brand_id' => $brands[0]->id, 'category_id' => $categories[0]->id, 'use_case' => 'Birthday', 'details' => 'Rich chocolate cream', 'caracteristics' => json_encode(['flavor' => 'chocolate']), 'reference' => 'CK-001', 'price1' => 2500, 'price2' => 2300, 'stock' => 10, 'discount' => 10, 'is_new' => true, 'image1' => 'cake1.jpg'],
            ['name' => 'Baklava Assortment', 'size' => 'Medium', 'brand_id' => $brands[4]->id, 'category_id' => $categories[4]->id, 'use_case' => 'Family', 'details' => 'Traditional Algerian baklava', 'caracteristics' => json_encode(['nuts' => 'almond']), 'reference' => 'BK-002', 'price1' => 1800, 'price2' => 1700, 'stock' => 15, 'discount' => 5, 'is_new' => false, 'image1' => 'baklava.jpg'],
            ['name' => 'Croissant au Beurre', 'size' => 'Small', 'brand_id' => $brands[2]->id, 'category_id' => $categories[6]->id, 'use_case' => 'Breakfast', 'details' => 'Buttery croissant', 'caracteristics' => json_encode(['type' => 'butter']), 'reference' => 'CR-003', 'price1' => 200, 'price2' => 180, 'stock' => 50, 'discount' => 0, 'is_new' => true, 'image1' => 'croissant.jpg'],
            ['name' => 'Makrout el Louz', 'size' => 'Medium', 'brand_id' => $brands[1]->id, 'category_id' => $categories[4]->id, 'use_case' => 'Wedding', 'details' => 'Almond based sweet', 'caracteristics' => json_encode(['syrup' => 'honey']), 'reference' => 'MK-004', 'price1' => 1500, 'price2' => 1400, 'stock' => 20, 'discount' => 0, 'is_new' => false, 'image1' => 'makrout.jpg'],
            ['name' => 'Strawberry Cake', 'size' => 'Large', 'brand_id' => $brands[3]->id, 'category_id' => $categories[5]->id, 'use_case' => 'Birthday', 'details' => 'Strawberry whipped cream', 'caracteristics' => json_encode(['flavor' => 'strawberry']), 'reference' => 'CK-005', 'price1' => 2800, 'price2' => 2600, 'stock' => 8, 'discount' => 15, 'is_new' => true, 'image1' => 'strawberry_cake.jpg'],
        ])->map(fn($p) => Product::create($p));

        // --- Orders ---
        $orders = collect([
            ['client_id' => $users[3]->id, 'client_name' => 'Nour Client', 'client_phone' => '0554004400', 'wilaya_id' => 25, 'payment_status' => 'pending', 'payment_method' => 'cash', 'is_verified' => false, 'order_status' => 'pending', 'total_price' => 2500, 'notes' => 'Deliver in the morning'],
            ['client_id' => $users[4]->id, 'client_name' => 'Rachid Client', 'client_phone' => '0555005500', 'wilaya_id' => 19, 'payment_status' => 'full_paid', 'payment_method' => 'bank_transfer', 'is_verified' => true, 'order_status' => 'confirmed', 'total_price' => 1800, 'notes' => 'Urgent order'],
            ['client_id' => null, 'client_name' => 'Guest Client', 'client_phone' => '0556006600', 'wilaya_id' => 16, 'payment_status' => 'partial_paid', 'payment_method' => 'ccp', 'is_verified' => false, 'order_status' => 'processing', 'total_price' => 2000, 'notes' => null],
        ])->map(fn($o) => Order::create($o));

        // --- Order Products ---
        OrderProduct::create(['order_id' => $orders[0]->id, 'product_id' => $products[0]->id, 'qte' => 1, 'price' => 2500]);
        OrderProduct::create(['order_id' => $orders[1]->id, 'product_id' => $products[1]->id, 'qte' => 1, 'price' => 1800]);
        OrderProduct::create(['order_id' => $orders[2]->id, 'product_id' => $products[2]->id, 'qte' => 10, 'price' => 200]);
    }
}
