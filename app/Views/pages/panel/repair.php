<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Data Service</h1>
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
                        <table class="striped highlight responsive-table" id="table-repair" width="100%">
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
                <form class="col s12 m6 offset-m3 form" id="form-repair" action="" method="POST">
                    <h1 class="form-title">Tambah Data Service</h1>
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
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="name" id="name" type="text" class="validate" required>
                            <label for="name">Nama Service</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="price" id="price" type="number">
                            <label for="price">Harga</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" class="repair-datepicker" name="date" id="date" required>
                            <label for="date">Tanggal Service</label>
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
    <h1>Detail Service</h1>
    <br>
    <form action="" id="detail-repair" class="row">
        <input type="hidden" name="detail-id" id="detail-id">
        <div class="input-field col s12">
            <input disabled name="customer.name" id="customer.name" type="text">
            <label for="customer.name">Nama Pelanggan</label>
        </div>
        <div class="input-field col s12">   
            <textarea disabled id="customer.address" name="customer.address" class="materialize-textarea"></textarea>
            <label for="customer.address">Alamat Pelanggan</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-name" id="detail-name" type="text">
            <label for="detail-name">Nama Service</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-price" id="detail-price" type="text">
            <label for="detail-price">Harga</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-date" id="detail-date" type="text">
            <label for="detail-date">Tanggal Service</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-pay" id="detail-pay" type="text">
            <label for="detail-pay">Nominal Bayar</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-paydate" id="detail-paydate" type="text">
            <label for="detail-paydate">Tanggal Pembayaran</label>
        </div>
        <div class="input-field col s12">
            <input disabled name="detail-note" id="detail-note" type="text">
            <label for="detail-note">Catatan</label>
        </div>
    </form>
</div>
<div class="popup side" data-page="edit">
    <h1>Edit Service</h1>
    <br>
    <form action="" id="form-edit" class="row">
        <input type="hidden" name="id" id="edit-id">
        <div class="input-field col s12">
            <input name="name" id="edit-name" type="text" required>
            <label for="edit-name">Nama Service</label>
        </div>
        <div class="input-field col s12">
            <input name="price" id="edit-price" type="text">
            <label for="edit-price">Harga</label>
        </div>
        <div class="input-field col s12">
            <input name="date" id="edit-date" type="text" required>
            <label for="edit-date">Tanggal Service</label>
        </div>
        <div class="input-field col s12">
            <input name="note" id="edit-note" type="text">
            <label for="detail-note">Catatan</label>
        </div>
        <div class="input-field col s12 center">
            <button class="btn waves-effect waves-light green" type="submit"><i
                    class="material-icons left">save</i>Simpan</button>
        </div>
    </form>
</div>

<div class="popup" data-page="pay">
    <h1>Pembayaran Service</h1>
    <br>
    <form action="" id="form-payment">
        <input type="hidden" name="id" id="pay-id">
        <div class="row">
            <div class="input-field col s12">
                <input id="pay-price" name="price" type="number" class="validate" disabled>
                <label for="pay-price">Nominal</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="pay" name="pay" type="number" class="validate" required>
                <label for="pay">Jumlah Bayar</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="return" name="return" type="number" class="validate" disabled>
                <label for="return">Kembalian</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 center">
                <button class="btn waves-effect waves-light green" type="submit"><i
                        class="material-icons left">payment</i>Bayar</button>
            </div>
        </div>
    </form>
</div>
<?=$this->endSection()?>