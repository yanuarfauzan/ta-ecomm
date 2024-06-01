<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voucher = Voucher::all();
        return view('ADMIN.voucher.list', compact('voucher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ADMIN.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'voucher_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'voucher_code' => 'required|string|unique:voucher,voucher_code|max:255',
            'desc' => 'nullable|string',
            'requirement' => 'nullable|string',
            'discount_value' => 'required|numeric|min:0',
            'expired_at' => 'required|date|after_or_equal:today',
        ]);

        $voucherIconPath = null;
        if ($request->hasFile('voucher_icon')) {
            $voucherIcon = $request->file('voucher_icon');
            $voucherIconName = time() . '.' . $voucherIcon->getClientOriginalExtension();
            $voucherIconPath = $voucherIcon->storeAs('public/icon-voucher', $voucherIconName);
            // $voucherIcon->move(public_path('voucher_icons'), $voucherIconName);
            $voucherIconPath = 'icon-voucher/' . $voucherIconName;
        }

        $is_active = $request->expired_at > now() ? 1 : 0;

        $voucher = new Voucher();
        $voucher->id = Uuid::uuid4()->toString();
        $voucher->name = $request->name;
        $voucher->voucher_icon = $voucherIconPath;
        $voucher->voucher_code = $request->voucher_code;
        $voucher->desc = $request->desc;
        $voucher->requirement = $request->requirement;
        $voucher->discount_value = $request->discount_value;
        $voucher->expired_at = $request->expired_at;
        $voucher->is_active = $is_active;

        $voucher->save();

        return redirect('/admin/list-voucher')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('ADMIN.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'voucher_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'voucher_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vouchers')->ignore($voucher),
            ],
            'desc' => 'nullable|string',
            'requirement' => 'nullable|string',
            'discount_value' => 'required|numeric|min:0',
            'expired_at' => 'required|date',
            'is_active' => 'required|boolean',
        ]);
    
        $voucherIconPath = $voucher->voucher_icon;
    
        if ($request->hasFile('voucher_icon')) {
            // Menghapus gambar lama jika ada
            if ($voucher->voucher_icon) {
                Storage::delete($voucher->voucher_icon);
            }
            
            // Mengunggah gambar baru
            $voucherIconPath = $request->file('voucher_icon')->store('voucher_icons');
        }
    
        $is_active = $request->is_active ? true : false;
    
        $voucher->update([
            'name' => $request->name,
            'voucher_icon' => $voucherIconPath,
            'voucher_code' => $request->voucher_code,
            'desc' => $request->desc,
            'requirement' => $request->requirement,
            'discount_value' => $request->discount_value,
            'expired_at' => $request->expired_at, 
            'is_active' => $is_active,
        ]);

        return redirect('/admin/list-product')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
