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
                <div class="row">
                    @foreach ($orders as $order)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card mt-1">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                                        <div class="d-flex justify-content-start gap-2 align-items-center">
                                            <h4>#ECM-{{ $order->id }}</h4>
                                            <span class="opacity-50">{{ $order->customer_name }}</span>
                                        </div>
                                        <div
                                            class="card-header-action d-flex justify-content-start align-items-center gap-2">
                                            <div class="badge badge-success d-flex justify-content-center align-items-center"
                                                style="height: 30px;">
                                                {{ strtoupper($order->status) }}
                                            </div>
                                            <a data-collapse="#order-details-{{ $order->id }}"
                                                class="btn btn-icon btn-info" href="#">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse show" id="order-details-{{ $order->id }}">
                                    <div class="card-body">
                                        <div class="d-flex flex-column justify-content-start align-items-center">
                                            <div class="d-flex justify-content-between align-items-top">
                                                <div style="width: 24%; height: auto">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-start mx-2">
                                                        <span>Pemesan/kirim kepada :</span>
                                                        <h6 class="mt-2">{{ $order->customer_name }}</h6>
                                                        <h6>{{ $order->customer_phone }}</h6>
                                                        <h6>{{ $order->customer_email }}</h6>
                                                        <span>Catatan :</span>
                                                        <span>{{ $order->notes }}</span>
                                                    </div>
                                                </div>
                                                <div style="width: 24%; height: auto">
                                                    <span>Produk :</span>
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-start mx-2">
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <h6 class="mt-2">{{ $order->product_name }}</h6>
                                                            <span>x {{ $order->quantity }}</span>
                                                        </div>
                                                        <span>{{ $order->product_details }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex justify-content-between mx-2">
                                                        <span>total :</span>
                                                        <span>{{ $order->quantity }} Pcs</span>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 24%; height: auto">
                                                    <div
                                                        class="card-header bg-primary d-flex justify-content-between mb-0">
                                                        <span>
                                                            <h3 class="text-white">total :</h3>
                                                        </span>
                                                        <span>
                                                            <h3 class="text-white">Rp
                                                                {{ number_format($order->total_price, 0, ',', '.') }}
                                                            </h3>
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="card-body d-flex flex-column justify-content-start align-items-center">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span>harga produk :</span>
                                                            <span>Rp
                                                                {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 24%; height: 100px">
                                                    <div
                                                        class="d-flex flex-column justify-content-start align-items-start mx-2">
                                                        <span>Pengiriman :</span>
                                                        <h6 class="mt-2">{{ $order->shipping_method }}</h6>
                                                        <span>alamat :</span>
                                                        <span>{{ $order->shipping_address }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Order processing and review section here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
        // Mendapatkan semua tombol "Dikembalikan"
        const returnButtons = document.querySelectorAll('.return-btn');

        returnButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const form = this.parentElement;
                const id = this.getAttribute('data-id');

                // Menonaktifkan tombol setelah diklik
                this.setAttribute('disabled', 'disabled');

                // Mengirim permintaan Ajax ke URL update-status
                axios.put(form.action, new FormData(form))
                    .then(response => {
                        // Mengubah status menjadi "Dikembalikan"
                        const statusCell = form.parentElement.querySelector('.status-cell');
                        statusCell.innerHTML = '<div class="badge badge-success">Dikembalikan</div>';
                    })
                    .catch(error => {
                        // Menampilkan pesan error (jika ada)
                        console.log(error);
                    });
            });
        });
    </script>
    {{-- <script>
        function confirmAction(message, formId) {
            if (confirm(message)) {
                document.getElementById(formId).submit();
            }
        }
    </script> --}}
    {{-- <script>
        function confirmAction(message, pinjamId) {
            Swal.fire({
                title: "Confirmation",
                text: message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, send PUT request using fetch API
                    fetch(`/peminjaman/update-status/${pinjamId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ status: 'Dikembalikan' }),
                    })
                    .then((response) => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            Swal.fire("Error", "Gagal mengubah status peminjaman.", "error");
                        }
                    })
                    .catch((error) => {
                        Swal.fire("Error", "Terjadi kesalahan. Gagal mengubah status peminjaman.", "error");
                    });
                }
            });
        }
    </script> --}}
    {{-- <script>
        function confirmAction(message, id) {
            swal({
                title: "Confirmation",
                text: message,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function(confirm) {
                if (confirm) {
                    document.getElementById("form-update-status-" + id).submit();
                }
            });
        }
    </script> --}}
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
