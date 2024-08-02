<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Implementasi Perhitungan Certainty Factor</h1>
<div class="page-wrapper">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <ul class="collapsible">
                        <li class="active">
                            <div class="collapsible-header"><i class="material-icons">table_view</i>Tabel Rule Penyakit
                                x Gejala</div>
                            <div class="collapsible-body">
                                <div class="table-wrapper" style="overflow: auto; max-height: 20rem;">
                                    <table class="striped highlight responsive-table" id="table-rule">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">calculate</i>Perhitungan</div>
                            <div class="collapsible-body">
                                <form action="" class="row" method="POST" id="form-calculate">
                                    <div class="question"></div>
                                    <div class="col s12 input-field">
                                        <button class="btn waves-effect waves-light green" type="submit"><i
                                                class="material-icons left">calculate</i>Hitung</button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col s12 m6 offset-m3">
                                        <table id="result">
                                            <thead>
                                                <tr>
                                                    <th>Kode Penyakit</th>
                                                    <th>Nama Penyakit</th>
                                                    <th>CF</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>