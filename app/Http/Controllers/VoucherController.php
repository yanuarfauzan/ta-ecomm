<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voucher = Voucher::orderBy('name')->paginate(10);
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
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|in:free ongkir,discount',
            'voucher_icon' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
            'desc' => 'required|string',
            'min_value' => 'required|integer',
            'discount_value' => 'required|integer',
            'expired_at' => 'required|date',
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }

        $isActive = $request->input('expired_at') >= now();

        $voucher = new Voucher([
            'name' => $validatedData->validate()['name'],
            'type' => $validatedData->validate()['type'],
            'voucher_code' => $this->generateUniqueVoucherCode(),
            'desc' => $validatedData->validate()['desc'],
            'min_value' => $validatedData->validate()['min_value'],
            'discount_value' => $validatedData->validate()['discount_value'],
            'expired_at' => $validatedData->validate()['expired_at'],
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
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|in:free ongkir,discount',
            'voucher_icon' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
            'voucher_code' => 'required|string|unique:voucher,voucher_code,' . $id,
            'desc' => 'required|string',
            'min_value' => 'required|integer',
            'discount_value' => 'required|integer',
            'expired_at' => 'required|date',
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData->errors())->withInput();
        }

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
        $voucher->is_active = false;
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

    private function generateUniqueVoucherCode()
    {
        $prefix = '#EVC-';
        $uniqueCode = $prefix . strtoupper(Str::random(8));

        while (Voucher::where('voucher_code', $uniqueCode)->exists()) {
            $uniqueCode = $prefix . strtoupper(Str::random(8));
        }

        return $uniqueCode;
    }
}
