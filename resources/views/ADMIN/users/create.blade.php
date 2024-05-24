@extends('ADMIN.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ url('/admin/list-users') }}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>USERS</h1>
        </div>

        <div class="section-body">
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            <h4>INPUT USERS</h4>
        </div>
        <div class="card-body col">
            <form action="{{ url('/admin/store-users') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0">Female</option>
                        <option value="1">Male</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="birtdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="birtdate" name="birtdate">
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option>Pilih Role</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="operator">Operator</option>
                    </select>
                </div>
                <div id="address-section">
                    <h5>Address 1</h5>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address[0][address]">
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <input type="text" class="form-control" id="detail" name="address[0][detail]">
                    </div>
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="address[0][postal_code]">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="address[0][city]">
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province" name="address[0][province]">
                    </div>
                    <a href="#" id="add-address">Tambah Alamat</a>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const addressSection = document.getElementById('address-section');
            const addAddressLink = document.getElementById('add-address');

            function toggleAddressSection() {
                if (roleSelect.value === 'user') {
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
                addressCount++;
                const addressFields = `
                    <h5>Address ${addressCount}</h5>
                    <div class="address-item mb-3">
                        <label for="address_${addressCount}" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address_${addressCount}" name="address[${addressCount}][address]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="detail_${addressCount}" class="form-label">Detail</label>
                        <input type="text" class="form-control" id="detail_${addressCount}" name="address[${addressCount}][detail]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="postal_code_${addressCount}" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code_${addressCount}" name="address[${addressCount}][postal_code]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="city_${addressCount}" class="form-label">City</label>
                        <input type="text" class="form-control" id="city_${addressCount}" name="address[${addressCount}][city]">
                    </div>
                    <div class="address-item mb-3">
                        <label for="province_${addressCount}" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province_${addressCount}" name="address[${addressCount}][province]">
                    </div>
                `;
                addressSection.insertAdjacentHTML('beforeend', addressFields);
                addressSection.appendChild(addAddressLink);
                addressCount++;
            });
        });
    </script>
@endsection