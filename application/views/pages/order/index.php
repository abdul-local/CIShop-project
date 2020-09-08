<main role="main" class="container">
<?php $this->load->view('layouts/_alert') ?>
<div class="col-md-10 mx-auto">
  <div class="card">
  <div class="card-header mb-3">
    <span>Order</span>
    <div class="float-right">
    <?= form_open(base_url('index.php/order/search'), ['method' => 'POST']) ?>
            <div class="input-group">
            <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Cari" value="<?= $this->session->userdata('keyword') ?>">
            <div class="input-group-append">
			    <button class="btn btn-info btn-sm" type="submit">
					<i class="fas fa-search"></i>
				</button>
						<a href="<?= base_url("index.php/order/reset") ?>" class="btn btn-info btn-sm">
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
                     <tr>
                         <th>Nomer Order</th>
                         <th>Tanggal</th>
                         <th>Total</th>
                         <th>Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach($content as $row) : ?>
                     <tr>
                         <td><a href="<?= base_url("index.php/order/detail/$row->id")?>"><strong>#<?=$row->invoice ?></strong></a></td>
                         <td><?=str_replace('-','/', $row->date) ?></td>
                         <td>Rp.<?= number_format($row->total,0,',','.')?>-</td>
                         <td><?php $this->load->view('layouts/_status',['status'=>$row->status])?></td>
                     </tr>
                     <?php endforeach ?>
                 </tbody>
             </table>
    <nav aria-label="Page navigation example">
        <?= $pagination ?>
</nav>
  </div>
</div>  
</div>
</main>