<main role="main" class="container">
<?php $this->load->view('layouts/_alert') ?>
<div class="row">
<?php $this->load->view('layouts/_menu') ?>
    <div class="col-md-9">
       <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
         <div class="card-header">
            <strong> Detail Orders #<?= $order->invoice ?></strong>
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
         <?php if($order->status == 'waiting') : ?>
         <div class="card-footer">
             <a href="<?= base_url("index.php/myorder/confirm/$order->invoice") ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
         </div>
         <?php endif ?>
         </div>
         <?php if(isset($orders_confirm)) : ?>
         <div class="row mb-3">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-header">
                         Bukti Transfer
                     </div>
                     <div class="card-body">
                         <p>No Rekening:<?= $orders_confirm->account_number ?> </p>
                         <p>Atas Nama:<?= $orders_confirm->account_name ?>  </p>
                         <p>Nominal <?= $orders_confirm->nominal ?> :</p>
                         <p>Catetan : <?= $orders_confirm->note ?> </p>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 
                 <img src="<?= base_url("/images/confirm/$orders_confirm->image")?>" alt="">
    
         </div>
         <?php endif ?>
     </div>
   </div>
   </div>
    </div>
</div>
</main>