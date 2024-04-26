<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-main-color shadow"
    style="height: 35px;">
    <div class="container-fluid mx-4" style="width: 84%">
        <div class="d-flex gap-2 me-1 justify-content-end align-items-center">
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white">Ikuti kami di <i
                    class="bi bi-facebook"></i> <i class="bi bi-instagram"></i></a>
            <div class="low-divider"></div>
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white"><i
                    class="bi bi-question-circle"></i> Bantuan</a>
        </div>
        <div class="d-flex gap-2 me-1 justify-content-end align-items-center">
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white"><i
                    class="bi bi-bell"></i> Notifikasi</i></a>
            <div class="low-divider"></div>
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white"><img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1713402631~exp=1713403231~hmac=0479d616f3678fd9ef2e1f0e048d648ade1cdd2178660fb31ea7d613b5c46692" style="width : 20px;" alt="" class="rounded-circle"> Rahul Sentoyo</a>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-light shadow"
    style="height: 80px; margin-top: 36px">
    <div class="container-fluid mx-4" style="width: 84%">
        <div class="d-flex align-items-center justify-content-between" style="width: 20%;">
            <a class="navbar-brand font-main-color" href="{{ route('user-home') }}"><strong>E-COMM</strong></a>
            <div class="divider" style="background-color: #6777ef"></div>
            <a href="#categoryCollapse" class="font-main-color ms-2" style="text-decoration: none;" data-bs-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="categoryCollapse"
                id="categoryCollapseToggle">Keranjang Belanja</a>
        </div>
        <form class="d-flex" role="search">
            <div class="input-group">
                <input type="text" class="form-control rounded-0" id="search-cart" placeholder="Search..."
                    style="box-shadow: none; width: 600px;">
                <div class="input-group-append" style="height : 80%;">
                    <button class="btn btn-light input-group-text rounded-0 border-0 text-white bg-main-color"
                        style="width: 60x">
                        <i class="bi bi-search" style="font-size: 25px;"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</nav>
