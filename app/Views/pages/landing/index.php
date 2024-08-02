<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/landing/main')?>
<?=$this->section('main')?>


<div class="page" id="hero">
    <div class="herotext-wrapper">
        <h1>Diagnosa Penyakit <br>Ayam Petelur</h1>
        <div class="desc">
            <h2>Diagnosa penyakit pada ayam petelur menggunakan metode certainty factor</h2>
            <br>
            <p>Menghadapi tantangan kesehatan dalam peternakan ayam petelur memerlukan solusi yang cepat dan akurat.
                Sistem Diagnosa Penyakit pada Ayam Petelur menggunakan metode Certainty Factor hadir sebagai inovasi
                yang membantu peternak dalam mendeteksi dan menangani penyakit pada ternak mereka dengan lebih efektif.
                Dengan memanfaatkan teknologi berbasis pengetahuan, sistem ini memberikan diagnosa yang dapat diandalkan
                dan rekomendasi penanganan yang tepat, sehingga peternak dapat menjaga kesehatan ayam petelur mereka
                serta meningkatkan produktivitas dan keberlanjutan usaha peternakan.</p>
        </div>
        <a href="#" class="next-page">Mulai <i class="material-icons">arrow_downward</i></a>
    </div>
    <div class="hero-wrapper">
        <img src="<?=base_url('img/hero.png')?>" class="hero" alt="hero">
    </div>
</div>
<div class="page factor" id="factor">
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <a href="#" class="back-page">Kembali <i class="material-icons">arrow_upward</i></a>
                <br><br>
                <h1>Daftar Penyakit</h1>
                <br>
                <table id="disease">
                    <thead>
                        <tr>
                            <th class="center" style="width: 3rem">No</th>
                            <th>Nama Penyakit</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col s12 m6">
                <br><br>
                <h1>Diagnosa Penyakit</h1>
                <br>
                <form action="" class="row" method="POST" id="form-diagnosa">
                    <div class="question"></div>
                    <div class="col s12 input-field">
                        <button class="btn waves-effect waves-light green" type="submit"><i
                                class="material-icons left">check</i>Diagnosa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<a href="<?=base_url('kelola')?>" class="btn-login"><i class="material-icons">tune</i> Kelola</a>
<?=$this->endSection()?>