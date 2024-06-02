<div class="container" style="width: 100%; height: 100%">
    <div class="card-product" class="d-flex flex-column" style="width: 100%; height: 100%;">
        <ul class="nav d-flex justify-content-evenly align-items-center">
            <li class="nav-item">
                <a class="nav-link font-main-color" href="#">Bio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Pesanan saya</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Alamat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Notification</a>
            </li>
        </ul>
        <hr class="card-product mt-0">
        <div class="d-flex justify-content-center align-items-top gap-2 mx-4 mb-4">
            <div style="width: 50%; height: auto;">
                <div class="d-flex justify-content-between align-items-top gap-2">
                    <div class="d-flex flex-column justify-content-between align-items-center gap-2 ms-4 my-4"
                        style="width: 50%;">
                        <div class="" style="width: 100%; height: 250px;">
                            <img src="{{ Storage::url('public/profile_pictures/' . $user->profile_image) }}" alt="" style="width: 100%; height: 100%">
                        </div>
                        <div class="card-product d-flex justify-content-center align-items-center"
                            style="cursor: pointer; width: 100%; height: 50px;">
                            <span style="cursor: pointer;" onclick="document.getElementById('profileImage').click()">
                                <h5 class="">Change photo</h5>
                            </span>
                            <input type="file" wire:model.lazy="profileImage" id="profileImage" name="file" style="display: none;">
                        </div>
                        <div class="" style="width: 100%; height: 50px;">
                            <span style="cursor: pointer;">
                                <button role="button" class="btn rounded-0 bg-main-color text-white"
                                    style="width: 100%; height: 50px;"><strong>Change Password</strong></button>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-start align-items-center gap-3 me-4 mb-4 mt-5"
                        style="width: 50%;">
                        <div class="input-group" style="height: 55px">
                            <input wire:model.lazy="username" type="text" class="form-control rounded-0" id="username"
                                name="username" style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input wire:model.lazy="birtdate" type="text" class="form-control rounded-0" id="email"
                                name="birth_of_date" style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center gap-4 align-items-center input-group"
                                style="height: 55px">
                                <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                    <input wire:model.lazy="gender1" class="form-check-input" type="radio" value="1"
                                        name="gender" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                    <input wire:model.lazy="gender2" class="form-check-input" type="radio" value="0"
                                        name="gender" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input wire:model="email" type="email" class="form-control rounded-0" id="no_handphone"
                                style="box-shadow: none; width: 100%; height: 40px;" disabled>
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input wire:model="phoneNumber" type="number" class="form-control rounded-0"
                                id="no_handphone" style="box-shadow: none; width: 100%; height: 40px;" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-product mt-4 d-flex flex-column justify-content-center align-items-center"
                style="width: 50%; height: auto;">
                <div class="d-flex justify-content-between align-items-center w-100 mt-2 mb-1">
                    <span>
                        <h6 class="mt-2 ms-3"><strong>Alamat</strong></h6>
                    </span>
                    <button id="checkout"
                        class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center mt-2 me-4"
                        data-bs-toggle="modal" data-bs-target="#addAddress" style="width: 28%; height: 30px;">tambah
                        alamat</button>
                </div>
                <div class="d-flex flex-column justify-content-start align-items-center pb-4"
                    style="overflow-y: scroll; height: 350px;">
                    @foreach ($addresses as $address)
                        <div class="card-product p-2 d-flex flex-column justify-content-start align-items-start"
                            style="width: 95%; height: auto; margin-top: 20px;">
                            <span><strong>{{ $address->recipient_name }}</strong>
                                {{ $address->phone_number }}</span>
                            <span><i class="bi bi-geo-alt"></i>{{ $address->address }} -
                                {{ $address->detail }}</span>
                            <div class="d-flex justify-content-end mt-2 w-100 gap-2">
                                <button
                                    class="btn rounded-0 bg-danger text-white d-flex justify-content-center align-items-center" wire:click="deleteAddress('{{ $address->id }}')"
                                    style="width: 30%; height: 30px;">hapus</button>
                                <button
                                    class="btn rounded-0 bg-main-color text-white d-flex justify-content-center align-items-center" wire:click="editAddress('{{ $address->id }}')"
                                    data-bs-toggle="modal" data-bs-target="#changeAddress-{{ $address->id }}"
                                    style="width: 30%; height: 30px;">edit alamat</button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
    </div>
    {{-- modal address --}}
    <div wire:ignore.self class="modal fade" id="addAddress" tabindex="-1"
        aria-labelledby="changeAddress" aria-hidden="true" wire:key="modal">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <span class="mt-4 mx-4"><strong>Tambah Alamat</strong></span>
                <hr>
                <div class="modal-body">
                    <form wire:submit.prevent="addAddress('{{ $address->id }}')">
                        <div class="mt-2">
                            <label for="recepient_name">Nama penerima</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                                name="recepient_name" wire:model="recipient_name"
                                style="box-shadow: none; width: 100%; height: 50px;" required>
                        </div>

                        <div class="">
                            <label for="address">Alamat lengkap</label>
                            <textarea type="text" class="form-control rounded-0 mt-2" id="address" name="address" wire:model="address"
                                style="box-shadow: none; width: 100%; height: 50px;" required></textarea>
                        </div>
                        <div class="mt-2">
                            <label for="province">Provinsi</label>
                            <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                id="province" wire:model="province" name="province" required>
                                <option value="">pilih provinsi</option>
                                @foreach ($provincies as $key => $value)
                                    <option value="{{ $value }}" wire:key="province-{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="province">Kota</label>
                            <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                id="city" wire:model="city" name="city" required>
                                <option value="">pilih kota</option>
                                @foreach ($cities as $key => $value)
                                    <option value="{{ $value }}" wire:key="city-{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="detail">Detail</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                                name="detail" wire:model="detail"
                                style="box-shadow: none; width: 100%; height: 50px;" required>
                        </div>
                        <div class="mt-2">
                            <label for="postal_code">Kode pos</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                                name="postal_code" wire:model="postal_code"
                                style="box-shadow: none; width: 100%; height: 50px;" required>
                        </div>
                        <div class="d-flex justify-content-end align-items-center gap-2 mt-4 me-4 mb-4">
                            <button class="btn rounded-0 bg-danger text-white" style="width: 20%;"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAddress"><strong>kembali</strong></button>
                            <button type="submit" id="checkout" class="btn rounded-0 bg-main-color text-white"
                                style="width: 20%;" data-bs-toggle="modal"
                                data-bs-target="#modalAddress"><strong>tambah</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($addresses as $address)
        <div wire:ignore.self class="modal fade" id="changeAddress-{{ $address->id }}" tabindex="-1"
            aria-labelledby="changeAddress" aria-hidden="true" wire:key="modal-{{ $address->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <span class="mt-4 mx-4"><strong>Ubah Alamat</strong></span>
                    <hr>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateAddress('{{ $address->id }}')">
                            <div class="mt-2">
                                <label for="recepient_name">Nama penerima</label>
                                <input type="text" class="form-control rounded-0 mt-2" id="username"
                                    name="recepient_name" wire:model="recipient_name"
                                    style="box-shadow: none; width: 100%; height: 50px;" required>
                                @error('recipientName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="">
                                <label for="address">Alamat lengkap</label>
                                <textarea type="text" class="form-control rounded-0 mt-2" id="address" name="address" wire:model="address"
                                    style="box-shadow: none; width: 100%; height: 50px;" required></textarea>
                            </div>
                            <div class="mt-2">
                                <label for="province">Provinsi</label>
                                <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                    id="province" wire:model="province" name="province" required>
                                    <option value="">pilih provinsi</option>
                                    @foreach ($provincies as $key => $value)
                                        <option value="{{ $value }}" wire:key="province-{{ $key }}"
                                            {{ $province == $address->province ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="province">Kota</label>
                                <select class="form-select form-select-lg rounded-0" aria-label="Large select example"
                                    id="city" wire:model="city" name="city" required>
                                    <option value="">pilih kota</option>
                                    @foreach ($cities as $key => $value)
                                        <option value="{{ $value }}" wire:key="city-{{ $key }}"
                                            {{ $city == $address->city ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="detail">Detail</label>
                                <input type="text" class="form-control rounded-0 mt-2" id="username"
                                    name="detail" wire:model="detail"
                                    style="box-shadow: none; width: 100%; height: 50px;" required>
                                @error('detail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <label for="postal_code">Kode pos</label>
                                <input type="text" class="form-control rounded-0 mt-2" id="username"
                                    name="postal_code" wire:model="postal_code"
                                    style="box-shadow: none; width: 100%; height: 50px;" required>
                                @error('postal_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end align-items-center gap-2 mt-4 me-4 mb-4">
                                <button class="btn rounded-0 bg-danger text-white" style="width: 20%;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAddress"><strong>kembali</strong></button>
                                <button type="submit" id="checkout" class="btn rounded-0 bg-main-color text-white"
                                    style="width: 20%;" data-bs-toggle="modal"
                                    data-bs-target="#modalAddress"><strong>ubah</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
