<?php

namespace App\Http\Controllers;

use App\Models\BannerHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bannerHome = BannerHome::all();
        return view('ADMIN.banner.list', compact('bannerHome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ADMIN.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'desc' => 'required|string|max:255',
        ]);

        $bannerPath = null;

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerName = time() . '.' . $bannerImage->getClientOriginalExtension();
            $bannerPath = $bannerImage->storeAs('public/banner-image', $bannerName);
            // $bannerImage->move(public_path('banner-image'), $bannerName);
            $bannerPath = 'banner-image/' . $bannerName;
        }

        BannerHome::create([
            'banner_image' => $bannerPath,
            'desc' => $request->desc,
        ]);

        return redirect('/admin/list-banner')->with('success', 'Banner Home Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(BannerHome $bannerHome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BannerHome $bannerHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BannerHome $bannerHome)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannerHome $bannerHome)
    {
        $bannerHome->delete();
        return redirect()->to('/admin/list-banner')->with('delete', 'Banner Home Telah Dihapus');
    }
}
