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
        // Main slider images (full-width horizontal coverage)
        $sliderImages = [
            [
                'type' => SliderImage::TYPE_SLIDER,
                'image_url' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1920&h=600&fit=crop&crop=center',
                'resolution_width' => 1920,
                'resolution_height' => 600,
                'link_url' => '/products/3',
                'sort_order' => 1,
                'is_active' => true,
                'max_items' => 5,
            ],
            [
                'type' => SliderImage::TYPE_SLIDER,
                'image_url' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=1920&h=600&fit=crop&crop=center',
                'resolution_width' => 1920,
                'resolution_height' => 600,
                'link_url' => '/products/8',
                'sort_order' => 2,
                'is_active' => true,
                'max_items' => 5,
            ],
            [
                'type' => SliderImage::TYPE_SLIDER,
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=1920&h=600&fit=crop&crop=center',
                'resolution_width' => 1920,
                'resolution_height' => 600,
                'link_url' => '/products/5',
                'sort_order' => 3,
                'is_active' => true,
                'max_items' => 5,
            ],
            [
                'type' => SliderImage::TYPE_SLIDER,
                'image_url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1920&h=600&fit=crop&crop=center',
                'resolution_width' => 1920,
                'resolution_height' => 600,
                'link_url' => '/products/7',
                'sort_order' => 4,
                'is_active' => true,
                'max_items' => 5,
            ],
        ];

        // Top banner images (large banner)
        $topBannerImages = [
            [
                'type' => SliderImage::TYPE_BANNER_TOP,
                'image_url' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=1200&h=400&fit=crop&crop=center',
                'resolution_width' => 1200,
                'resolution_height' => 400,
                'link_url' => '/products',
                'sort_order' => 1,
                'is_active' => true,
                'max_items' => 1,
            ],
        ];

        // Small banner images (for banner area)
        $smallBannerImages = [
            [
                'type' => SliderImage::TYPE_BANNER_SMALL,
                'image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=400&fit=crop&crop=center',
                'resolution_width' => 600,
                'resolution_height' => 400,
                'link_url' => '/products/1',
                'sort_order' => 1,
                'is_active' => true,
                'max_items' => 2,
            ],
            [
                'type' => SliderImage::TYPE_BANNER_SMALL,
                'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600&h=400&fit=crop&crop=center',
                'resolution_width' => 600,
                'resolution_height' => 400,
                'link_url' => '/products/2',
                'sort_order' => 2,
                'is_active' => true,
                'max_items' => 2,
            ],
        ];

        // Medium banner images
        $mediumBannerImages = [
            [
                'type' => SliderImage::TYPE_BANNER_MEDIUM,
                'image_url' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&h=300&fit=crop&crop=center',
                'resolution_width' => 800,
                'resolution_height' => 300,
                'link_url' => '/categories/1',
                'sort_order' => 1,
                'is_active' => true,
                'max_items' => 1,
            ],
        ];

        // Product banner images (for product banner area)
        $productBannerImages = [
            [
                'type' => SliderImage::TYPE_BANNER_PRODUCT,
                'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=600&fit=crop&crop=center',
                'resolution_width' => 800,
                'resolution_height' => 600,
                'link_url' => '/products/1',
                'sort_order' => 1,
                'is_active' => true,
                'max_items' => 3,
            ],
            [
                'type' => SliderImage::TYPE_BANNER_PRODUCT,
                'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800&h=600&fit=crop&crop=center',
                'resolution_width' => 800,
                'resolution_height' => 600,
                'link_url' => '/products/2',
                'sort_order' => 2,
                'is_active' => true,
                'max_items' => 3,
            ],
            [
                'type' => SliderImage::TYPE_BANNER_PRODUCT,
                'image_url' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=800&h=600&fit=crop&crop=center',
                'resolution_width' => 800,
                'resolution_height' => 600,
                'link_url' => '/products/3',
                'sort_order' => 3,
                'is_active' => true,
                'max_items' => 3,
            ],
        ];

        // Combine all images
        $allImages = array_merge(
            $sliderImages,
            $topBannerImages,
            $smallBannerImages,
            $mediumBannerImages,
            $productBannerImages
        );

        // Insert the slider images
        foreach ($allImages as $image) {
            SliderImage::create($image);
        }

        $this->command->info('Slider images seeded successfully!');
    }
}
