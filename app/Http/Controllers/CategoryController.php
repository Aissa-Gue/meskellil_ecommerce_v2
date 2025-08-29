<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()
            ->with('parent:id,name')
            ->search($request->get('search'))
            ->orderBy('name')
            ->paginate(30)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load(['parent:id,name','children:id,name,parent_id','products'=>fn($q)=>$q->latest()]);
        return view('categories.show', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'parent_id'=>'nullable|exists:categories,id',
            'is_active'=>'boolean'
        ]);
        $category = Category::create($data);
        return redirect()->route('categories.show', $category);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'parent_id'=>'nullable|exists:categories,id',
            'is_active'=>'boolean'
        ]);
        $category->update($data);
        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
