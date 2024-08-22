<?php

/** @var \CodeIgniter\View\View $this */
?>

<?= $this->extend('layouts/panel/main') ?>
<?= $this->section('main') ?>
<h1 class="page-title">Data Rule Diagnosa</h1>
<div class="page-wrapper">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-6 center">
                    <a class="btn-header-slider green btn-popup btn-action" data-title="Tambah" data-action="add" data-target="add" type="button">
                        <i class="material-icons">add</i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="table-wrapper">
                        <table class="striped highlight responsive-table" id="table-rule" width="100%">
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
<?= $this->endSection() ?>

<?= $this->section('popup') ?>
<div class="popup side" data-page="add">
    <form class="form" id="form-add" method="POST">
        <div class="flex flex-row justify-between items-center">
            <button class="btn-header-slider waves-effect waves-light btn-slider-close orange darken-2" type="button" data-title="Kembali">
                <i class="material-icons">arrow_back</i>
            </button>
            <button class="btn-header-slider waves-effect waves-light green" type="submit" data-title="Simpan">
                <i class="material-icons">save</i>
            </button>
        </div>

        <h1 class="form-title">Tambah Rules Diagnosa</h1>
        <div class="row">
            <div class="input-field col m6 s12">
                <input type="text" id="code" name="code" required>
                <label for="code">Kode Rule</label>
            </div>

            <div class="input-field col m6 s12">
                <select name="disease_id" id="disease" required>
                    <option value="" disabled selected>Pilih Penyakit</option>
                </select>
                <label for="disease">Penyakit</label>
            </div>

            <div class="input-field col m12 s12">
                <div id="symptom"></div>
            </div>
        </div>
    </form>
</div>
<div class="popup side" data-page="edit">
    <form class="form" id="form-edit" method="POST">
        <div class="flex flex-row justify-between items-center">
            <button class="btn-header-slider waves-effect waves-light btn-slider-close orange darken-2" type="button" data-title="Kembali">
                <i class="material-icons">arrow_back</i>
            </button>
            <button class="btn-header-slider waves-effect waves-light green" type="submit" data-title="Simpan">
                <i class="material-icons">save</i>
            </button>
        </div>

        <h1 class="form-title">Edit Rules Diagnosa</h1>
        <div class="row">

            <div class="input-field col m6 s12">
                <input type="text" id="code_edit" name="code_edit" required readonly>
                <label for="code_edit">Kode Rule</label>
            </div>
            <div class="input-field col m6 s12">
                <select name="disease_id_edit" id="disease_edit" required>
                    <option value="" disabled selected>Pilih Penyakit</option>
                </select>
                <label for="disease_edit">Penyakit</label>
            </div>
            <div class="input-field col m12 s12">
                <div id="symptom_edit"></div>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection() ?>