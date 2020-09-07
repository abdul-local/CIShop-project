
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
                     <tr>
                         <td><a href="/oders-detail.html"><strong>#0135674</strong></a></td>
                         <td>2020/08/27</td>
                         <td>Rp.200.000-</td>
                         <td><span class="badge badge-pill badge-warning">Menunggu Pembayaran</span></td>
                     </tr>
                      <tr>
                         <td><a href="/oders-detail.html"><strong>#0135739</strong></a></td>
                         <td>2020/08/22</td>
                         <td>Rp.200.000-</td>
                         <td><span class="badge badge-pill badge-success">Dikirim</span></td>
                     </tr>
                      <tr>
                         <td><a href="/oders-detail.html"><strong>#0134648</strong></a></td>
                         <td>2020/07/20</td>
                         <td>Rp.200.000-</td>
                         <td><span class="badge badge-pill badge-danger">Dibatalkan</span></td>
                     </tr>
                 </tbody>
             </table>
         </div> 
       </div>
    </div>
</div>
</main>