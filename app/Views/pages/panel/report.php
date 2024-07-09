<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Data Laporan</h1>
<div class="page-wrapper">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="input-field col s12 m5">
                    <input type="text" name="report-start" id="report-start" class="report-datepicker">
                    <label for="report-date">Tanggal Dari</label>
                </div>
                <div class="input-field col s12 m5">
                    <input type="text" name="report-end" id="report-end" class="report-datepicker">
                    <label for="report-date">Tanggal Sampai</label>
                </div>
                <div class="input-field col s12 m2 center">
                    <button class="btn waves-effect waves-light green btn-slider btn-action" data-action="filter"
                        type="button" data-target="form"><i class="material-icons">search</i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="striped highlight responsive-table" id="table-report" width="100%">
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
<?=$this->endSection()?>