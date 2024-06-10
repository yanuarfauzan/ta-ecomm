@extends('Admin.partial.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Home Page Admin</h1>
        </div>
        <div class="section-body">
            <div class="col-12 mb-4">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>Welcome Back, {{ Auth::user()->username }}!</h2>
                        <p class="lead">Ini adalah halaman Admin pengelolaan website e-commerce. Di sini Admin mengelola
                            berbagai aspek dari sistem e-commerce, termasuk pengelolaan Users, Category, Variation, Product,
                            Variation Option, Merge Variation Optin, Voucher, dan Banner Home. Admin memiliki akses penuh
                            untuk menambahkan, mengedit, dan menghapus data.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
