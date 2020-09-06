
<main role="main" class="container">
    <?php $this->load->view('layouts/_navbar') ?>
    <?php $this->load->view('layouts/_alert') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Formulir Alamat Pengiriman
            </div>
            <div class="card-footer">
                <?= form_open(base_url("index.php/checkout/create"),['method'=>'POST']) ?>
                    <div class="form-group">
                        <label>Nama</label>
                        <?=form_input(['name'=>'name','type'=>'text'],$input->name,['class'=>'form-control','placeholder'=>'masukan nama penerima'])?>
                        <?= form_error('name')?>
                    </div>
                    <div class="form-group">
                        <label >Alamat</label>
                        <?= form_textarea(['name'=>'address', 'value'=>$input->address,'row'=>'5' ,'class'=>'form-control']) ?>
                        <?= form_error('address') ?>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <?= form_input(['name'=>'phone'],$input->phone,['class'=>'form-control','placeholder'=>'masukan nomer telephone'])?>
                        <?= form_error('phone') ?>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
       <div class="row">
           <div class="col-md-12">
               <div class="card mb-3">
                   <div class="card-header">
                       Cart
                   </div>
                   <div class="card-body">
                       <table class="table">
                           <thead>
                               <tr>
                                   <th>Produk</th>
                                   <th>Qt</th>
                                   <th>Harga</th>
                               </tr>
                           </thead>
                           <tbody>
                           <?php foreach($cart as $row) : ?>
                               <tr>
                                   <td><?= $row->product_title ?></td>
                                   <td><?= $row->qty ?></td>
                                   <td>Rp <?= number_format($row->product_price,'0',',','.')?>,-</td>
                               </tr>
                               <tr>
                                   <td colspan="2">Subtotal</td>
                                   <td>Rp <?= number_format($row->subtotal,'0',',','.')?>,-</td>
                               </tr>
                               <?php endforeach ?>
                           </tbody>
                           <tfoot>
                               <tr>
                                   <th colspan="2">Total</th>
                                   <th>Rp.<?= number_format(array_sum(array_column($cart, 'subtotal')),0,',','.') ?>,-</th>
                               </tr>
                           </tfoot>
                       </table>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
 
</main>