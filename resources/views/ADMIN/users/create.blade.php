@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-users') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>PENGGUNA</h1>
        </div>

        <div class="section-body">
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>ISI DATA PENGGUNA</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-users') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        name="phone_number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0" {{ old('gender') == 0 ? 'checked' : '' }}>Perempuan</option>
                        <option value="1" {{ old('gender') == 1 ? 'checked' : '' }}>Laki-laki</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="birtdate" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control @error('birtdate') is-invalid @enderror" id="birtdate"
                        name="birtdate" value="{{ old('birtdate') }}">
                    @error('birtdate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror"
                        id="profile_image" name="profile_image" value="{{ old('profile_image') }}">
                    @error('profile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Peran</label>
                    <select class="form-control" id="role" name="role">
                        <option>Pilih Peran</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                </div>
                <div id="address-section" style="display: none;">
                    <h5>Alamat 1</h5>
                    <div class="mb-3">
                        <label for="recipient_name" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control @error('recipient_name') is-invalid @enderror"
                            id="recipient_name" name="address[0][recipient_name]" value="{{ old('recipient_name') }}">
                        @error('recipient_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('address.0.address') is-invalid @enderror"
                            id="address" name="address[0][address]" value="{{ old('address.0.address') }}">
                        @error('address.0.address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail Alamat</label>
                        <input type="text" class="form-control @error('address.0.detail') is-invalid @enderror"
                            id="detail" name="address[0][detail]" value="{{ old('address.0.detail') }}">
                        @error('address.0.detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control @error('address.0.postal_code') is-invalid @enderror"
                            id="postal_code" name="address[0][postal_code]" value="{{ old('address.0.postal_code') }}">
                        @error('address.0.postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota/Kabupaten</label>
                        <input type="text" class="form-control @error('address.0.city') is-invalid @enderror"
                            id="city" name="address[0][city]" value="{{ old('address.0.city') }}">
                        @error('address.0.city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Provinsi</label>
                        <input type="text" class="form-control @error('address.0.province') is-invalid @enderror"
                            id="province" name="address[0][province]" value="{{ old('address.0.province') }}">
                        @error('address.0.province')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="#" id="add-address">Tambah Alamat</a>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const addressSection = document.getElementById('address-section');
            const addAddressLink = document.getElementById('add-address');

            function toggleAddressSection() {
                if (roleSelect.value === 'user' || roleSelect.value === 'operator') {
                    addressSection.style.display = 'block';
                } else {
                    addressSection.style.display = 'none';
                }
            }

            roleSelect.addEventListener('change', toggleAddressSection);
            toggleAddressSection();

            let addressCount = 1;
            addAddressLink.addEventListener('click', function(event) {
                event.preventDefault();
                if (addressCount === 1) {
                    addressCount++;
                }
                const newAddressCount = addressCount++;
                const addressFields = `
                    <h5>Alamat ${newAddressCount}</h5>
                    <div class="address-item mb-3">
                        <label for="address_${newAddressCount}" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" id="address_${newAddressCount}" name="address[${newAddressCount}][recipient_name]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="address_${newAddressCount}" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address_${newAddressCount}" name="address[${newAddressCount}][address]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="detail_${newAddressCount}" class="form-label">Detail Alamat</label>
                        <input type="text" class="form-control" id="detail_${newAddressCount}" name="address[${newAddressCount}][detail]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="postal_code_${newAddressCount}" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" id="postal_code_${newAddressCount}" name="address[${newAddressCount}][postal_code]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="city_${newAddressCount}" class="form-label">Kota/Kabupaten</label>
                        <input type="text" class="form-control" id="city_${newAddressCount}" name="address[${newAddressCount}][city]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="province_${newAddressCount}" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="province_${newAddressCount}" name="address[${newAddressCount}][province]">
                    </div>
                `;
                addressSection.insertAdjacentHTML('beforeend', addressFields);
                addressSection.appendChild(addAddressLink);
                // addressCount++;
            });
        });
    </script>
@endsection
