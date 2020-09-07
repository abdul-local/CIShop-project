<main role="main" class="container">
<?php $this->load->view('layouts/_alert') ?>
<div class="row">
<?php $this->load->view('layouts/_menu') ?>

    <div class="col-md-9">
       <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
         <div class="card-header">
             Detail Orders #<?= $order->invoice ?>
             <div class="float-right">
                 <?php $this->load->view('layouts/_status',['status'=>$order->status]) ?>
             </div>
         </div> 
         <div class="card-body">
             <p>Tanggal: <?= str_replace('-','/',date("d-m-Y",strtotime($order->date)))?></p>
            <p>Nama: <?= $order->name ?></p>
            <p>Telephon:<?= $order->phone ?></p>
            <p>Almat: <?= $order->address ?></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders_detail as $row) : ?>
                    <tr>
                        <td>
                            <p><img src="<?= $row->product_image ? base_url("/images/product/$row->product_image") : base_url("images/product/default.png") ?>" alt="" height="100" >
                            <strong> <?= $row->product_title ?></strong></p>
                        </td>
                        <td class="text-center">
                            RP.<?=number_format($row->product_price,0,',','.')?>,-
                        </td>
                        <td class="text-center">
                        <?= $row->qty ?>
                        </td>
                        <td class="text-center">
                            Rp.<?= number_format($row->subtotal,0,'.','.')?>,-
                        </td>
                    </tr>
                    <?php endforeach ?>
                    
                    <tr>
                    <td colspan="3"><strong>Total: </strong></td>
                    <td class="text-center"><strong>Rp.<?= number_format(array_sum(array_column($orders_detail,'subtotal')),0,',','.')?>,-</strong></td>
                    </tr>
                    
                    
                </tbody>
            </table>
         </div>
         <div class="card-footer">
             <a href="/order.confirmasi.html" class="btn btn-success">Konfirmasi Pembayaran</a>
         </div>
     </div>
   </div>
   </div>
    </div>
</div>
</main>