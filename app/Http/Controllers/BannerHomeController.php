<?php

namespace App\Http\Controllers;

use App\Models\BannerHome;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bannerHome = BannerHome::paginate(10);
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
        $validatedBannerHome = Validator::make($request->all(), [
            'banner_image' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1024, 300) 
            ],
            'desc' => 'required|string|max:255',
        ]);    

        if($validatedBannerHome->fails()) {
            return back()->withErrors($validatedBannerHome->errors())->withInput();
        }

        $bannerPath = null;

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerName = time() . '.' . $bannerImage->getClientOriginalExtension();
            $bannerPath = $bannerImage->storeAs('public/banner-image', $bannerName);
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
    public function edit($id)
    {
        $bannerHome = BannerHome::findOrFail($id);
        return view('ADMIN.banner.edit', compact('bannerHome'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedBannerHome = Validator::make($request->all(), [
            'banner_image' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1024, 300)
            ],
            'desc' => 'required|string|max:255',
        ]);

        if($validatedBannerHome->fails()) {
            return back()->withErrors($validatedBannerHome->errors())->withInput();
        }
    
        $banner = BannerHome::findOrFail($id);
        $bannerPath = $banner->banner_image;
    
        if ($request->hasFile('banner_image')) {
            if ($bannerPath && Storage::exists($bannerPath)) {
                Storage::delete($bannerPath);
            }
    
            $bannerImage = $request->file('banner_image');
            $bannerName = time() . '.' . $bannerImage->getClientOriginalExtension();
            $bannerPath = $bannerImage->storeAs('public/banner-image', $bannerName);
            $bannerPath = 'banner-image/' . $bannerName;
        }
    
        $banner->update([
            'banner_image' => $bannerPath,
            'desc' => $request->desc,
        ]);
    
        return redirect('/admin/list-banner')->with('success', 'Banner Home Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = BannerHome::findOrFail($id);

    if ($banner->banner_image && Storage::exists('public/' . $banner->banner_image)) {
        Storage::delete('public/' . $banner->banner_image);
    }

    $banner->delete();

    return redirect('/admin/list-banner')->with('delete', 'Banner Home Telah Dihapus');
    }
}
