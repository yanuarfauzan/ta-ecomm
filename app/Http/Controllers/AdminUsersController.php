<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::with('userAddresses')->orderBy('username')->get();
        $address = Address::all();
        return view('ADMIN.users.list', compact('users', 'address'));
    }

    public function create()
    {
        return view('ADMIN.users.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedUserData = Validator::make($request->all(), [
            'username' => 'required|string|unique:user',
            'email' => 'required|string|email|unique:user',
            'phone_number' => 'nullable|string|unique:user',
            'password' => 'required|string|min:6',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'role' => 'required|in:user,admin,operator'
        ]);

        if ($validatedUserData->fails()) {
            return response()->json(['message' => $validatedUserData->errors()]);
        }

        $users = new User();
        $users->username = $request->username;
        $users->email = $request->email;
        $users->phone_number = $request->phone_number;
        $users->password = Hash::make($request->password);
        $users->gender = $request->gender;
        $users->birtdate = $request->birtdate;
        $users->role = $request->role;
        $users->is_verified = 1;

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $users->profile_image = $path;
        }

        $users->save();
        if ($request->role == 'user') {
            $validatedAddressData = Validator::make($request->all(), [
                'address.*.detail' => 'required|string',
                'address.*.postal_code' => 'required|string',
                'address.*.address' => 'required|string',
                'address.*.city' => 'required|string',
                'address.*.province' => 'required|string',
            ]);

            if ($validatedAddressData->fails()) {
                return response()->json(['message' => $validatedAddressData->errors()]);
            }

            foreach ($request->address as $addressData) {
                $users->userAddresses()->create($addressData);
            }
        }
        $users = User::all();
        return view('ADMIN.users.list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('ADMIN.users.edit', compact('user'))->with('success', 'Users Berhasil Dibuat');
    }

    public function update(Request $request, $id)
    {
        $validatedUserData = Validator::make($request->all(), [
            'username' => 'required|string|unique:user,username,' . $id,
            'email' => 'required|string|email|unique:user,email,' . $id,
            'phone_number' => 'nullable|string|unique:user,phone_number,' . $id,
            'password' => 'nullable|string|min:6',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'role' => 'required|in:user,admin,operator'
        ]);

        if ($validatedUserData->fails()) {
            return response()->json(['message' => $validatedUserData->errors()]);
        }

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->gender = $request->gender;
        $user->birtdate = $request->birtdate;
        $user->role = $request->role;
        $user->is_verified = 1;

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        if ($request->role == 'user') {
            $validatedAddressData = Validator::make($request->all(), [
                'address.*.detail' => 'required|string',
                'address.*.postal_code' => 'required|string',
                'address.*.address' => 'required|string',
                'address.*.city' => 'required|string',
                'address.*.province' => 'required|string',
            ]);

            if ($validatedAddressData->fails()) {
                return response()->json(['message' => $validatedAddressData->errors()]);
            }

            $user->userAddresses()->delete();

            foreach ($request->address as $addressData) {
                $user->userAddresses()->create($addressData);
            }
        }

        $users = User::all();
        return view('ADMIN.users.list', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        foreach ($user->userAddresses as $address) {
            $address->delete();
        }

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->delete();

        return redirect()->to('/admin/list-users')->with('delete', 'Users Telah Dihapus');
    }
}
