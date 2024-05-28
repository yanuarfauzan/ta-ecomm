<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        if ($validatedUserData->fails()){
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

            if ($validatedAddressData->fails()){
                return response()->json(['message' => $validatedAddressData->errors()]);
            }


            foreach ($validatedAddressData['address'] as $addressData) {
                $address = new Address();
                $address->fill($addressData);
                $address->is_default = 1;
                $users->usersAddress()->save($address);
            }
        }
        return view('ADMIN.users.list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('ADMIN.users.edit', compact('user'))->with('success', 'Users Berhasil Dibuat');
    }

    public function update(Request $request, $id)
    {
        $validatedUserData = $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email',
            'phone_number' => 'nullable|string',
            'password' => 'nullable|string|min:6',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => 'nullable|string',
            'role' => 'required|in:user,admin,operator'
        ]);

        $user = User::findOrFail($id);
        $user->fill($validatedUserData);

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->filled('address')) {
            foreach ($request->address as $addressData) {
                if (isset($addressData['id'])) {
                    $address = Address::findOrFail($addressData['id']);
                    $address->update([
                        'address' => $addressData['address'],
                        'detail' => $addressData['detail'],
                        'postal_code' => $addressData['postal_code'],
                        'city' => $addressData['city'],
                        'province' => $addressData['province'],
                    ]);
                }
            }
        }

        return redirect()->to('/admin/list-users')->with('success', 'Users Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->usersAddress->delete();

        $user->delete();

        return redirect()->to('/admin/list-users')->with('delete', 'Users Telah Dihapus');
    }
}
