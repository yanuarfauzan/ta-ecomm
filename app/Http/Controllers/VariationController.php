<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variations = Variation::all();
        return view('ADMIN.variation.list', compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ADMIN.variation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Variation::create([
            'name' => $request->name,
        ]);

        return redirect('/admin/list-variation')->with('success', 'Variasi Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $variations = Variation::findOrFail($id);
        return view('ADMIN.variation.edit', compact('variations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variation $variations)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $variations->update([
            'name' => $request->name,
        ]);

        return redirect('/admin/list-variation')->with('success', 'Variasi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variation $variations)
    {
        $variations->delete();
        return redirect()->to('/admin/list-variation')->with('delete', 'Variasi Telah Dihapus');
    }
}
