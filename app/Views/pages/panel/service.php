<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Data Layanan Salon</h1>
<div class="page-wrapper">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-12 text-end">
                    <button class="btn waves-effect waves-light green btn-slider btn-action" data-action="add" type="button"
                        data-target="form"><i class="material-icons left">add</i>Tambah</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="striped highlight responsive-table" id="table-service" width="100%">
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
                <form class="col s12 m6 offset-m3 form" id="form-service" action="" method="POST">
                    <h1 class="form-title">Tambah Data Layanan</h1>
                    <div class="row">
                        <div class="upload-image">
                            <i class="material-icons">add_a_photo</i>
                            <a data-fancybox data-src="<?=base_url('img/service.png')?>" data-caption="Service's Image" class="fancy-image">
                                <img src="<?=base_url('img/service.png')?>" class="hide" alt="service">
                            </a>
                        </div>
                        <div class="col s12 center">
                            <a href="#!" class="btn waves-effect waves-light btn-upload blue"><i
                            class="material-icons left">file_upload</i> Upload</a>
                        </div>
                        <input type="hidden" name="id" id="id">
                        <input type="file" name="image" id="image" class="hide">
                        <div class="col s12">
                            <br>
                        </div>
                        <div class="input-field col s12">
                            <input name="name" id="name" type="text" class="validate" required>
                            <label for="name">Nama Layanan</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="price" id="price" type="number" class="validate" required>
                            <label for="price">Harga Layanan</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="address" name="address" class="materialize-textarea"></textarea>
                            <label for="address">Deskripsi (Opsional)</label>
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