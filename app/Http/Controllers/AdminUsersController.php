<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\users;
use App\Rules\ImageResolution;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    public function home()
    {
        $title = 'Beranda Admin';
        return view('ADMIN.partial.home', compact('title'));
    }

    public function index()
    {
        $users = User::with('userAddresses')->orderBy('username')->paginate(10);
        $address = Address::all();
        $title = 'Pengguna';
        return view('ADMIN.users.list', compact('users', 'address', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Pengguna';
        return view('ADMIN.users.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedUserData = Validator::make($request->all(), [
            'username' => ['required', 'alpha_dash', 'min:3', 'max:20', 'unique:user,username'],
            'email' => ['required', 'email', Rule::unique('user', 'email'), 'max:255'],
            'phone_number' => 'required|numeric|digits_between:10,15',
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'different:username'
            ],
            'password_confirmation' => 'required_with:password|same:password',
            'gender' => 'required|integer|in:0,1',
            'birtdate' => 'required|date',
            'profile_image' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
                new ImageResolution(1080, 1080)
            ],
            'role' => 'in:user,admin,operator'
        ]);

        if ($validatedUserData->fails()) {
            return back()->withErrors($validatedUserData->errors())->withInput();
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

            foreach ($request->address as $addressData) {
                $users->userAddresses()->create($addressData);
            }
        }
        $users = User::with('userAddresses')->orderBy('username')->paginate(10);
        return view('ADMIN.users.list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $title = 'Edit Pengguna';
        return view('ADMIN.users.edit', compact('user', 'title'));
    }

    public function update(Request $request, $id)
    {
        $validatedUserData = Validator::make($request->all(), [
            'username' => ['required', 'alpha_dash', 'min:3', 'max:20', Rule::unique('user', 'username')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('user', 'email')->ignore($id), 'max:255'],
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

        $user = User::findOrFail($id);

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

            if ($request->has('address') && is_array($request->address)) {
                foreach ($request->address as $addressData) {
                    $user->userAddresses()->create($addressData);
                }
            }
        }

        $users = User::with('userAddresses')->orderBy('username')->paginate(10);
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
