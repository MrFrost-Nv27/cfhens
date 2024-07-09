<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/landing/main')?>
<?=$this->section('main')?>

<div class="nav-wrapper">
    <div></div>
    <div class="nav-list">
        <a href="<?= base_url('login') ?>" class="nav-btn"><i class="material-icons">login</i> <span>Masuk</span></a>
    </div>
</div>
<div class="hero-wrapper">
    <img src="<?=base_url('img/hero.png')?>" class="hero" alt="hero">
    <h1 style="text-align: center;">Selamat Datang di Web<br><b>Walicung</b></h1>
</div>

<?=$this->endSection()?>