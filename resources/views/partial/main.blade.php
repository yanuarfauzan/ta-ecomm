<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> &mdash; e-comm</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
</head>

<body>
    <script id="__bs_script__">
        //<![CDATA[
        document.write("<script async src='/browser-sync/browser-sync-client.js?v=2.27.10'><\/script>".replace("HOST",
            location.hostname));
        //]]>
    </script>

    <div id="app">
        <div class="main-wrapper">
            @include('partial.admin-navbar')
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('admin') }}">e-comm</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('admin') }}"></a>
                    </div>
                    <ul class="sidebar-menu">
                        @include('partial.sidebar')
                    </ul>
                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    &copy; 2023 <div class="bullet"></div> Developed By <a
                        href="https://www.instagram.com/atmaardany/">Abhipraya</a>
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
