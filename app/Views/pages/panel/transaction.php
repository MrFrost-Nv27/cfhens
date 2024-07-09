<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Transaksi Pemesanan</h1>
<div class="page-wrapper">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="striped highlight responsive-table" id="table-transaction" width="100%">
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
</div>
</div>
<?=$this->endSection()?>

<?=$this->section('popup')?>
<div class="popup" data-page="pay">
    <h1>Pembayaran Pemesanan</h1>
    <br>
    <form action="" id="form-payment">
        <input type="hidden" name="order_id" id="order_id">
        <div class="row">
            <div class="input-field col s12">
                <input id="total" name="total" type="number" class="validate" disabled>
                <label for="total">Nominal</label>
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