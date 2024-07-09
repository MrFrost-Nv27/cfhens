<a href="#!" class="nav-close"><i class="material-icons">menu</i></a>
<div class="nav-header">
    <img src="<?=base_url('img/logo/logo-light.png')?>" class="logo" alt="logo">
    <h1><b>JOSH</b><br>AUTO DETAILING</h1>
</div>
<div class="nav-list">
    <div class="nav-item" data-page="dashboard">
        <a href="<?= base_url('panel') ?>" class="nav-link"><i class="material-icons">dashboard</i>Dashboard</a>
    </div>
    <div class="nav-item" data-page="customer">
        <a href="<?= base_url('panel/customer') ?>" class="nav-link"><i class="material-icons">badge</i>Data Pelanggan</a>
    </div>
    <div class="nav-item" data-page="service">
        <a href="<?= base_url('panel/service') ?>" class="nav-link"><i class="material-icons">local_car_wash</i>Data Layanan Salon</a>
    </div>
    <div class="nav-item" data-page="order">
        <a href="<?= base_url('panel/order') ?>" class="nav-link"><i class="material-icons">edit_square</i>Data Pemesanan</a>
    </div>
    <div class="nav-item" data-page="transaction">
        <a href="<?= base_url('panel/transaction') ?>" class="nav-link"><i class="material-icons">credit_card</i>Transaksi Pemesanan</a>
    </div>
    <div class="nav-item" data-page="report">
        <a href="<?= base_url('panel/report') ?>" class="nav-link"><i class="material-icons">library_books</i>Data Laporan</a>
    </div>
    <div class="nav-item" data-page="user">
        <a href="<?= base_url('panel/user') ?>" class="nav-link"><i class="material-icons">group</i>Data Pengguna Sistam</a>
    </div>
    <div class="nav-item" data-page="repair">
        <a href="<?= base_url('panel/repair') ?>" class="nav-link"><i class="material-icons">handyman</i>Data Service</a>
    </div>
</div>
<div class="nav-bottom">
    <a href="<?=base_url('logout')?>" class="button btn-logout">Keluar</a>
</div>