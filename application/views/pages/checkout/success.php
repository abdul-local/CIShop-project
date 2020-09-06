
<main role="main" class="container">
<?php $this->load->view('layouts/_alert') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Checkout Berhasil
            </div>
            <div class="card-body">
                <h5>Nomer Order: <?= $invoice ?></h5>
                <p>Terima Kasih, Sudah Berbelanja</p>
                <p>Silahkan lakukan pembayaran untuk kami proses selanjutnya dengan cara: </p>
                <ol>
                    <li>Lakukan pembayaran pada rekening <strong>BRI 34564889656</strong> a/n PT.CIShop Abdul</li>
                    <li>Sertakan keterangan dengan Nomer order: <strong><?=$invoice ?></strong></li>
                    <li>Total pembayaran: <strong>Rp <?= number_format($total,0,',','.')?>,-</strong></li>
                </ol>
                <p>Jika sudah, silahkan kirimkan bukti transfer di halaman konfirmasi atau bisa <a href="/orders-detail.html">Klik disini</a>!</p>
                <a href="<?= base_url()?>" class="btn btn-primary"><i class="fas fa-angle-left">Kembali</i></a>
            </div>
        </div>
    </div>
</div>
</main>