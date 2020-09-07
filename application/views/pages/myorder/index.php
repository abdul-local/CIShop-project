
<main role="main" class="container">
<div class="row">
    <?php $this->load->view('layouts/_menu') ?>
    <div class="col-md-9">
       <div class="card">
         <div class="card-header">
             Daftar Orders
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
                         <td><a href="/oders-detail.html"><strong>#<?= $row->invoice ?></strong></a></td>
                         <td><?= $row->date ?></td>
                         <td>Rp.<?=number_format($row->total,0,',','.') ?>-</td>
                         <td><span class="badge badge-pill badge-warning"><?= $row->status ?></span></td>
                     </tr>
                     <?php endforeach ?>
                 </tbody>
             </table>
         </div> 
       </div>
    </div>
</div>
</main>