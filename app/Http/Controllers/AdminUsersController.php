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
        $users = User::orderBy('username')->get();
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
        $validatedUserData = $request->validate([
            'username' => 'required|string|unique:user',
            'email' => 'required|string|email|unique:user',
            'phone_number' => 'nullable|string|unique:user',
            'password' => 'required|string|min:6',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => 'nullable|string',
            'role' => 'required|in:user,admin,operator'
        ]);

        $user = new User();
        $user->fill($validatedUserData);
        $user->password = Hash::make($validatedUserData['password']);
        $user->is_verified = 1;
        $user->save();

        $validatedAddressData = $request->validate([
            'address.*.detail' => 'required|string',
            'address.*.postal_code' => 'required|string',
            'address.*.address' => 'required|string',
            'address.*.city' => 'required|string',
            'address.*.province' => 'required|string',
        ]);

        foreach ($validatedAddressData['address'] as $addressData) {
            $address = new Address();
            $address->fill($addressData);
            $address->is_default = 1;
            $user->usersAddress()->save($address);
        }

        $users = User::all();
        $address = Address::all();

        return view('ADMIN.users.list', compact('users', 'address'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('ADMIN.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd('update method is called');
        // dd($request->all());
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

        return redirect()->to('/admin/list-users')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->usersAddress()->delete();

        $user->delete();

        return redirect()->to('/admin/list-users')->with('delete', 'User deleted successfully');
    }
}
