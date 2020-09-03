<main role="main" class="container">
    <?php $this->load->view('layouts/_alert'); ?>
<div class="col-md-10 mx-auto">
  <div class="card">
  <div class="card-header mb-3">
    <span>Produk</span>
    <a href="<?= base_url('index.php/product/create'); ?>" class="btn btn-sm btn-secondary">Tambah</a>
    <div class="float-right">
    <?= form_open(base_url('index.php/product/search'), ['method' => 'POST']) ?>
            <div class="input-group">
            <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Cari" value="<?= $this->session->userdata('keyword') ?>">
            <div class="input-group-append">
			    <button class="btn btn-info btn-sm" type="submit">
					<i class="fas fa-search"></i>
				</button>
						<a href="<?= base_url("index.php/product/reset") ?>" class="btn btn-info btn-sm">
						<i class="fas fa-eraser"></i>
						</a>
				</div>
            </div>
        </form>
    </div>
  </div>
  <div class="card-body">
   <table class="table">
       <thead>
           <th scope="col">#</th>
           <th scope="col">Produk</th>
           <th scope="col">Kategori</th>
           <th scope="col">Harga</th>
           <th scope="col">Stock</th>
           <th scope="col"></th>
       </thead>
       <tbody>
           <?php $no=0 ; foreach($content as $row) : $no++ ?>
           <tr>
               <td><?= $no ?></td>
               <td>
              <p><img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.png") ?>" alt="" height="50">
              <strong><?= $row->product_title ?></strong>
              </p>
               </td>
               <td><span class="badge badge-primary"><i class="fas fa-tags"></i> <?= $row->category_title;?></span></td>
               <td>Rp<?=number_format($row->price, 0 ,',' ,'.') ?>,-</td>
               <td><?= $row->is_available ? 'Tersedia' : 'Kosong' ?></td>
               <td>
                  <?= form_open("product/delete/$row->id",['method'=>'POST'])?>
                  <?= form_hidden('id',$row->id); ?>
                      <a href="<?= base_url("index.php/product/edit/$row->id"); ?>">
                              <i class="fas fa-edit text-info"></i>
                          </a>
                          <button class="btn btn-sm" type="submit"  onclick ="return confirm('Are you sure to delete ?')">
                              <i class="fas fa-trash text-danger"></i>
                          </button>
                     
                  <?= form_close()?>
               </td>
           </tr>
        <?php endforeach; ?>
       </tbody>
   </table>
      <nav aria-label="Page navigation example">
 <?= $pagination ?>
</nav>
  </div>
</div>  
</div>
 
</main>