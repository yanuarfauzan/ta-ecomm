@extends('ADMIN.partial.main')
@section('content')
    <section class="section text-center">
        <div class="section-header">
            <h1>USERS</h1>
            <div class="section-header-button">
                <a href="/admin/create-users" class="btn btn-success">Add New</a>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mx-auto">
        <div class="card-header text-center">
            <h4>List Users</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Foto Profile</th>
                            <th scope="col">Role</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>
                                    @if ($user->gender == 0)
                                        Perempuan
                                    @else
                                        Laki-laki
                                    @endif
                                </td>
                                <td>{{ $user->birtdate }}</td>
                                <td>
                                    @if($user->profile_image)
                                        <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" width="50" height="50">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#addressModal{{ $user->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/admin/edit-users/{{ $user->id }}"
                                            class="btn btn-md bg-primary text-light btn-rounded mr-2">
                                            <i class="fa-solid fas fa-pen"></i>
                                        </a>
                                        <form action="/admin/delete-users/{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-md bg-danger text-light btn-rounded">
                                                <i class="fa-solid fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $users->links() }} --}}
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        @if ($users->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->previousPageUrl() }}"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($users->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $users->nextPageUrl() }}"><i
                                        class="fas fa-chevron-right"></i></a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @foreach ($users as $user)
        <div class="modal fade" id="addressModal{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="addressModal{{ $user->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center mx-auto justify-content-between">
                        <h5 class="modal-title" id="addressModal{{ $user->id }}Label">Detail Alamat</h5>
                    </div>
                    <div class="modal-body">
                        @if (isset($user->userAddresses) && $user->userAddresses->isNotEmpty())
                            @foreach ($user->userAddresses as $address)
                                <h6>Alamat {{ $loop->iteration }}</h6>
                                <p><strong>Nama Penerima:</strong> {{ $address->recipient_name }}</p>
                                <p><strong>Alamat:</strong> {{ $address->address }}</p>
                                <p><strong>Detail Alamat:</strong> {{ $address->detail }}</p>
                                <p><strong>Kode Pos:</strong> {{ $address->postal_code }}</p>
                                <p><strong>Kota/Kabupaten:</strong> {{ $address->city }}</p>
                                <p><strong>Provinsi:</strong> {{ $address->province }}</p>
                                <hr>
                            @endforeach
                        @else
                            <p>No address found for this user.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
