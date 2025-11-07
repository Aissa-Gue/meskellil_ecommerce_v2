<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SyncProductsFromSheetCommand extends Command
{
    protected $signature = 'sheet:sync-products
        {--sheet= : Override sheet tab name}
        {--dry : Dry run (no DB writes)}';

    protected $description = 'Sync (upsert) products/brands/categories from a public Google Sheet into MySQL';

    public function handle(): int
    {
        $apiKey = env('GOOGLE_API_KEY');
        $spreadsheetId = env('GOOGLE_SPREADSHEET_ID');
        $sheetName = $this->option('sheet') ?: env('GOOGLE_SHEET_NAME', 'Products');

        if (!$apiKey || !$spreadsheetId) {
            $this->error('Missing GOOGLE_API_KEY or GOOGLE_SPREADSHEET_ID.');
            return self::FAILURE;
        }

        $url = "https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$sheetName}?key={$apiKey}";
        $this->info("Fetching: {$url}");

        $res = Http::get($url);
        if (!$res->ok()) {
            $this->error("HTTP error: {$res->status()}");
            return self::FAILURE;
        }

        $data = $res->json();
        if (!isset($data['values']) || count($data['values']) < 2) {
            $this->warn('No data rows.');
            return self::SUCCESS;
        }

        $headers = $data['values'][0];
        $rows = array_slice($data['values'], 1);

        $count = 0;
        foreach ($rows as $row) {
            $item = array_combine($headers, array_pad($row, count($headers), null));

            // Expected optional headers in sheet (case-insensitive):
            // name,size,brand,brand_id,category,category_id,use_case,details,characteristics(reference json),reference,
            // price1,price2,stock,discount,is_new,is_active,image1..image5

            $name = $item['name'] ?? null;
            if (!$name) continue;

            // BRAND
            $brandId = $item['brand_id'] ?? null;
            if (!$brandId && !empty($item['brand'])) {
                $brand = Brand::firstOrCreate(
                    ['name' => trim($item['brand'])],
                    ['is_active' => true]
                );
                $brandId = $brand->id;
            }

            // CATEGORY
            $categoryId = $item['category_id'] ?? null;
            if (!$categoryId && !empty($item['category'])) {
                $category = Category::firstOrCreate(
                    ['name' => trim($item['category']), 'parent_id' => null],
                    ['is_active' => true]
                );
                $categoryId = $category->id;
            }

            // characteristics: allow JSON in sheet, else try to parse "key1:val1; key2:val2"
            $caracs = null;
            if (!empty($item['characteristics'])) {
                $c = trim($item['characteristics']);
                if (Str::startsWith($c, ['{','['])) {
                    $caracs = json_decode($c, true);
                } else {
                    $pairs = array_filter(array_map('trim', explode(';', $c)));
                    $arr = [];
                    foreach ($pairs as $pair) {
                        [$k,$v] = array_pad(explode(':', $pair, 2), 2, null);
                        if ($k) $arr[trim($k)] = trim((string) $v);
                    }
                    $caracs = $arr ?: null;
                }
            }

            $payload = [
                'name' => $name,
                'size' => $item['size'] ?? null,
                'brand_id' => $brandId,
                'category_id' => $categoryId,
                'use_case' => $item['use_case'] ?? null,
                'details' => $item['details'] ?? null,
                'characteristics' => $caracs,
                'reference' => $item['reference'] ?? null,
                'price1' => isset($item['price1']) ? (float)$item['price1'] : null,
                'price2' => isset($item['price2']) ? (float)$item['price2'] : null,
                'stock' => isset($item['stock']) ? (int)$item['stock'] : 0,
                'discount' => isset($item['discount']) ? (int)$item['discount'] : 0,
                'is_new' => isset($item['is_new']) ? filter_var($item['is_new'], FILTER_VALIDATE_BOOLEAN) : false,
                'is_active' => isset($item['is_active']) ? filter_var($item['is_active'], FILTER_VALIDATE_BOOLEAN) : true,
                'image1' => isset($item['image1']) ? self::asDriveDirect($item['image1']) : null,
                'image2' => isset($item['image2']) ? self::asDriveDirect($item['image2']) : null,
                'image3' => isset($item['image3']) ? self::asDriveDirect($item['image3']) : null,
                'image4' => isset($item['image4']) ? self::asDriveDirect($item['image4']) : null,
                'image5' => isset($item['image5']) ? self::asDriveDirect($item['image5']) : null,
            ];

            $this->line("- {$payload['name']}");

            if (!$this->option('dry')) {
                // Upsert by (reference) if present, else by (name + brand_id + size)
                if (!empty($payload['reference'])) {
                    Product::updateOrCreate(
                        ['reference' => $payload['reference']],
                        $payload
                    );
                } else {
                    Product::updateOrCreate(
                        [
                            'name' => $payload['name'],
                            'brand_id' => $payload['brand_id'],
                            'size' => $payload['size'],
                        ],
                        $payload
                    );
                }
            }

            $count++;
        }

        $this->info("Processed rows: {$count}");
        return self::SUCCESS;
    }

    /** Convert Google Drive share URL (or id) to direct view URL */
    public static function asDriveDirect(?string $value): ?string
    {
        if (!$value) return null;

        // If it's just an ID, return formatted URL
        if (preg_match('/^[A-Za-z0-9_\-]+$/', $value)) {
            return "https://drive.google.com/uc?export=view&id={$value}";
        }

        // Try to extract from a full link
        if (preg_match('/\/d\/(.*?)\//', $value, $m)) {
            return "https://drive.google.com/uc?export=view&id={$m[1]}";
        }

        // Already direct?
        if (str_contains($value, 'https://drive.google.com/uc?export=view&id=')) {
            return $value;
        }

        return $value; // fallback (http img might still work)
    }
}
