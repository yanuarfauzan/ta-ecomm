@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-users') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>EDIT USER</h1>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/update-users/' . $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username', $user->username) }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Perempuan</option>
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Laki-laki</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="birtdate" class="form-label">Tanggal lahir</label>
                    <input type="date" class="form-control @error('birtdate') is-invalid @enderror" id="birtdate"
                        name="birtdate" value="{{ old('birtdate', $user->birtdate) }}">
                    @error('birtdate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="profile_image">Profile Image</label>
                    @if ($user->profile_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image"
                                style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror"
                        id="profile_image" name="profile_image" value="{{old('profile_image', $user->profile_image)}}">
                    @error('profile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" disabled>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                </div>
                @foreach ($user->userAddresses as $index => $address)
                    <h6>Alamat {{ $index + 1 }}</h6>
                    <div class="mb-3">
                        <label for="recipient_name{{ $index }}" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control @error('recipient_name') is-invalid @enderror"
                            id="recipient_name{{ $index }}" name="address[{{ $index }}][recipient_name]"
                            value="{{ old('address.' . $index . '.recipient_name', $address->recipient_name) }}">
                        @error('recipient_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="address[{{ $index }}][id]" value="{{ $address->id }}">
                    <div class="mb-3">
                        <label for="address{{ $index }}" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            id="address{{ $index }}" name="address[{{ $index }}][address]"
                            value="{{ old('address.' . $index . '.address', $address->address) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="detail{{ $index }}" class="form-label">Detail Alamat</label>
                        <input type="text" class="form-control @error('detail') is-invalid @enderror"
                            id="detail{{ $index }}" name="address[{{ $index }}][detail]"
                            value="{{ old('address.' . $index . '.detail', $address->detail) }}">
                        @error('detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="postal_code{{ $index }}" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                            id="postal_code{{ $index }}" name="address[{{ $index }}][postal_code]"
                            value="{{ old('address.' . $index . '.postal_code', $address->postal_code) }}">
                        @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city{{ $index }}" class="form-label">Kota/Kabupaten</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                            id="city{{ $index }}" name="address[{{ $index }}][city]"
                            value="{{ old('address.' . $index . '.city', $address->city) }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="province{{ $index }}" class="form-label">Provinsi</label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror"
                            id="province{{ $index }}" name="address[{{ $index }}][province]"
                            value="{{ old('address.' . $index . '.province', $address->province) }}">
                        @error('province')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
