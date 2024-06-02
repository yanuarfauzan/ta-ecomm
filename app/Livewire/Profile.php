<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;
    public $user;
    public $profileImage;
    public $username;
    public $birtdate;
    public $gender1;
    public $gender2;
    public $email;
    public $phoneNumber;
    public $addresses;
    public $provincies;
    public $cities;
    public $recipient_name;
    public $address;
    public $province;
    public $city;
    public $postal_code;
    public $detail;

    public function mount($user)
    {
        $this->user = $user;
        $this->username = $user->username;
        $this->birtdate = $user->birtdate;
        $user->gender == 1 ? $this->gender1 = $user->gender : $this->gender2 = $user->gender;
        $this->email = $user->email;
        $this->phoneNumber = $user->phone_number;
        $this->addresses = $user->userAddresses()->get();

        $this->provincies = collect(ProvinciesAndCities::pluck('province')->unique());
        $this->cities = collect(ProvinciesAndCities::pluck('city_name')->unique());
    }
    public function updatedUsername()
    {
        $this->user->update(['username' => $this->username]);
    }
    public function updatedBirtdate()
    {
        $this->user->update(['birtdate' => $this->birtdate]);
    }
    public function updatedGender1()
    {
        $this->user->update(['gender' => $this->gender1]);
    }
    public function updatedGender2()
    {
        $this->user->update(['gender' => $this->gender2]);
    }
    public function updatedProfileImage()
    {
    $uuid = Str::uuid();
    $extension = $this->profileImage->extension();
    $filename = $uuid . '.' . $extension;
    $this->profileImage->storeAs('public/profile_pictures', $filename);
    $this->user->update(['profile_image' => $filename]);
    }
    public function updateAddress($addressId)
    {
        $updateAddress = $this->user->userAddresses()->where('id', $addressId)->first();
        $updateAddress->update([
            'recipient_name' => $this->recipient_name,
            'address' => $this->address,
            'province' => $this->province,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'detail' => $this->detail,
        ]);
        $this->addresses = $this->user->userAddresses()->get();
    }
    public function deleteAddress($addressId)
    {
        $deleteAddress = $this->user->userAddresses()->where('id', $addressId)->first();
        $deleteAddress->delete();
        $this->addresses = $this->user->userAddresses()->get();
    }   
    public function editAddress($addressId)
    {
        $editAddress = $this->user->userAddresses()->where('id', $addressId)->first();
        $this->address = $editAddress->address;
        $this->recipient_name = $editAddress->recipient_name;
        $this->province = $editAddress->province;
        $this->city = $editAddress->city;
        $this->postal_code = $editAddress->postal_code;
        $this->detail = $editAddress->detail;
        
    }
    public function addAddress()
    {
        $this->user->userAddresses()->create([
            'recipient_name' => $this->recipient_name,
            'address' => $this->address,
            'province' => $this->province,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'detail' => $this->detail,
        ]);
        $this->addresses = $this->user->userAddresses()->get();
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
