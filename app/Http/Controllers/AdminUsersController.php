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
        if ($request->role == 'user' || $request->role == 'operator') {
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
        // Validasi data pengguna
        $validatedUserData = Validator::make($request->all(), [
            'username' => 'required|string|unique:user,username,' . $id,
            'email' => 'required|string|email|unique:user,email,' . $id,
            'phone_number' => 'nullable|string|unique:user,phone_number,' . $id,
            'password' => 'nullable|string|min:6',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        if ($validatedUserData->fails()) {
            return response()->json(['message' => $validatedUserData->errors()]);
        }

        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update field user jika ada perubahan
        $user->username = $request->input('username', $user->username);
        $user->email = $request->input('email', $user->email);
        $user->phone_number = $request->input('phone_number', $user->phone_number);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->gender = $request->input('gender', $user->gender);
        $user->birtdate = $request->input('birtdate', $user->birtdate);

        // Jika role tidak dikirim, gunakan nilai asli dari database
        if ($request->has('role')) {
            $user->role = $request->role;
        } else {
            $user->role = $user->role;
        }

        $user->is_verified = 1;

        // Update profile image jika ada
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        // Periksa apakah ada perubahan data
        if ($user->isDirty()) {
            // Simpan data user jika ada perubahan
            $user->save();
        }

        // Jika role user adalah 'user', lakukan validasi dan update address
        if ($user->role == 'user') {
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

            // Hapus alamat yang ada
            $user->userAddresses()->delete();

            // Buat alamat baru
            foreach ($request->address as $addressData) {
                $user->userAddresses()->create($addressData);
            }
        }

        // Ambil semua data pengguna dan kembalikan ke tampilan list users
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
