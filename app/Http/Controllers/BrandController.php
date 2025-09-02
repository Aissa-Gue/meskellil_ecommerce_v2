<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbData = [
            'title' => 'Brands',
            'bgColor' => '#F8F9FA',
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Brands',
                    'url' => null
                ]
            ]
        ];

        $brands = Brand::query()
            ->search($request->get('search'))
            ->orderBy('name')
            ->paginate(30)
            ->withQueryString();

        return view('brands.index', compact('brands', 'breadcrumbData'));
    }

    public function show(Brand $brand)
    {
        $breadcrumbData = [
            'title' => $brand->name,
            'bgColor' => '#F8F9FA',
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Brands',
                    'url' => route('brands.index')
                ],
                [
                    'name' => $brand->name,
                    'url' => null
                ]
            ]
        ];

        $brand->load(['products' => fn($q) => $q->latest()]);
        return view('brands.show', compact('brand', 'breadcrumbData'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255|unique:brands,name',
            'description'=>'nullable|string',
            'is_active'=>'boolean'
        ]);
        $brand = Brand::create($data);
        return redirect()->route('brands.show', $brand);
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255|unique:brands,name,'.$brand->id,
            'description'=>'nullable|string',
            'is_active'=>'boolean'
        ]);
        $brand->update($data);
        return back();
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back();
    }
}
