<?php

namespace App\Livewire;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Rules\ImageResolution;
use App\Models\ProvinciesAndCities;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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
    public $add_recipient_name;
    public $add_address;
    public $add_province;
    public $add_city;
    public $add_postal_code;
    public $add_detail;
    public $oldPassword;
    public $newPassword;
    public $newPassword_confirmation;
    public $isValidated = false;
    public $pendingOrders;
    public $packedOrders;
    public $deliveredOrders;
    public $completedOrders;
    public $cancelledOrders;
    public $historyDelivery;
    public $rating;
    public $content;
    public $attachment;
    public $tabActive = 'pending';
    public function mount($user)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $this->user = $user;
        $this->pendingOrders = $user->order()->where('order_status', 'pending')->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();
        $this->packedOrders = $user->order()->where('order_status', 'proceed')->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();
        $this->deliveredOrders = $user->order()->whereIn('order_status', ['delivered', 'shipped'])->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();

        if ($this->deliveredOrders) {
            $this->deliveredOrders->each(function ($order) {
                $this->getHistoryDelivery($order);
            });
        }

        $this->completedOrders = $user->order()->where('order_status', 'completed')->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();
        $this->cancelledOrders = $user->order()->where('order_status', 'cancelled')->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();
        $this->username = $user->username;
        $this->birtdate = $user->birtdate;
        $user->gender == 1 ? $this->gender1 = $user->gender : $this->gender2 = $user->gender;
        $this->email = $user->email;
        $this->phoneNumber = $user->phone_number;
        $this->addresses = $user->userAddresses()->get();

        $this->provincies = collect(ProvinciesAndCities::pluck('province')->unique());
        $this->cities = collect(ProvinciesAndCities::pluck('city_name')->unique());
    }
    public function storeRating($rating)
    {
        $this->rating = $rating;
        $this->tabActive = 'completed';
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
    public function updatePassword()
    {
        $validatedData = $this->validate([
            'oldPassword' => 'required',
            'newPassword' => [
                'required',
                'confirmed',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'different:username'
            ]
        ], [
            'oldPassword.required' => 'Password lama tidak boleh kosong',
            'newPassword.required' => 'Password baru tidak boleh kosong',
            'newPassword.confirmed' => 'Konfirmasi password baru salah',
            'newPassword.string' => 'Password harus berupa string',
            'newPassword.min' => 'Panjang password minimal 8 karakter',
            'newPassword.regex' => 'Password harus mengandung huruf besar dan huruf kecil, angka, simbol dan spasi',
            'newPassword.different' => 'Password dan username tidak boleh sama',
        ]);

        $password = $this->user->password;
        if (Hash::check($validatedData['oldPassword'], $password)) {
            $this->user->update(['password' => Hash::make($validatedData['newPassword'])]);
            $this->dispatch('closeModalChangePassword');
        } else {
            $this->addError('oldPassword', 'Password lama salah');
        }
    }
    public function setToDefaultAddress($addressId)
    {
        Address::where('is_default', true)->first()->update(['is_default' => false]);
        Address::findOrFail($addressId)->update(['is_default' => true]);
        $this->addresses = $this->user->userAddresses()->get();
    }
    public function updatedProfileImage()
    {
        $uuid = Str::uuid();
        $extension = $this->profileImage->extension();
        $filename = $uuid . '.' . $extension;
        $this->profileImage->storeAs('public/profile_images', $filename);
        $this->user->update(['profile_image' => $filename]);
    }
    public function updateAddress($addressId)
    {
        $validatedData = $this->validate([
            'recipient_name' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'detail' => 'required',
        ], [
            'recipient_name.required' => 'Nama penerima tidak boleh kosong',
            'address.required' => 'Alamat lengkap tidak boleh kosong',
            'province.required' => 'Provinsi tidak boleh kosong',
            'city.required' => 'Kota tidak boleh kosong',
            'postal_code.required' => 'Kode pos tidak boleh kosong',
            'detail.required' => 'detail tidak boleh kosong',
        ]);
        $updateAddress = $this->user->userAddresses()->where('id', $addressId)->first();
        $updateAddress->update([
            'recipient_name' => $validatedData['recipient_name'],
            'address' => $validatedData['address'],
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
            'detail' => $validatedData['detail'],
        ]);
        $this->dispatch('closeModalEditAddress');
        $this->reset(['recipient_name', 'address', 'province', 'city', 'postal_code', 'detail']);
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
        $validatedData = $this->validate([
            'add_recipient_name' => 'required',
            'add_address' => 'required',
            'add_province' => 'required',
            'add_city' => 'required',
            'add_postal_code' => 'required',
            'add_detail' => 'required',
        ], [
            'add_recipient_name.required' => 'Nama penerima tidak boleh kosong',
            'add_address.required' => 'Alamat lengkap tidak boleh kosong',
            'add_province.required' => 'Provinsi tidak boleh kosong',
            'add_city.required' => 'Kota tidak boleh kosong',
            'add_postal_code.required' => 'Kode pos tidak boleh kosong',
            'add_detail.required' => 'detail tidak boleh kosong',
        ]);
        $this->user->userAddresses()->create([
            'recipient_name' => $validatedData['add_recipient_name'],
            'address' => $validatedData['add_address'],
            'province' => $validatedData['add_province'],
            'city' => $validatedData['add_city'],
            'postal_code' => $validatedData['add_postal_code'],
            'detail' => $validatedData['add_detail'],
        ]);
        $this->dispatch('closeModalAddAddress');
        $this->reset(['add_recipient_name', 'add_address', 'add_province', 'add_city', 'add_postal_code', 'add_detail']);
        $this->addresses = $this->user->userAddresses()->get();
    }
    public function createReview($id, $pickedVariationOption)
    {
        $validatedData = $this->validate([
            'rating' => 'required',
            'content' => 'required',
            'attachment' => [
                'image',
                'mimes:jpeg,png,jpg',
                'max:5120',
            ]
        ], [
            'rating.required' => 'Rating minimal satu bintang tidak boleh kosong',
            'content.required' => 'Pesan harus diisi tidak boleh kosong',
            'attachment.image' => 'File harus berupa foto/gamber',
            'attachment.mimes' => 'Format foto/gambar harus jpeg, png dan jpg',
            'attachment.max' => 'ukuran file foto/gambar maksimal 5mb',
        ]);
        $id = explode('_', $id);
        switch ($id[0]) {
            case 'by':
                $order = $this->user->order()
                    ->where('order.id', $id[1])
                    ->whereHas('pickedVariationOption', function ($query) use ($pickedVariationOption) {
                        $query->whereIn('variation_option.id', $pickedVariationOption);
                    })
                    ->firstOrFail();
                $productAssessment = $order->productAssessment()
                    ->create([
                        'user_id' => $this->user->id,
                        'product_id' => $order->product->id,
                        'rating' => $validatedData['rating'],
                        'content' => $validatedData['content']
                    ]);
                $uuid = Str::uuid();
                $extension = $validatedData['attachment']->extension();
                $filename = $uuid . '.' . $extension;
                $validatedData['attachment']->storeAs('public/attachments', $filename);
                $productAssessment->Attachments()->create([
                    'filepath_image' => $filename
                ]);
                $this->dispatch('closeModalCreateReview');
                $this->reset(['rating', 'content', 'attachment']);
                break;
            case 'cp':
                $cartProduct = $this->user->order()->with([
                    'cartProduct' => function ($query) use ($id, $pickedVariationOption) {
                        $query->where('cart_product.id', $id[1]) // menambahkan nama tabel atau alias
                            ->whereHas('product.pickedVariationOption', function ($query) use ($pickedVariationOption) {
                                $query->whereIn('variation_option.id', $pickedVariationOption); // menambahkan nama tabel atau alias
                            });
                    }
                ])->first()->cartProduct;
                $cartProduct->first()->update([
                    'is_reviewed' => true
                ]);
                $productAssessment = $cartProduct->first()->product->productAssessment()->create([
                    'user_id' => $this->user->id,
                    'content' => $validatedData['content'],
                    'rating' => $validatedData['rating'],
                ]);
                $uuid = Str::uuid();
                $extension = $validatedData['attachment']->extension();
                $filename = $uuid . '.' . $extension;
                $validatedData['attachment']->storeAs('public/attachments', $filename);
                $productAssessment->Attachments()->create([
                    'filepath_image' => $filename
                ]);
                $this->dispatch('closeModalCreateReviewCp');
                $this->reset(['rating', 'content', 'attachment']);
                break;
        }
        $this->tabActive = 'completed';
    }
    public function orderAccept($orderId)
    {
        $this->user->order()->findOrFail($orderId)->update([
            'order_status' => 'completed'
        ]);
        $this->tabActive = 'shipped';
        $this->deliveredOrders = $this->user->order()->whereIn('order_status', ['delivered', 'shipped'])->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();
        $this->completedOrders = $this->user->order()->where('order_status', 'completed')->with('cartProduct.product.hasImages', 'cartProduct.cart.hasProduct.pickedVariationOption', 'product')->get();
    }
    public function getHistoryDelivery($order)
    {
        $response = Http::get(env('API_BASE_URL_BINDERBYTE') . 'track', [
            'api_key' => env('API_KEY_BINDERBYTE'),
            'courier' => $order->shipping->provider_code,
            'awb' => $order->shipping->resi
        ]);
        $this->historyDelivery[$order->id] = $response->json();
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
