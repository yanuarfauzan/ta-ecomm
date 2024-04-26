@extends('partial.user.secondary.main')
@section('container')
    <div class="container d-flex justify-content-between gap-4" style="width: 100%; height: 100%">
        <div class="d-flex flex-column gap-2" style="width: 70%; height: 100%;">
            <div id="head-cart"
                class="bg-main-color d-flex justify-content-start px-4 align-items-center shadow-sm gap-4 text-white"
                style="width: 100%; height: 50px;">
                <span class="d-inline-block" style="width: 3%;">
                    <input id="all-check" class="form-check-input head-check-input" type="checkbox" value=""
                        style="width: 20px; height: 20px; cursor: pointer;">
                </span>
                <span class="d-inline-block" style="width: 20%;">
                    Produk
                </span>
                <span class="d-inline-block" style="width: 57%;">
                    Harga satuan
                </span>
                <span>
                    Total harga
                </span>
            </div>
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-1">
                <div class="d-flex justify-content-start gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-1 all-check" type="checkbox" value=""
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="https://placehold.co/80x80" alt="">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 100px;">
                            <strong>Product 1</strong>
                            <span>
                                <a href="#collapseVariation-1" id="toggelButtonVariation" role="button"
                                    aria-expanded="false" aria-controls="categoryCollapse-1"
                                    class="dropdown-toggle btn bg-transparent border-0 px-0 py-0"
                                    data-bs-toggle="collapse">Variation</a>
                            </span>
                            <span>Ungu,L</span>
                            <span>Stock 12</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center " style="width: 100px;">
                            <div class="width: 100%">
                                <h5 class="font-main-color"><strong>Rp 15.000</strong></h5>
                            </div>
                            <div class="d-flex" style="width: auto">
                                <span class="text-dark bg-light border-main-color text-center"
                                    style="width: 80px; height: 27px;">
                                    <p class="font-main-color">Discount</p>
                                </span>
                                <span class="text-dark bg-main-color border-main-color text-center"
                                    style="width: 40px; height: 27px"><i class="text-white">60%</i></span>
                            </div>
                        </div>

                        <div class="collapse position-absolute border-0"
                            style="top: 80%; right: 30%; width: 250px; height: auto; z-index: 1000"
                            id="collapseVariation-1">
                            <div class="card card-body rounded-0 shadow" id="card-variation-1">
                                <div class="d-flex flex-column gap-2">
                                    <div class="container d-flex flex-column">
                                        <strong>warna :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">putih</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">merah</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">hijau</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                        </div>
                                        <strong>size :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">M</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">L</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XL</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XXL</button>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            batal
                                        </button>
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <div class="d-flex gap-2 align-items-end me-3">
                        <a href="" class="font-main-color">
                            <i class="bi bi-heart" style="font-size: 20px"></i>
                        </a>
                        <a href="" class="font-main-color">
                            <i class="bi bi-trash" style="font-size: 20px"></i>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <h5 class="font-main-color"><strong>Rp 50.000</strong></h5>
                            <p class="text-decoration-line-through font-main-color">
                                <i>Rp 70.000</i>
                            </p>
                        </div>
                        <livewire:counter />
                    </div>
                </div>
            </div>
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-1">
                <div class="d-flex justify-content-start gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-1 all-check" type="checkbox" value=""
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="https://placehold.co/80x80" alt="">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 100px;">
                            <strong>Product 1</strong>
                            <span>
                                <a href="#collapseVariation-1" id="toggelButtonVariation" role="button"
                                    aria-expanded="false" aria-controls="categoryCollapse-1"
                                    class="dropdown-toggle btn bg-transparent border-0 px-0 py-0"
                                    data-bs-toggle="collapse">Variation</a>
                            </span>
                            <span>Ungu,L</span>
                            <span>Stock 12</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center " style="width: 100px;">
                            <div class="width: 100%">
                                <h5 class="font-main-color"><strong>Rp 15.000</strong></h5>
                            </div>
                            <div class="d-flex" style="width: auto">
                                <span class="text-dark bg-light border-main-color text-center"
                                    style="width: 80px; height: 27px;">
                                    <p class="font-main-color">Discount</p>
                                </span>
                                <span class="text-dark bg-main-color border-main-color text-center"
                                    style="width: 40px; height: 27px"><i class="text-white">60%</i></span>
                            </div>
                        </div>

                        <div class="collapse position-absolute border-0"
                            style="top: 80%; right: 30%; width: 250px; height: auto; z-index: 1000"
                            id="collapseVariation-1">
                            <div class="card card-body rounded-0 shadow" id="card-variation-1">
                                <div class="d-flex flex-column gap-2">
                                    <div class="container d-flex flex-column">
                                        <strong>warna :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">putih</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">merah</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">hijau</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                        </div>
                                        <strong>size :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">M</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">L</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XL</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XXL</button>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            batal
                                        </button>
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <div class="d-flex gap-2 align-items-end me-3">
                        <a href="" class="font-main-color">
                            <i class="bi bi-heart" style="font-size: 20px"></i>
                        </a>
                        <a href="" class="font-main-color">
                            <i class="bi bi-trash" style="font-size: 20px"></i>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <h5 class="font-main-color"><strong>Rp 50.000</strong></h5>
                            <p class="text-decoration-line-through font-main-color">
                                <i>Rp 70.000</i>
                            </p>
                        </div>
                        <livewire:counter />
                    </div>
                </div>
            </div>
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-1">
                <div class="d-flex justify-content-start gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-1 all-check" type="checkbox" value=""
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="https://placehold.co/80x80" alt="">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 100px;">
                            <strong>Product 1</strong>
                            <span>
                                <a href="#collapseVariation-1" id="toggelButtonVariation" role="button"
                                    aria-expanded="false" aria-controls="categoryCollapse-1"
                                    class="dropdown-toggle btn bg-transparent border-0 px-0 py-0"
                                    data-bs-toggle="collapse">Variation</a>
                            </span>
                            <span>Ungu,L</span>
                            <span>Stock 12</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center " style="width: 100px;">
                            <div class="width: 100%">
                                <h5 class="font-main-color"><strong>Rp 15.000</strong></h5>
                            </div>
                            <div class="d-flex" style="width: auto">
                                <span class="text-dark bg-light border-main-color text-center"
                                    style="width: 80px; height: 27px;">
                                    <p class="font-main-color">Discount</p>
                                </span>
                                <span class="text-dark bg-main-color border-main-color text-center"
                                    style="width: 40px; height: 27px"><i class="text-white">60%</i></span>
                            </div>
                        </div>

                        <div class="collapse position-absolute border-0"
                            style="top: 80%; right: 30%; width: 250px; height: auto; z-index: 1000"
                            id="collapseVariation-1">
                            <div class="card card-body rounded-0 shadow" id="card-variation-1">
                                <div class="d-flex flex-column gap-2">
                                    <div class="container d-flex flex-column">
                                        <strong>warna :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">putih</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">merah</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">hijau</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                        </div>
                                        <strong>size :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">M</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">L</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XL</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XXL</button>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            batal
                                        </button>
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <div class="d-flex gap-2 align-items-end me-3">
                        <a href="" class="font-main-color">
                            <i class="bi bi-heart" style="font-size: 20px"></i>
                        </a>
                        <a href="" class="font-main-color">
                            <i class="bi bi-trash" style="font-size: 20px"></i>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <h5 class="font-main-color"><strong>Rp 50.000</strong></h5>
                            <p class="text-decoration-line-through font-main-color">
                                <i>Rp 70.000</i>
                            </p>
                        </div>
                        <livewire:counter />
                    </div>
                </div>
            </div>
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-1">
                <div class="d-flex justify-content-start gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-1 all-check" type="checkbox" value=""
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="https://placehold.co/80x80" alt="">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 100px;">
                            <strong>Product 1</strong>
                            <span>
                                <a href="#collapseVariation-1" id="toggelButtonVariation" role="button"
                                    aria-expanded="false" aria-controls="categoryCollapse-1"
                                    class="dropdown-toggle btn bg-transparent border-0 px-0 py-0"
                                    data-bs-toggle="collapse">Variation</a>
                            </span>
                            <span>Ungu,L</span>
                            <span>Stock 12</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center " style="width: 100px;">
                            <div class="width: 100%">
                                <h5 class="font-main-color"><strong>Rp 15.000</strong></h5>
                            </div>
                            <div class="d-flex" style="width: auto">
                                <span class="text-dark bg-light border-main-color text-center"
                                    style="width: 80px; height: 27px;">
                                    <p class="font-main-color">Discount</p>
                                </span>
                                <span class="text-dark bg-main-color border-main-color text-center"
                                    style="width: 40px; height: 27px"><i class="text-white">60%</i></span>
                            </div>
                        </div>

                        <div class="collapse position-absolute border-0"
                            style="top: 80%; right: 30%; width: 250px; height: auto; z-index: 1000"
                            id="collapseVariation-1">
                            <div class="card card-body rounded-0 shadow" id="card-variation-1">
                                <div class="d-flex flex-column gap-2">
                                    <div class="container d-flex flex-column">
                                        <strong>warna :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">putih</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">merah</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">hijau</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                        </div>
                                        <strong>size :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">M</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">L</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XL</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XXL</button>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            batal
                                        </button>
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <div class="d-flex gap-2 align-items-end me-3">
                        <a href="" class="font-main-color">
                            <i class="bi bi-heart" style="font-size: 20px"></i>
                        </a>
                        <a href="" class="font-main-color">
                            <i class="bi bi-trash" style="font-size: 20px"></i>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <h5 class="font-main-color"><strong>Rp 50.000</strong></h5>
                            <p class="text-decoration-line-through font-main-color">
                                <i>Rp 70.000</i>
                            </p>
                        </div>
                        <livewire:counter />
                    </div>
                </div>
            </div>
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-1">
                <div class="d-flex justify-content-start gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-1 all-check" type="checkbox" value=""
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="https://placehold.co/80x80" alt="">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 100px;">
                            <strong>Product 1</strong>
                            <span>
                                <a href="#collapseVariation-1" id="toggelButtonVariation" role="button"
                                    aria-expanded="false" aria-controls="categoryCollapse-1"
                                    class="dropdown-toggle btn bg-transparent border-0 px-0 py-0"
                                    data-bs-toggle="collapse">Variation</a>
                            </span>
                            <span>Ungu,L</span>
                            <span>Stock 12</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center " style="width: 100px;">
                            <div class="width: 100%">
                                <h5 class="font-main-color"><strong>Rp 15.000</strong></h5>
                            </div>
                            <div class="d-flex" style="width: auto">
                                <span class="text-dark bg-light border-main-color text-center"
                                    style="width: 80px; height: 27px;">
                                    <p class="font-main-color">Discount</p>
                                </span>
                                <span class="text-dark bg-main-color border-main-color text-center"
                                    style="width: 40px; height: 27px"><i class="text-white">60%</i></span>
                            </div>
                        </div>

                        <div class="collapse position-absolute border-0"
                            style="top: 80%; right: 30%; width: 250px; height: auto; z-index: 1000"
                            id="collapseVariation-1">
                            <div class="card card-body rounded-0 shadow" id="card-variation-1">
                                <div class="d-flex flex-column gap-2">
                                    <div class="container d-flex flex-column">
                                        <strong>warna :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">putih</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">merah</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">hijau</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                        </div>
                                        <strong>size :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">M</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">L</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XL</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XXL</button>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            batal
                                        </button>
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <div class="d-flex gap-2 align-items-end me-3">
                        <a href="" class="font-main-color">
                            <i class="bi bi-heart" style="font-size: 20px"></i>
                        </a>
                        <a href="" class="font-main-color">
                            <i class="bi bi-trash" style="font-size: 20px"></i>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <h5 class="font-main-color"><strong>Rp 50.000</strong></h5>
                            <p class="text-decoration-line-through font-main-color">
                                <i>Rp 70.000</i>
                            </p>
                        </div>
                        <livewire:counter />
                    </div>
                </div>
            </div>
            <div class="card-product card-all-check d-flex justify-content-between px-4 align-items-center shadow-sm gap-4"
                style="width: 100%; height: 140px; background-color: white" id="card-product-2">
                <div class="d-flex justify-content-start gap-4" style="width: 30%;">
                    <span>
                        <input class="form-check-input check-product-2 all-check" type="checkbox" value=""
                            id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                    </span>
                    <img src="https://placehold.co/80x80" alt="">
                    <div class="d-flex position-relative justify-content-between" style="width: auto;">
                        <div class="d-flex flex-column align-items-start position-relative gap-0" style="width: 100px;">
                            <strong>Product 1</strong>
                            <span>
                                <a href="#collapseVariation-2" id="toggelButtonVariation" role="button"
                                    aria-expanded="false" aria-controls="categoryCollapse-2"
                                    class="dropdown-toggle btn bg-transparent border-0 px-0 py-0"
                                    data-bs-toggle="collapse">Variation</a>
                            </span>
                            <span>Ungu,L</span>
                            <span>Stock 12</span>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center " style="width: 100px;">
                            <div class="width: 100%">
                                <h5 class="font-main-color"><strong>Rp 15.000</strong></h5>
                            </div>
                            <div class="d-flex" style="width: auto">
                                <span class="text-dark bg-light border-main-color text-center"
                                    style="width: 80px; height: 27px;">
                                    <p class="font-main-color">Discount</p>
                                </span>
                                <span class="text-dark bg-main-color border-main-color text-center"
                                    style="width: 40px; height: 27px"><i class="text-white">60%</i></span>
                            </div>
                        </div>

                        <div class="collapse position-absolute border-0"
                            style="top: 80%; right: 30%; width: 250px; height: auto; z-index: 1000;"
                            id="collapseVariation-2">
                            <div class="card card-body rounded-0 shadow" id="card-variation">
                                <div class="d-flex flex-column gap-2">
                                    <div class="container d-flex flex-column">
                                        <strong>warna :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">putih</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">merah</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">hijau</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                            <button type="button"
                                                class="variation-first shadow-sm badge border-sm rounded-0"
                                                style="width: auto">kuning</button>
                                        </div>
                                        <strong>size :</strong>
                                        <div class="row row-cols-4 gap-2 mt-2 ms-3">
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">M</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">L</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XL</button>
                                            <button type="button"
                                                class="variation-scnd shadow-sm badge border-sm rounded-0"
                                                style="width: auto">XXL</button>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mt-4">
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            batal
                                        </button>
                                        <button type="button"
                                            class="btn bg-main-color text-white rounded-0 variation-confirm"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <div class="d-flex gap-2 align-items-end me-3">
                        <a href="" class="font-main-color">
                            <i class="bi bi-heart" style="font-size: 20px"></i>
                        </a>
                        <a href="" class="font-main-color">
                            <i class="bi bi-trash" style="font-size: 20px"></i>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <h5 class="font-main-color"><strong>Rp 50.000</strong></h5>
                            <p class="text-decoration-line-through font-main-color">
                                <i>Rp 70.000</i>
                            </p>
                        </div>
                        <livewire:counter />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-start gap-2" style="width: 30%; height: 100%;">
            <div class="shadow-sm card-summary bg-light" style="width: 100%; height: 280px;">
                <div class="container d-flex flex-column py-4 px-4 gap-2" style="width: 100%; height: 100%">
                    <span>
                        <strong class="font-main-color">
                            <h5>Shopping Summary</h5>
                        </strong>
                    </span>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column align-items-start">
                            <span><strong>Subtotal</strong></span>
                            <span><strong>Discount</strong></span>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <span><strong>Rp 20.000</strong></span>
                            <span><strong>-Rp 10.000</strong></span>
                        </div>
                    </div>
                    <hr class="border border-secondary bg-main-color opacity-50">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <strong>total :</strong>
                        </span>
                        <span>
                            <strong>Rp 70.000</strong>
                        </span>
                    </div>
                    <button id="checkout" class="btn rounded-0 mt-3 bg-main-color text-white"
                        style="width: 100%;"><strong>checkout</strong></button>
                </div>
            </div>
            <div class="shadow-sm card-summary bg-light" style="width: 100%; height: 590px;">
                <div class="container" style="width: 100%; height: 400px">
                    <div class="d-flex flex-column position-relative">
                        <span class="mt-4 ms-3">
                            <strong class="font-main-color">
                                <h5>Shopping Summary</h5>
                            </strong>
                        </span>
                        <div class="swiper-container swiper mySwiper" style="margin: 0">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="row row-cols-2 mx-2">
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="row row-cols-2 mx-2">
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" style="text-decoration: none">
                                            <div class="col mt-4" style="width: 145px;">
                                                <!-- Mengatur lebar col menjadi 150px -->
                                                <div class="card border-0 position-relative shadow-sm rounded-0"
                                                    id="card-product"
                                                    style="width: 100%; max-width: 150px; height: auto; cursor: pointer;">
                                                    <div style="overflow: hidden;">
                                                        <img src="https://placehold.co/80x80"
                                                            class="card-img-top rounded-0" alt="..."
                                                            id="image-product" style="width: 100%;">
                                                        <!-- Mengatur lebar gambar menjadi 100% -->
                                                    </div>
                                                    <span
                                                        class="text-dark bg-light position-absolute border border-secondary text-center"
                                                        style="top: 129px; width: 50px; font-size: 10px;">Discount</span>
                                                    <span
                                                        class="text-dark bg-secondary position-absolute border border-secondary text-center"
                                                        style="top: 129px; left: 50px; width: 30px; font-size: 10px;"><i
                                                            class="text-white">60%</i></span>
                                                    <div class="card-body p-2"> <!-- Mengurangi padding card body -->
                                                        <div class="d-flex justify-content-between">
                                                            <strong style="font-size: 10px;">product 1</strong>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                            <p style="font-size: 10px;">Stock 20</p>
                                                            <!-- Menyesuaikan ukuran teks -->
                                                        </div>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <h5 style="font-size: 12px; margin: 0;"><strong>Rp
                                                                    50.000</strong></h5>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <p style="font-size: 8px; margin: 0;"
                                                                    class="text-decoration-line-through"><i>Rp 100.000</i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 mt-1">
                                                            <i class="bi bi-star-fill"
                                                                style="color: #ffd900; font-size: 10px;"></i>
                                                            <span style="font-size: 10px;">4</span>
                                                            <div class="low-divider-black"
                                                                style="width: 1px; background-color: black; height: 10px;">
                                                            </div>
                                                            <!-- Mengurangi lebar low-divider -->
                                                            <span style="font-size: 10px;">10 Terjual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next text-light" id="reload-similar-product"><i class="bi bi-arrow-clockwise"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<script src="{{ asset('/ourjs/cart.js') }}"></script>
