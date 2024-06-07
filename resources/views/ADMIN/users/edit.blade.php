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
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                        name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Enter new password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Female</option>
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="birtdate" class="form-label">Birtdate</label>
                    <input type="date" class="form-control @error('birtdate') is-invalid @enderror" id="birtdate"
                        name="birtdate" value="{{ $user->birtdate }}">
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
                        id="profile_image" name="profile_image">
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
                    <h6>Address {{ $index + 1 }}</h6>
                    <div class="mb-3">
                        <label for="recipient_name{{ $index }}" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control @error('recipient_name') is-invalid @enderror"
                            id="recipient_name{{ $index }}" name="address[{{ $index }}][recipient_name]"
                            value="{{ $address->recipient_name }}">
                        @error('recipient_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="address[{{ $index }}][id]" value="{{ $address->id }}">
                    <div class="mb-3">
                        <label for="address{{ $index }}" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            id="address{{ $index }}" name="address[{{ $index }}][address]"
                            value="{{ $address->address }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="detail{{ $index }}" class="form-label">Detail</label>
                        <input type="text" class="form-control @error('detail') is-invalid @enderror"
                            id="detail{{ $index }}" name="address[{{ $index }}][detail]"
                            value="{{ $address->detail }}">
                        @error('detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="postal_code{{ $index }}" class="form-label">Postal Code</label>
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                            id="postal_code{{ $index }}" name="address[{{ $index }}][postal_code]"
                            value="{{ $address->postal_code }}">
                        @error('postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city{{ $index }}" class="form-label">City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                            id="city{{ $index }}" name="address[{{ $index }}][city]"
                            value="{{ $address->city }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="province{{ $index }}" class="form-label">Province</label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror"
                            id="province{{ $index }}" name="address[{{ $index }}][province]"
                            value="{{ $address->province }}">
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
