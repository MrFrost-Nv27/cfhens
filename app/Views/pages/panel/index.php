<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Dashboard</h1>
<div class="container">
    <div class="row">
        <div class="col s12 m6 m3">
            <div class="count-card">
                <div class="count-number" data-entity="service">0</div>
                <div class="count-desc">
                    <p><b>Jumlah</b></p>
                    <p>Data Layanan</p>
                </div>
            </div>
        </div>
        <div class="col s12 m6 m3">
            <div class="count-card">
                <div class="count-number" data-entity="customer">0</div>
                <div class="count-desc">
                    <p><b>Jumlah</b></p>
                    <p>Data Pelanggan</p>
                </div>
            </div>
        </div>
        <div class="col s12 m6 m3">
            <div class="count-card">
                <div class="count-number" data-entity="user">0</div>
                <div class="count-desc">
                    <p><b>Jumlah</b></p>
                    <p>Data Admin</p>
                </div>
            </div>
        </div>
        <div class="col s12 m6 m3">
            <div class="count-card">
                <div class="count-number" data-entity="repair">0</div>
                <div class="count-desc">
                    <p><b>Jumlah</b></p>
                    <p>Data Service</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>