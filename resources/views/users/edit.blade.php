@extends('partial.main')
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
            <form action="{{ url('/admin/update-users/'.$user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
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
                    <input type="date" class="form-control" id="birtdate" name="birtdate"
                        value="{{ $user->birtdate }}">
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="text" class="form-control" id="profile_image" name="profile_image"
                        value="{{ $user->profile_image }}">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    @if ($user->usersAddress->isNotEmpty())
                        <input type="text" class="form-control" id="address" name="address[0][address]"
                            value="{{ $user->usersAddress->first()->address }}">
                    @else
                        <input type="text" class="form-control" id="address" name="address[0][address]" value="">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="detail" class="form-label">Detail</label>
                    @if ($user->usersAddress->isNotEmpty())
                        <input type="text" class="form-control" id="detail" name="address[0][detail]"
                            value="{{ $user->usersAddress->first()->detail }}">
                    @else
                        <input type="text" class="form-control" id="detail" name="address[0][detail]" value="">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    @if ($user->usersAddress->isNotEmpty())
                        <input type="text" class="form-control" id="postal_code" name="address[0][postal_code]"
                            value="{{ $user->usersAddress->first()->postal_code }}">
                    @else
                        <input type="text" class="form-control" id="postal_code" name="address[0][postal_code]"
                            value="">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    @if ($user->usersAddress->isNotEmpty())
                        <input type="text" class="form-control" id="city" name="address[0][city]"
                            value="{{ $user->usersAddress->first()->city }}">
                    @else
                        <input type="text" class="form-control" id="city" name="address[0][city]"
                            value="">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    @if ($user->usersAddress->isNotEmpty())
                        <input type="text" class="form-control" id="province" name="address[0][province]"
                            value="{{ $user->usersAddress->first()->province }}">
                    @else
                        <input type="text" class="form-control" id="province" name="address[0][province]"
                            value="">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
