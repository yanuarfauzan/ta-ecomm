<div class="container d-flex justify-content-start align-items-start gap-4 p-0">
    <div class="d-flex flex-column justify-content-center gap-4" style="width: 30%">
        <div class="d-flex flex-column justify-content-center gap-2 card-detail-product mt-4 bg-white"
            style="width: 100%">
            <div class="container mt-4 d-flex flex-column gap-2 ms-4">
                <h4><strong>ulasan pembeli</strong></h4>
            </div>
            <div class="container d-flex flex-column gap-2">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex gap-1 justify-content-start align-items-center">
                        <span>
                            <i class="bi bi-star-fill" style="color: #ffd900; font-size: 30px;"></i>
                        </span>
                        <span class="d-flex align-items-center mt-2" style="height: 80px">
                            <p style="font-size: 100px; font-weight: 100;">{{ $arrayStars['acumulatedRating'] }}</p>
                            <div class="d-flex align-items-end mt-5">
                                <p style="font-size: 20px; font-weight: 100;">/</p>
                                <p style="font-size: 20px; font-weight: 100;">5</p>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="ms-2">
                </div>
            </div>
            <div class="container d-flex flex-column align-items-center">
                <span>
                    {{ $arrayStars['acumulatedInPercentRating'] }}% pembeli merasa puas
                </span>
                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <span>{{ $arrayStars['totalRating'] }} rating</span>
                    <div class="low-divider-black"></div>
                    <span>{{ $arrayStars['totalReviews'] }} ulasan</span>
                </div>
            </div>
            <div class="d-flex flex-column mb-4">
                <div class="d-flex justify-content-center align-items-center mx-3 gap-2 me-4">
                    <!-- Elemen span dengan bintang -->
                    <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 5</span>
                    <!-- Elemen progress -->
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        <div class="progress-bar bg-main-color" style="width: {{ $arrayStars['percentFiveStars'] }}%">
                        </div>
                    </div>
                    <span>{{ $arrayStars['fiveStarsCount'] }}</span>
                </div>
                <div class="d-flex justify-content-center align-items-center mx-3 gap-2 me-4">
                    <!-- Elemen span dengan bintang -->
                    <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 4</span>
                    <!-- Elemen progress -->
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        <div class="progress-bar bg-main-color" style="width: {{ $arrayStars['percentFourStars'] }}%">
                        </div>
                    </div>
                    <span>{{ $arrayStars['fourStarsCount'] }}</span>
                </div>
                <div class="d-flex justify-content-center align-items-center mx-3 gap-2 me-4">
                    <!-- Elemen span dengan bintang -->
                    <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 3</span>
                    <!-- Elemen progress -->
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        <div class="progress-bar bg-main-color" style="width: {{ $arrayStars['percentThreeStars'] }}%">
                        </div>
                    </div>
                    <span>{{ $arrayStars['threeStarsCount'] }}</span>
                </div>
                <div class="d-flex justify-content-center align-items-center mx-3 gap-2 me-4">
                    <!-- Elemen span dengan bintang -->
                    <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 2</span>
                    <!-- Elemen progress -->
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        <div class="progress-bar bg-main-color" style="width: {{ $arrayStars['percentTwoStars'] }}%">
                        </div>
                    </div>
                    <span>{{ $arrayStars['twoStarsCount'] }}</span>
                </div>
                <div class="d-flex justify-content-center align-items-center mx-3 gap-2 me-4">
                    <!-- Elemen span dengan bintang -->
                    <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 1</span>
                    <!-- Elemen progress -->
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                        <div class="progress-bar bg-main-color" style="width: {{ $arrayStars['percentOneStars'] }}%">
                        </div>
                    </div>
                    <span>{{ $arrayStars['oneStarsCount'] }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center gap-2 card-detail-product bg-white" style="width: 100%">
            <div class="container my-2 d-flex flex-column gap-2">
                <h4 class="ms-4 mt-4"><strong>filter ulasan</strong></h4>
                <div class="container d-flex flex-column">
                    <div class="ms-2">
                        <span><strong>media</strong></span>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-start align-items-center gap-2 my-2 ms-2">
                        <span>
                            <input wire:model.lazy="filterByMedia" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;"
                                value="true">
                            <span>dengan foto dan video</span>
                        </span>
                    </div>
                </div>
                <div class="container d-flex flex-column">
                    <div>
                        <span class="ms-2"><strong>rating</strong></span>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex flex-column justify-content-start align-items-start gap-2 my-2 ms-2">
                        <span>
                            <input wire:model.lazy="fiveStar" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 5</span>
                        </span>
                        <span>
                            <input wire:model.lazy="fourStar" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 4</span>
                        </span>
                        <span>
                            <input wire:model.lazy="threeStar" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 3</span>
                        </span>
                        <span>
                            <input wire:model.lazy="twoStar" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 2</span>
                        </span>
                        <span>
                            <input wire:model.lazy="oneStar" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span><i class="bi bi-star-fill" style="color: #ffd900;"></i> 1</span>
                        </span>
                    </div>
                </div>
                <div class="container d-flex flex-column">
                    <div>
                        <span class="ms-2"><strong>topik ulasan</strong></span>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex flex-column justify-content-start align-items-start gap-2 my-2 ms-2">
                        <span>
                            <input wire:model.lazy="quality" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span>kualitas barang</span>
                        </span>
                        <span>
                            <input wire:model.lazy="price" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span>harga barang</span>
                        </span>
                        <span>
                            <input wire:model.lazy="desc" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span>sesuai deskripsi</span>
                        </span>
                        <span>
                            <input wire:model.lazy="shipping" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span>pengiriman</span>
                        </span>
                        <span>
                            <input wire:model.lazy="packaging" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span>kemasan barang</span>
                        </span>
                        <span>
                            <input wire:model.lazy="service" class="form-check-input btn-check-outlined" type="checkbox"
                                id="flexCheckDefault" style="width: 20px; height: 20px; cursor: pointer;">
                            <span>pelayanan penjual</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column gap-2 card-detail-product mt-4 bg-white" style="width: 70%">
        <div class="container my-4 d-flex flex-column gap-2" style="100%;">
            <h4 class="ms-4"><strong>foto & video pembeli</strong></h4>
            <div class="d-flex align-items-center justify-content-start gap-2 ms-4">
                @foreach ($attachments as $attachment)
                    <span>
                        <img src="{{ Storage::url('public/attachments/' . $attachment->filepath_image) }}"
                            alt="" style="width: 80px; height: 80px;">
                    </span>
                @endforeach
            </div>
        </div>
        <div class="container d-flex flex-column gap-2">
            <div class="d-flex justify-content-between ms-4">
                <div class="d-flex flex-column gap-2">
                    <h4><strong>ulasan pilihan</strong></h4>
                    @if ($isShowAllReview == true)
                    <div>
                        <p class="small text-muted">Menampilkan semua ulasan</p>
                    </div>
                    @else
                    <div>
                        <p class="small text-muted">
                            {!! __('Menampilkan') !!}
                            <span class="fw-semibold">{{ $productAssessments->lastItem() }}</span>
                            {!! __('dari') !!}
                            <span class="fw-semibold">{{ $productAssessments->total() }}</span>
                            {!! __('ulasan') !!}
                        </p>
                    </div>
                    @endif
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 rounded-0 custom-div me-5">
                    <span class="mb-3"><strong>urutkan</strong></span>
                    <select class="form-select form-select-lg mb-3 rounded-0 custom-select" style="height: 50px"
                        aria-label="Large select example" wire:model.lazy="sortField">
                        <option value="terbaru">terbaru</option>
                        <option value="tertinggi">rating tertinggi</option>
                        <option value="terendah">rating terendah</option>
                    </select>
                </div>
            </div>
        </div>
        @foreach ($productAssessments as $index => $productAssessment)
            <div
                class="container d-flex flex-column gap-2 mb-2 {{ $isShowAllReview == true ? 'review-container' : '' }}">
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    @for ($i = 1; $i <= $productAssessment->rating; $i++)
                        <span>
                            <i class="bi bi-star-fill" style="color: #ffd900"></i>
                        </span>
                    @endfor
                    <span>{{ floor($productAssessment->created_at->diffInDays()) }} hari yang lalu</span>
                </div>
                <div class="d-flex justify-content-start align-items-center gap-2 ms-4">
                    <span><img src="https://placehold.co/400x400/png" alt="" class="rounded-circle"
                            style="width: 40px;"></span>
                    <span><strong>{{ $productAssessment->user->username }}</strong></span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span>
                        @foreach ($productAssessment->user?->cart->first()?->hasProduct->first()?->pickedVariationOption ?? [] as $variationOption)
                            {{ $variationOption->name }}{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </span>
                </div>
                <div class="d-flex justify-content-start align-items-center ms-4">
                    <span><strong>{{ $productAssessment->content }}</strong></span>
                </div>
                <div class="ms-4">
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        @foreach ($productAssessment->attachments()->get() as $attachment)
                            <img src="{{ Storage::url('public/attachments/' . $attachment->filepath_image) }}"
                                alt="" style="width: 80px; height: 80px;">
                        @endforeach
                    </div>
                </div>
                @if ($productAssessment->response_operator)
                    <div class="accordion accordion-flush ms-2" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header bg-white">
                                <button class="accordion-button collapsed border-white shadow-0 bg-white"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse-{{ $index }}" aria-expanded="false"
                                    aria-controls="flush-collapseOne"
                                    style="width: 155px; height: 30px; background-color: #F8F9FA;">
                                    lihat balasan
                                </button>
                            </h2>
                            <div id="flush-collapse-{{ $index }}" class="accordion-collapse collapse mt-2"
                                data-bs-parent="#accordionFlushExample">
                                <div class="d-flex justify-content-start align-items-center gap-2 ms-3 my-1">
                                    <span><img src="https://placehold.co/400x400/png" alt=""
                                            class="rounded-circle" style="width: 40px;"></span>
                                    <span><strong>Penjual</strong></span>
                                </div>
                                <div class="d-flex justify-content-start align-items-center ms-3">
                                    <span><strong>{{ $productAssessment->response_operator }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
        <div class="d-flex justify-content-between align-items-center mx-4 mb-4 mt-3">
            {{ $isShowAllReview == true ? '' :  $productAssessments->links('pagination::bootstrap-5') }}

            <a wire:click="showAllReviews()" class="font-main-color" style="cursor: pointer"><strong>lihat semua ulasan</strong></a>
        </div>
    </div>
</div>
