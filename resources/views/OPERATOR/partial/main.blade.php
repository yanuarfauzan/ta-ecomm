<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <style>
        .special-card {
            position: relative;
            overflow: hidden;
            height: 175px;
        }

        .special-card-content {
            transition: transform 0.3s;
        }

        .special-card:hover .special-card-content {
            transform: scale(1.05);
        }

        .card-icon {
            font-size: 3rem !important;
            color: #6777ef;
            margin-right: 30px !important;
            vertical-align: middle;
        }

        .card-stats-item {
            cursor: pointer;
        }

        .card-stats-item.active {
            color: #6777ef;
        }

        .card-title {
            margin: 0;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <script id="_bs_script_">
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
            {{-- @yield('content') --}}
            <section class="section">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2" style="height: 175px">
                            <div class="card-stats">
                                <div class="card-stats-title">
                                    <div class="dropdown d-inline">
                                    </div>
                                </div>
                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <button class="btn btn-primary filter-btn" data-category="proceed">
                                            <div class="card-stats-item-count">{{ $prosesCount }}</div>
                                        </button>
                                        <div class="card-stats-item-label">Proses</div>
                                    </div>
                                    <div class="card-stats-item">
                                        <button class="btn btn-primary filter-btn" data-category="shipped">
                                            <div class="card-stats-item-count">{{ $shippedCount }}</div>
                                        </button>
                                        <div class="card-stats-item-label">Shipped</div>
                                    </div>
                                    <div class="card-stats-item">
                                        <button class="btn btn-primary filter-btn" data-category="completed">
                                            <div class="card-stats-item-count">{{ $completedCount }}</div>
                                        </button>
                                        <div class="card-stats-item-label">Completed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="/operator/profile" style="text-decoration: none">
                            <div class="card special-card card-statistic-2" style="height: 175px">
                                <div class="card-stats special-card-content">
                                    <div class="card-stats-title">
                                        <div class="dropdown d-inline">
                                        </div>
                                        <h2 class="m-4">
                                            <i class="fas fa-landmark card-icon m-2"></i>
                                            Manajemen Keuangan
                                        </h2>
                                    </div>
                                    <div class="card-stats-items">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a href="/operator/profile" style="text-decoration: none">
                            <div class="card special-card card-statistic-2" style="height: 175px">
                                <div class="card-stats special-card-content">
                                    <div class="card-stats-title">
                                        <div class="dropdown d-inline">
                                        </div>
                                        <h2 class="m-4">
                                            <i class="fas fa-comments card-icon m-2"></i>
                                            Live Chat<br>Customer
                                        </h2>
                                    </div>
                                    <div class="card-stats-items">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="order-list"></div>
                @foreach ($orders as $order)
                    <div class="card mt-1">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                                <div class="d-flex justify-content-start gap-2 align-items-center">
                                    <h4>#{{ $order->order_number }}</h4>
                                    <span class="opacity-50">{{ $order->user->username }}</span>
                                </div>
                                <div class="card-header-action d-flex justify-content-start align-items-center gap-2">
                                    <div class="badge d-flex justify-content-center align-items-center"
                                        style="height: 30px; background-color: @if (in_array($order->order_status, ['paid', 'proceed', 'shipped'])) #ffc107 @else #28a745 @endif">
                                        {{ $order->formatted_status }}
                                    </div>
                                    <button class="btn btn-icon btn-info" data-toggle="collapse"
                                        data-target="#order-details-{{ $order->id }}" aria-expanded="false"
                                        aria-controls="order-details-{{ $order->id }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="order-details-{{ $order->id }}">
                            <div class="card-body">
                                <div class="d-flex flex-column justify-content-start align-items-center">
                                    <div class="d-flex justify-content-between align-items-top w-100">
                                        <!-- Customer Details -->
                                        <div class="w-25">
                                            <div class="d-flex flex-column mx-2">
                                                <span>Pemesan/kirim kepada :</span>
                                                <h6 class="mt-2">{{ $order->address->recipient_name ?? 'N/A' }}</h6>
                                                <h6>{{ $order->user->phone_number ?? 'N/A' }}</h6>
                                                <h6>{{ $order->user->email ?? 'N/A' }}</h6>
                                                <span>Catatan :</span>
                                                <span>{{ $order->note ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <!-- Product Details -->
                                        <div class="w-50">
                                            <span>Produk :</span>
                                            <div class="d-flex flex-column mx-2">
                                                @if ($order->product)
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mt-2">{{ $order->product->name }}</h6>
                                                        <span>x {{ $order->qty }}</span>
                                                    </div>
                                                @else
                                                    @foreach ($order->cartProducts as $cartProduct)
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mt-2">{{ $cartProduct->product->name }}</h6>
                                                            <span>x {{ $cartProduct->cart->qty }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="d-flex justify-content-between mx-2 mt-3">
                                                    <span>Total:</span>
                                                    <span>
                                                        @if ($order->product)
                                                            {{ $order->qty }}
                                                        @else
                                                            {{ $order->cartProducts->sum(function ($cartProduct) {
                                                                return $cartProduct->cart->qty;
                                                            }) }}
                                                        @endif
                                                        Pcs
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Total Price -->
                                        <div class="card w-25">
                                            <div class="card-header bg-primary d-flex justify-content-between">
                                                <h4 class="text-white">Total:</h4>
                                                <h4 class="text-white">Rp
                                                    {{ number_format($order->total_price + $order->shippingMethod->cost, 0, ',', '.') }}
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <span>Harga produk:</span>
                                                    <span>Rp
                                                        {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <span>Ongkos Kirim:</span>
                                                    <span>Rp
                                                        {{ number_format($order->shippingMethod->cost, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Shipping Details -->
                                        <div class="w-25">
                                            <div class="d-flex flex-column mx-2">
                                                <span>Pengiriman :</span>
                                                <h6 class="mt-2">
                                                    {{ $order->shippingMethod->provider_name ?? 'N/A' }}</h6>
                                                <span>Alamat :</span>
                                                <span>{{ $order->address->address ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Order Actions -->
                                    <div class="d-flex justify-content-start align-items-center gap-2 mx-2 mt-4 w-100">
                                        <span class="ms-2"><strong>Proses pesanan ini ?</strong></span>
                                        @if ($order->order_status === 'paid')
                                            <button class="btn btn-danger btnProses"
                                                data-order-id="{{ $order->id }}">Proses</button>
                                        @else
                                            <button class="btn btn-success" disabled>Proses</button>
                                        @endif
                                        <i class="bi bi-arrow-right-short" style="font-size: 30px;"></i>
                                        <span><strong>Paket sudah dikirim ?</strong></span>
                                        @if ($order->order_status === 'shipped' || $order->order_status === 'completed')
                                            <button class="btn btn-success" disabled>Shipped</button>
                                        @else
                                            @if ($order->order_status === 'paid')
                                                <button class="btn btn-secondary btnShipped"
                                                    data-order-id="{{ $order->id }}" disabled>Shipped</button>
                                            @else
                                                <button class="btn btn-danger btnShipped"
                                                    data-order-id="{{ $order->id }}">Shipped</button>
                                            @endif
                                        @endif

                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control inputResi"
                                                placeholder="No. resi" data-order-id="{{ $order->id }}"
                                                value="{{ $order->shipping->resi }}" required
                                                @if ($order->order_status !== 'proceed') disabled @endif>
                                            @if (in_array($order->order_status, ['shipped', 'completed']))
                                                <button class="btn btn-outline-primary btnEditResi ms-2"
                                                    data-order-id="{{ $order->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Review Section -->
                                    <div class="d-flex justify-content-start align-items-center gap-2 mx-2 mt-4 w-100">
                                        <span class="ms-2"><strong>Ulasan</strong></span>
                                    </div>
                                    @if ($order && $order->productAssessment && !$order->productAssessment->isEmpty())
                                        @foreach ($order->productAssessment as $assessment)
                                            <div
                                                class="d-flex justify-content-start align-items-center gap-2 mx-2 mt-4 w-100">
                                                <h6 class="m-2 text-primary">{{ $assessment->product->name }}</h6>
                                            </div>
                                            @if ($assessment->image)
                                                <img src="{{ asset('storage/' . $assessment->image) }}"
                                                    alt="">
                                            @endif
                                            <div
                                                class="d-flex justify-content-start align-items-center gap-2 mx-2 w-100">
                                                <span class="ms-2">{{ $assessment->content }}</span>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between align-items-center gap-2 mt-2 ms-2 w-100">
                                                <input type="text" class="form-control response-input"
                                                    data-assessment-id="{{ $assessment->id }}"
                                                    style="width: 100%; height: 35px;"
                                                    value="{{ $assessment->response_operator }}">
                                                <button class="btn btn-primary btnRespond"
                                                    data-assessment-id="{{ $assessment->id }}">Kirim</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div
                                            class="d-flex justify-content-between align-items-center gap-2 mt-2 ms-2 w-100">
                                            <p class="m-1 text-alert">Belum ada ulasan masuk.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                <ul class="pagination mb-0">
                    @if ($orders->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $orders->previousPageUrl() }}"><i
                                    class="fas fa-chevron-left"></i></a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                        <li class="page-item {{ $i == $orders->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($orders->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $orders->nextPageUrl() }}"><i
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
        </section>
    </div>
    <footer class="main-footer">
        <div class="footer-left">
            &copy; 2024 <div class="bullet"></div> Developed By <a>TIM TA</a>
        </div>
    </footer>
    </div>
    </div>

    <!-- General JS Scripts -->
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

    <script>
        //filter
        $(document).ready(function() {
            $('.filter-btn').click(function() {
                var category = $(this).data('category');

                $.ajax({
                    url: '/operator/filter/' + category,
                    method: 'GET',
                    success: function(response) {
                        var html = '';

                        response.forEach(function(order) {
                            html += '<div class="card mt-1">' +
                                '<div class="card-header">' +
                                '</div>' +
                                '</div>';
                        });

                        $('#order-list').html(html);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script>
        //btnproses
        $(document).ready(function() {
            $(document).on('click', '.btnProses', function() {
                var orderId = $(this).data('order-id');

                $.ajax({
                    url: '/operator/' + orderId + '/update-proses',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_status: 'proceed'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.btnShipped', function() {
                var orderId = $(this).data('order-id');

                $.ajax({
                    url: '/operator/' + orderId + '/update-proses',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_status: 'shipped'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        //btnshipped
        $(document).on('click', '.btnShipped', function() {
            var button = $(this);
            var orderId = button.data('order-id');
            var resiInput = button.parent().find('.inputResi');

            var resi = resiInput.val();

            $.ajax({
                url: '/operator/' + orderId + '/update-shipping',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    resi: resi
                },
                success: function(response) {
                    console.log(response.success);

                    button.removeClass('btn-danger').addClass('btn-success').text('Shipped');

                    button.prop('disabled', true);

                    resiInput.prop('disabled', true).val(resi);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

    <script>
        //editresi
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btnEditResi').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const inputResi = document.querySelector(
                        `.inputResi[data-order-id="${orderId}"]`);

                    if (inputResi.disabled) {
                        inputResi.disabled = false;
                        inputResi.focus();
                        this.innerHTML = '<i class="fas fa-check"></i>';
                    } else {
                        inputResi.disabled = true;
                        const newResi = inputResi.value;

                        this.innerHTML = '<i class="bi bi-pencil"></i>';

                        // Send AJAX request to update the resi value
                        fetch('{{ route('update-resi') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    orderId: orderId,
                                    resi: newResi
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log(data.message);
                                } else {
                                    console.error('Failed to update resi');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                });
            });
        });
    </script>

    <script>
        //ulasan
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btnRespond').forEach(button => {
                button.addEventListener('click', function() {
                    const assessmentId = this.getAttribute('data-assessment-id');
                    const responseInput = document.querySelector(
                        `.response-input[data-assessment-id="${assessmentId}"]`
                    );
                    const response = responseInput.value;

                    console.log({
                        assessmentId: assessmentId,
                        response_operator: response
                    });

                    fetch(`/operator/response-operator/${assessmentId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                response_operator: response
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Response data:', data);
                            if (data.success) {
                                alert('Response saved successfully!');
                            } else {
                                alert('Failed to save response.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

    <script>
        const returnButtons = document.querySelectorAll('.return-btn');

        returnButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const form = this.parentElement;
                const id = this.getAttribute('data-id');

                this.setAttribute('disabled', 'disabled');

                axios.put(form.action, new FormData(form))
                    .then(response => {
                        const statusCell = form.parentElement.querySelector('.order_status-cell');
                        statusCell.innerHTML = '<div class="badge badge-success">Dikembalikan</div>';
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        });
    </script>

    <script>
        function confirmAction(message, element) {
            swal({
                title: "Confirmation",
                text: message,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function(confirm) {
                if (confirm) {
                    element.submit();
                }
            });

            return false;
        }
    </script>

</body>

</html>
