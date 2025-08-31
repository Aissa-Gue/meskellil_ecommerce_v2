<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductService $productService)
    {
        $breadcrumbData = [
            'title' => 'Checkout',
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Shop',
                    'url' => route('products.index')
                ],
                [
                    'name' => 'List Products',
                    'url' => null // Current page, no URL needed
                ]
            ]
        ];

        // Merge backend filters with request filters
        $request->merge([
            'filter' => array_merge(
                $request->get('filter', []), // existing filters from URL
                [
                    'is_active' => true, // backend-added filter
                ]
            )
        ]);

        // Get products with filters
        $products = $productService->getFilteredProducts($request)->paginate(20);

        // Get categories with product counts
        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories', 'breadcrumbData'));
    }

    public function show(Product $product)
    {
        $breadcrumbData = [
            'title' => $product->name,
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Shop',
                    'url' => route('products.index')
                ],
                [
                    'name' => $product->name,
                    'url' => null
                ]
            ]
        ];

        // Load relationships
        $product->load(['brand:id,name', 'category:id,name']);

        // Get related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(8)
            ->get();
        return view('products.show', compact('product', 'relatedProducts', 'breadcrumbData'));
    }

    public function showByCategory(Category $category)
    {
        $breadcrumbData = [
            'title' => $category->name,
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Shop',
                    'url' => route('products.index')
                ],
                [
                    'name' => $category->name,
                    'url' => null
                ]
            ]
        ];

        // Get products from the specific category
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->paginate(20);

        return view('products.category', compact('category', 'products', 'breadcrumbData'));
    }

    public function getCategoryProducts(Category $category)
    {
        // Get products from the specific category for API/component usage
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->limit(8)
            ->get();

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);
    }

    public function quickView(Product $product)
    {
        // Load relationships for quick view
        $product->load(['brand:id,name', 'category:id,name']);

        // Return JSON response for the modal
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'main_price' => $product->main_price,
            'discounted_price' => $product->discounted_price,
            'has_discount' => $product->has_discount,
            'discount' => $product->discount,
            'stock' => $product->stock,
            'size' => $product->size,
            'main_image' => $product->main_image,
            'images' => $product->images,
            'category' => $product->category,
            'brand' => $product->brand,
            'is_new' => $product->is_new,
            'is_active' => $product->is_active,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $product = Product::create($data);
        return redirect()->route('products.show', $product);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, $product->id);
        $product->update($data);
        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }

    private function validated(Request $request, $id = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'nullable|string|max:255',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'use_case' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'caracteristics' => 'nullable|array',
            'reference' => 'nullable|string|max:255',
            'price1' => 'nullable|numeric|min:0',
            'price2' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0|max:100',
            'is_new' => 'boolean',
            'image1' => 'nullable|string|max:1024',
            'image2' => 'nullable|string|max:1024',
            'image3' => 'nullable|string|max:1024',
            'image4' => 'nullable|string|max:1024',
            'image5' => 'nullable|string|max:1024',
            'is_active' => 'boolean',
        ]);
    }

    private function fetchProducts(array $filters = []): Collection
    {
        $apiKey = env('GOOGLE_API_KEY');
        $spreadsheetId = env('GOOGLE_SPREADSHEET_ID');
        $sheetName = "Products";

        $response = Http::get("https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$sheetName}?key={$apiKey}");
        $data = $response->json();

        $products = collect();

        if (isset($data['values']) && count($data['values']) > 1) {
            $headers = $data['values'][0];
            foreach (array_slice($data['values'], 1) as $row) {
                $products->push(array_combine($headers, $row));
            }
        }

        // Apply filters if provided
        foreach ($filters as $filter) {
            [$column, $operator, $value] = $filter;

            $products = $products->filter(function ($product) use ($column, $operator, $value) {
                if (!isset($product[$column])) return false;

                $fieldValue = $product[$column];

                switch (strtolower($operator)) {
                    case '=':
                    case '==':
                        return $fieldValue == $value;
                    case '!=':
                        return $fieldValue != $value;
                    case '>':
                        return $fieldValue > $value;
                    case '<':
                        return $fieldValue < $value;
                    case '>=':
                        return $fieldValue >= $value;
                    case '<=':
                        return $fieldValue <= $value;
                    case 'like': // basic case-insensitive contains
                        return stripos($fieldValue, $value) !== false;
                    default:
                        return false;
                }
            });
        }

        return $products->values(); // reset keys
    }

    private function fetchProduct($id)
    {
        return $this->fetchProducts([['id', '=', $id]])->first();
    }

    public function indexSheet()
    {
        // Example: filter by category = "Shoes" and brand like "Nike"
        $products = $this->fetchProducts([
            ['category', '=', 'Shoes'],
            ['brand', 'like', 'Nike']
        ]);

        return view('products.index', compact('products'));
    }

    public function showSheet($id)
    {
        $product = $this->fetchProduct($id);

        return view('products.show', compact('product'));
    }
}
