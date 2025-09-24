<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SliderImage;

class SliderImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Full-width slider images for complete horizontal coverage
        $sliderData = [
            [
                'image_url' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1920&h=600&fit=crop&crop=center',
                'title' => 'Délicieux Gâteaux Artisanaux 2024',
                'subtitle' => '25% off this week - Starting at $45.00',
                'link_url' => '/products/3',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=1920&h=600&fit=crop&crop=center',
                'title' => 'Café Spécialité Premium',
                'subtitle' => '10% off this week - Starting at $20.00',
                'link_url' => '/products/8',
                'sort_order' => 5,
                'is_active' => true,
            ],

            // make images others not like the first ones
            [
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=1920&h=600&fit=crop&crop=center',
                'title' => 'Pâtisseries Fraîches du Jour',
                'subtitle' => '15% off this week - Starting at $30.00',
                'link_url' => '/products/5',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'image_url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1920&h=600&fit=crop&crop=center',
                'title' => 'Chocolats Fins et Gourmands',
                'subtitle' => '30% off this week - Starting at $25.00',
                'link_url' => '/products/7',
                'sort_order' => 20,
                'is_active' => true,
            ],
            
        ];

        // Insert the slider images
        foreach ($sliderData as $slide) {
            SliderImage::create($slide);
        }

        $this->command->info('Slider images seeded successfully!');
    }
}
