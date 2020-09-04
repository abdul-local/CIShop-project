
<main role="main" class="container">
    <?php $this->load->view('layouts/_alert')?>
<div class="col-md-10 mx-auto">
  <div class="card">
  <div class="card-header mb-3">
    <span>Pengguna</span>
    <a href="/admin-user-form.html" class="btn btn-sm btn-secondary">Tambah</a>
    <div class="float-right">
        <form action="">
            <div class="input-group">
             <input type="text" class="form-control form-control-sm text-center" placeholder="Cari">
             <div class="form-input-append">
                 <button class="btn btn-secondary btn-sm" type="submit">
                     <i class="fas fa-search"></i>
                 </button>
                 <a href="#" class="btn btn-secondary btn-sm">
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
           <th scope="col">Pengguna</th>
           <th scope="col">E-mail</th>
           <th scope="col">Role</th>
           <th scope="col">Status</th>
           <th scope="col"></th>
       </thead>
       <tbody>
           <?php  $no= 0; foreach($content as $row) : $no++; ?>
           <tr>
               <td><?= $no ?></td>
               <td>
                   <p>
                       <img src="<?= $row->image ? base_url("images/user/$row->image"): base_url("images/user/avatar.png")   ?>" alt="" height="50">
                       <?= $row->name; ?>
                   </p>
               </td>
               <td><?= $row->email ?></td>
               <td><?=$row->role; ?></td>
               <td><?= $row->is_active ? 'Active' : 'Nonactive' ?></td>
               <td>
                  <form action="">
                      <a href="#">
                          <button class="btn btn-sm">
                              <i class="fas fa-edit text-info"></i>
                          </button>
                          <button class="btn btn-sm" type="submit"  onclick ="return confirm('Are you sure ?')">
                              <i class="fas fa-trash text-danger"></i>
                          </button>
                      </a>
                  </form>
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