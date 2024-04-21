@extends('partial.user.main')
@section('container')
    <div class="d-flex flex-column gap-3 align-items-center">
        <div id="carouselExampleIndicators" class="carousel slide" style="width: 84%">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://plus.unsplash.com/premium_photo-1676998931123-75789162f170?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1455849318743-b2233052fcff?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1513106021000-168e5f56609d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100" style="height: 300px; object-fit: cover;" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container">
            <div class="row row-cols-4 ms-0">
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <span class="text-dark bg-light position-absolute border border-secondary text-center"
                            style="top: 213px; width: 70px;">Discount</span>
                        <span class="text-dark bg-secondary position-absolute border border-secondary text-center"
                            style="top: 213px; left: 70 px; width: 40px;"><i class="text-white">60%</i></span>
                        <div class="card-body pb-2">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock 12</p>
                            </div>
                            <div class="d-flex gap-2">
                                <h5><strong>Rp. 20.000</strong></h5>
                                <p class="text-decoration-line-through"><strong>Rp. 40.000</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="rounded-circle bg-secondary text-white position-absolute d-flex align-items-center justify-content-center opacity-25"
                            style="top: 20px; left: 45px; width:200px; height:200px; ">
                            <div class="d-flex flex-column align-items-center gap-2">
                                <img src="{{ asset('/icons-png/out-of-stock.png') }}" class="" style="width: 70px;"
                                    alt="">
                                <span>
                                    <h4>Out Of Stock</h4>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock 0</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card rounded-0 position-relative" style="width: 18rem; height: auto; cursor: pointer;">
                        <img src="https://placehold.co/600x500" class="card-img-top rounded-0" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong>Produk</strong>
                                <p>Stock</p>
                            </div>
                            <h5><strong>Rp. 20.000</strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <a href="" class="btn bg-main-color rounded-0 mt-3 text-white" style="width: 300px;">Muat Lebih Banyak</a>
        </div>
    </div>
@endsection
