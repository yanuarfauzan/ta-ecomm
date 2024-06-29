<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Rules\ImageResolution;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('name')->paginate(10);
        $title = 'Kategori';
        return view('ADMIN.category.list', compact('category', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori';
        return view('ADMIN.category.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedCategory = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ]
        ]);

        if($validatedCategory->fails()) {
            return back()->withErrors($validatedCategory->errors())->withInput();
        }

        $iconPath = null;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $iconPath = $icon->storeAs('public/icon-category', $iconName);
            $iconPath = 'icon-category/' . $iconName;
        }

        Category::create([
            'name' => $request->name,
            'icon' => $iconPath,
        ]);

        return redirect('/admin/list-category')->with('success', 'Kategori Berhasil Dibuat');
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
        $title = 'Edit Kategori';
        return view('ADMIN.category.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedCategory = Validator::make($request->all(), [
            'name' => 'required',
            'icon' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ]
        ]);

        if($validatedCategory->fails()) {
            return back()->withErrors($validatedCategory->errors())->withInput();
        }

        if ($request->hasFile('icon')) {
            if ($category->icon && Storage::exists($category->icon)) {
                Storage::delete($category->icon);
            }
    
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $iconPath = $icon->storeAs('public/icon-category', $iconName);
    
            $category->update([
                'name' => $request->name,
                'icon' => 'icon-category/' . $iconName
            ]);
        } else {
            $category->update([
                'name' => $request->name,
            ]);
        }
    

        return redirect('/admin/list-category')->with('success', 'Kategori Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->to('/admin/list-category')->with('delete', 'Kategori Telah Dihapus');
    }
}
