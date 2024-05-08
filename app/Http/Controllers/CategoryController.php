<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('ADMIN.category.list', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ADMIN.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $iconPath = null;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('icon-category'), $iconName);
            $iconPath = 'icon-category/' . $iconName;
        }

        Category::create([
            'name' => $request->name,
            'icon' => $iconPath,
        ]);

        return redirect('/admin/list-category')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('ADMIN.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('icon-category'), $iconName);
            $iconPath = 'icon-category/' . $iconName;

            $category->update([
                'name' => $request->name,
                'icon' => $iconPath
            ]);
        } else {
            $category->update([
                'name' => $request->name,
            ]);
        }

        return redirect('/admin/list-category')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->to('/admin/list-category')->with('delete', 'Data Kategori Telah Dihapus');
    }
}
