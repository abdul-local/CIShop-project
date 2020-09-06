
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
                <form action="">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan nama penerima">
                        <small class="form-text text-danger">Nama harus diisi.</small>
                    </div>
                    <div class="form-group">
                        <label >Alamat</label>
                        <textarea name="adress" id="" cols="30" rows="5" class="form-control"></textarea>
                        <small class="form-text text-danger">Alamat harus disi.</small>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Masukan nomer Telephon penerima">
                        <small class="form-text text-danger">No telephon harus diisi.</small>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
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