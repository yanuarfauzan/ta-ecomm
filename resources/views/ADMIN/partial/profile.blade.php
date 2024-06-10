<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> &mdash; e-comm</title>

    <link href="{{ asset('/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style-copy.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
</head>

<body>
    <script id="__bs_script__">
        document.write("<script async src='/browser-sync/browser-sync-client.js?v=2.27.10'><\/script>".replace("HOST",
            location.hostname));
    </script>

    <div id="app">
        <div class="main-wrapper">
            @include('OPERATOR.partial.navbar')
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <div class="section-header-back">
                        <a href="{{ url('/admin') }}"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <h1>PROFILE ADMIN</h1>
                </div>
            </section>
            <div class="card">
                <div class="card-header">
                    <h4>Profile Admin</h4>
                </div>
                <div class="card-body col">
                    <form action="{{ url('/admin/update-profile', ['id' => $user->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
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
                            <input type="date" class="form-control @error('birtdate') is-invalid @enderror"
                                id="birtdate" name="birtdate" value="{{ old('birtdate', $user->birtdate) }}">
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
                            <input type="file"
                                class="form-control-file @error('profile_image') is-invalid @enderror"
                                id="profile_image" name="profile_image"
                                value="{{ old('profile_image', $user->profile_image) }}">
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" disabled>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>
                                    Operator
                                </option>
                            </select>
                        </div>
                        @foreach ($user->userAddresses as $index => $address)
                            <h6>Address {{ $index + 1 }}</h6>
                            <div class="mb-3">
                                <label for="recipient_name{{ $index }}" class="form-label">Nama
                                    Penerima</label>
                                <input type="text"
                                    class="form-control @error('recipient_name') is-invalid @enderror"
                                    id="recipient_name{{ $index }}"
                                    name="address[{{ $index }}][recipient_name]"
                                    value="{{ old('address.' . $index . '.recipient_name', $address->recipient_name) }}">
                                @error('recipient_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="address[{{ $index }}][id]"
                                value="{{ $address->id }}">
                            <div class="mb-3">
                                <label for="address{{ $index }}" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address{{ $index }}" name="address[{{ $index }}][address]"
                                    value="{{ old('address.' . $index . '.address', $address->address) }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="detail{{ $index }}" class="form-label">Detail</label>
                                <input type="text" class="form-control @error('detail') is-invalid @enderror"
                                    id="detail{{ $index }}" name="address[{{ $index }}][detail]"
                                    value="{{ old('address.' . $index . '.detail', $address->detail) }}">
                                @error('detail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="postal_code{{ $index }}" class="form-label">Postal
                                    Code</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                    id="postal_code{{ $index }}"
                                    name="address[{{ $index }}][postal_code]"
                                    value="{{ old('address.' . $index . '.postal_code', $address->postal_code) }}">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="city{{ $index }}" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city{{ $index }}" name="address[{{ $index }}][city]"
                                    value="{{ old('address.' . $index . '.city', $address->city) }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="province{{ $index }}" class="form-label">Province</label>
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
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                &copy; 2024 <div class="bullet"></div> Developed By <a>TIM TA</a>
            </div>
        </footer>
    </div>
    </div>
    <script src="{{ asset('stisla/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script src="{{ asset('node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/assets/js/page/forms-advanced-forms.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/modules-sweetalert.js') }}"></script>
