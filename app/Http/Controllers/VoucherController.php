<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:free ongkir,discount',
            'voucher_icon' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
            'voucher_code' => 'required|string|unique:voucher',
            'desc' => 'nullable|string',
            'min_value' => 'nullable|integer',
            'discount_value' => 'nullable|integer',
            'expired_at' => 'required|date',
        ]);

        $isActive = $request->input('expired_at') >= now();

        $voucher = new Voucher([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'voucher_code' => $validatedData['voucher_code'],
            'desc' => $validatedData['desc'],
            'min_value' => $validatedData['min_value'],
            'discount_value' => $validatedData['discount_value'],
            'expired_at' => $validatedData['expired_at'],
            'is_active' => $isActive,
        ]);

        if ($voucher->expired_at <= now()) {
            $voucher->is_active = false;
        }

        if ($request->hasFile('voucher_icon')) {
            $imagePath = $request->file('voucher_icon')->storeAs('public/voucher-icon', $request->voucher_icon->getClientOriginalName());
            $voucher->voucher_icon = $imagePath;
        }

        $voucher->save();

        return redirect('/admin/list-voucher')->with('success', 'Voucher Berhasil Ditambahkan');
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:free ongkir,discount',
            'voucher_icon' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
            'voucher_code' => 'required|string|unique:voucher,voucher_code,' . $id,
            'desc' => 'nullable|string',
            'min_value' => 'nullable|integer',
            'discount_value' => 'nullable|integer',
            'expired_at' => 'required|date',
        ]);

        $voucher = Voucher::findOrFail($id);

        $voucher->name = $validatedData['name'];
        $voucher->type = $validatedData['type'];
        $voucher->voucher_code = $validatedData['voucher_code'];
        $voucher->desc = $validatedData['desc'];
        $voucher->min_value = $validatedData['min_value'];
        $voucher->discount_value = $validatedData['discount_value'];
        $voucher->expired_at = $validatedData['expired_at'];

        if ($request->hasFile('voucher_icon')) {
            $imagePath = $request->file('voucher_icon')->storeAs('public/voucher-icon', $request->voucher_icon->getClientOriginalName());
            $voucher->voucher_icon = $imagePath;
        }

        $voucher->save();

        return redirect('/admin/list-voucher')->with('success', 'Voucher Berhasil Diperbarui');
    }

    public function updateStatus($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->is_active = false; // Set status voucher menjadi expired
        $voucher->save();

        return redirect()->back()->with('alert', 'Status Voucher Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);

        $voucher->delete();
        return redirect('/admin/list-voucher')->with('delete', 'Voucher Telah Dihapus.');
    }
}
