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
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ $user->phone_number }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter new password">
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
                    <input type="date" class="form-control" id="birtdate" name="birtdate" value="{{ $user->birtdate }}">
                </div>
                <div class="mb-3">
                    <label for="profile_image">Profile Image</label>
                    @if ($user->profile_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" style="max-width: 100px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
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
                    <input type="hidden" name="address[{{ $index }}][id]" value="{{ $address->id }}">
                    <div class="mb-3">
                        <label for="address{{ $index }}" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address{{ $index }}"
                            name="address[{{ $index }}][address]" value="{{ $address->address }}">
                    </div>
                    <div class="mb-3">
                        <label for="detail{{ $index }}" class="form-label">Detail</label>
                        <input type="text" class="form-control" id="detail{{ $index }}"
                            name="address[{{ $index }}][detail]" value="{{ $address->detail }}">
                    </div>
                    <div class="mb-3">
                        <label for="postal_code{{ $index }}" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code{{ $index }}"
                            name="address[{{ $index }}][postal_code]" value="{{ $address->postal_code }}">
                    </div>
                    <div class="mb-3">
                        <label for="city{{ $index }}" class="form-label">City</label>
                        <input type="text" class="form-control" id="city{{ $index }}"
                            name="address[{{ $index }}][city]" value="{{ $address->city }}">
                    </div>
                    <div class="mb-3">
                        <label for="province{{ $index }}" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province{{ $index }}"
                            name="address[{{ $index }}][province]" value="{{ $address->province }}">
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
