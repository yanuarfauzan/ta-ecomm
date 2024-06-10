<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\ImageResolution;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function indexAdmin()
    {
        $user = Auth::user();
        return view('ADMIN.partial.profile', compact('user'));
    }
    
    public function indexOperator()
    {
        $user = Auth::user();
        return view('OPERATOR.partial.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Ambil user berdasarkan ID

        // Validasi data
        $validatedUserData = Validator::make($request->all(), [
            'username' => ['required', 'alpha_dash', 'min:3', 'max:20', Rule::unique('user', 'username')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('user', 'email')->ignore($user->id), 'max:255'],
            'phone_number' => 'required|numeric|digits_between:10,15',
            'password' => [
                'nullable',
                'confirmed',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'different:username'
            ],
            'password_confirmation' => 'nullable|required_with:password|same:password',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
        ]);
    
        if ($validatedUserData->fails()) {
            return back()->withErrors($validatedUserData->errors())->withInput();
        }
    
        // Update user data
        $user->username = $request->input('username', $user->username);
        $user->email = $request->input('email', $user->email);
        $user->phone_number = $request->input('phone_number', $user->phone_number);
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->gender = $request->input('gender', $user->gender);
        $user->birtdate = $request->input('birtdate', $user->birtdate);
    
        if ($request->has('role')) {
            $user->role = $request->role;
        } else {
            $user->role = $user->role;
        }
    
        $user->is_verified = 1;
    
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }
    
        if ($user->isDirty()) {
            $user->save();
        }
    
        if ($user->role == 'user' || $user->role == 'operator') {
            $validatedAddressData = Validator::make($request->all(), [
                'address.*.recipient_name' => 'required|string',
                'address.*.address' => 'required|string',
                'address.*.detail' => 'required|string',
                'address.*.postal_code' => 'required|string',
                'address.*.city' => 'required|string',
                'address.*.province' => 'required|string',
            ]);
    
            if ($validatedAddressData->fails()) {
                return back()->withErrors($validatedAddressData->errors())->withInput();
            }
    
            $user->userAddresses()->delete();
    
            foreach ($request->address as $addressData) {
                $user->userAddresses()->create($addressData);
            }
        }
        return redirect()->to('/admin');
    }
}
