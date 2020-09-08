
<main role="main" class="container">
<?php $this->load->view('layouts/_alert') ?>
<div class="col-md-10 mx-auto">
   <div class="row mb-3">
       <div class="col-md-12">
        <div class="card">
         <div class="card-header">
             Detail Orders #<strong><?= $order->invoice ?></strong>
             <div class="float-right">
                 <span class="badge badge-pill badge-info">Menunggu Pembayaran</span>
             </div>
         </div> 
         <div class="card-body">
            <p>Nama: <?= $order->name ?></p>
            <p>Telephon: <?= $order->phone ?> </p>
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
                    <?php foreach($orders_detail as $row ) : ?>
                    <tr>
                        <td>
                            <p><img src="<?= $row->product_image ? base_url("/images/product/$row->product_image"): base_url("/images/product/default.png") ?> " alt="" height="100">
                            <strong><?=$row->product_title ?></strong></p>
                        </td>
                        <td class="text-center">
                            RP.<?= number_format($row->product_price,0,',','.') ?>,-
                        </td>
                        <td class="text-center">
                        <?= $row->qty ?>
                        </td>
                        <td class="text-center">
                        RP.<?= number_format($row->subtotal,0,',','.') ?>,-
                        </td>
                    </tr>
                    <tr>
                    <td colspan="3"><strong>Total: </strong></td>
                    <td class="text-center"><strong>Rp.<?=number_format(array_sum(array_column($orders_detail,'subtotal')),0,',','.') ?>,-</strong></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
         </div>
         <div class="card-footer">
            <form action="<?=base_url("index.php/order/update/$order->id")?>" method="POST">
                <div class="input-group">
                    <select name="status" id="" class="form-control">
                        <option value="waiting" <?=$order->status =='waiting' ? 'selected' :'' ?>>Menunggu Pembayaran</option>
                        <option value="paid"<?=$order->status =='paid' ? 'selected' :'' ?>>Dibayar</option>
                        <option value="delivered" <?=$order->status =='delivered' ? 'selected' :''?>>Dikirim</option>
                        <option value="cancel"<?=$order->status =='cancel' ? 'selected' :'' ?>>Dibatalkan</option>
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
         </div> 
       </div>
   </div>
   </div>
   <?php if(isset($orders_confirm)) : ?>
      <div class="row mb-3">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                   Bukti Transfer
               </div>
               <div class="card-body">
                   <p>Dari Rekening: <?=$orders_confirm->account_number ?></p>
                   <p>Atas Nama: <?=$orders_confirm->account_name ?></p>
                   <p>Nominal: Rp.<?=number_format($orders_confirm->nominal,0,'.','.')?>,-</p>
                   <p><?=$orders_confirm->note ?></p>
               </div>
           </div>
       </div>
       <div class="col-md-4">
           <img src="<?= base_url("/images/confirm/$orders_confirm->image")?>" alt="">
       </div>
   </div>
   </div>
   <?php endif ?>
</main>