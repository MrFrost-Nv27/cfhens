<?php
/** @var \CodeIgniter\View\View $this */
?>

<?=$this->extend('layouts/panel/main')?>
<?=$this->section('main')?>
<h1 class="page-title">Dashboard</h1>
<div style="overflow:auto">
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="count-card">
                    <div class="count-number" data-entity="service">0</div>
                    <div class="count-desc">
                        <p><b>Jumlah</b></p>
                        <p>Data Penyakit</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="count-card">
                    <div class="count-number" data-entity="customer">0</div>
                    <div class="count-desc">
                        <p><b>Jumlah</b></p>
                        <p>Data Gejala</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="count-card">
                    <div class="count-number" data-entity="customer">0</div>
                    <div class="count-desc">
                        <p><b>Jumlah</b></p>
                        <p>Data Rule</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="text-card">
                    <p>
                        Industri peternakan ayam petelur memiliki peranan penting dalam penyediaan sumber protein hewani
                        yang murah dan bergizi bagi masyarakat. Namun, keberhasilan dalam usaha peternakan ayam petelur
                        sering kali dihadapkan pada berbagai tantangan, salah satunya adalah masalah kesehatan ternak.
                        Penyakit yang menyerang ayam petelur tidak hanya dapat menurunkan produktivitas telur, tetapi
                        juga dapat menyebabkan kematian massal yang berdampak pada kerugian ekonomi yang signifikan bagi
                        peternak.
                        <br><br>
                        Dalam menghadapi tantangan ini, deteksi dini dan diagnosa penyakit yang tepat pada ayam petelur
                        menjadi sangat krusial. Namun, proses diagnosa penyakit sering kali memerlukan keahlian khusus
                        dan waktu yang tidak sedikit, terutama bagi peternak yang berada di daerah terpencil dengan
                        akses terbatas ke layanan kesehatan hewan profesional. Untuk mengatasi masalah ini, diperlukan
                        suatu sistem yang dapat membantu peternak dalam melakukan diagnosa penyakit secara cepat dan
                        akurat.
                        <br><br>
                        Sistem Diagnosa Penyakit pada Ayam Petelur menggunakan metode Certainty Factor hadir sebagai
                        solusi inovatif untuk memenuhi kebutuhan tersebut. Metode Certainty Factor adalah pendekatan
                        berbasis pengetahuan yang memungkinkan penilaian tingkat kepastian terhadap suatu diagnosa
                        berdasarkan gejala-gejala yang muncul. Dengan menggabungkan teknologi informasi dan pengetahuan
                        medis veteriner, sistem ini dirancang untuk memberikan dukungan kepada peternak dalam
                        mengidentifikasi penyakit pada ayam petelur secara efektif.
                        <br><br>
                        Sistem ini tidak hanya memberikan diagnosa penyakit berdasarkan gejala yang dimasukkan oleh
                        pengguna, tetapi juga memberikan rekomendasi tindakan yang harus diambil untuk mengatasi
                        penyakit tersebut. Melalui antarmuka yang user-friendly dan berbasis web, sistem ini dapat
                        diakses dengan mudah oleh peternak dari berbagai lokasi, sehingga dapat membantu dalam mengambil
                        keputusan yang cepat dan tepat untuk menjaga kesehatan ternak mereka.
                        <br><br>
                        Dengan adanya Sistem Diagnosa Penyakit pada Ayam Petelur menggunakan metode Certainty Factor,
                        diharapkan peternak dapat lebih proaktif dalam memantau kesehatan ternak mereka, mencegah
                        penyebaran penyakit, dan meningkatkan produktivitas peternakan. Teknologi ini merupakan langkah
                        maju dalam mendukung keberlanjutan industri peternakan ayam petelur dan kesejahteraan para
                        peternak.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>