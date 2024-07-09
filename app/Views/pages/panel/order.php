<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Data Pemesanan</h1>
<div class="page-wrapper">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-12 text-end">
                    <button class="btn waves-effect waves-light green btn-slider btn-action" data-action="add"
                        type="button" data-target="form"><i class="material-icons left">add</i>Tambah</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="striped highlight responsive-table" id="table-order" width="100%">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page slider" data-page="form">
        <div class="row">
            <div class="col-12">
                <button class="btn waves-effect waves-light btn-slider-close orange darken-2"><i
                        class="material-icons left">arrow_back</i>Kembali</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <form class="col s12 m6 offset-m3 form" id="form-order" action="" method="POST">
                    <h1 class="form-title">Tambah Data Pemesanan</h1>
                    <div class="row">
                        <div class="input-field col s10">
                            <input name="customer_display" id="customer_display" type="text" class="validate" disabled>
                            <label for="customer_display">Pelanggan</label>
                        </div>
                        <div class="input-field col s2">
                            <a href="#" class="btn waves-effect waves-light btn-popup blue disabled btn-action" data-action="customer" data-target="customer"><i
                                    class="material-icons">search</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10">
                            <input name="service_display" id="service_display" type="text" class="validate" disabled>
                            <label for="service_display">Layanan</label>
                        </div>
                        <div class="input-field col s2">
                            <a href="#" class="btn waves-effect waves-light btn-popup blue disabled btn-action" data-action="service" data-target="service"><i
                                    class="material-icons">search</i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="total_display" id="total_display" type="number" class="validate" disabled>
                            <label for="total_display">Harga</label>
                        </div>
                    </div>
                    <input type="hidden" name="customer_id" id="customer_id">
                    <input type="hidden" name="service_id" id="service_id">
                    <input type="hidden" name="total" id="total">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" class="order-datepicker" name="date" id="date">
                            <label for="date">Tanggal Pesanan</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="note" name="note" class="materialize-textarea"></textarea>
                            <label for="note">Catatan (Opsional)</label>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="input-field col s12 center">
                    <button class="btn waves-effect waves-light green" type="submit"><i
                            class="material-icons left">save</i>Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?=$this->endSection()?>

<?=$this->section('popup')?>
<div class="popup" data-page="customer">
    <h1>Pilih Pelanggan</h1>
    <form action="" id="picker-customer" class="row">
        <div class="input-field col s12">
            <input name="customer-query" id="customer-query" type="text" class="validate"
                placeholder="Cari Pelanggan ...">
        </div>
        <div class="row">
            <div class="input-field col s12">
                <div class="collection">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="popup" data-page="service">
    <h1>Pilih Layanan</h1>
    <form action="" id="picker-service" class="row">
        <div class="input-field col s12">
            <input name="service-query" id="service-query" type="text" class="validate"
                placeholder="Cari Pelanggan ...">
        </div>
        <div class="row">
            <div class="input-field col s12">
                <div class="collection">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="popup side" data-page="detail">
    <h1>Detail Pemesanan</h1>
    <br>
    <form action="" id="detail-order" class="row">
        <div class="input-field col s12">
            <input disabled name="customer.name" id="customer.name" type="text">
            <label for="customer.name">Nama Pelanggan</label>
        </div>
        <div class="input-field col s12">   
            <textarea disabled id="customer.address" name="customer.address" class="materialize-textarea"></textarea>
            <label for="customer.address">Alamat Pelanggan</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="service.name" id="service.name" type="text">
            <label for="service.name">Nama Layanan</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-total" id="detail-total" type="text">
            <label for="detail-total">Harga</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-date" id="detail-date" type="text">
            <label for="detail-date">Tanggal</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-note" id="detail-note" type="text">
            <label for="detail-note">Catatan</label>
        </div>
    </form>
</div>
<?=$this->endSection()?>