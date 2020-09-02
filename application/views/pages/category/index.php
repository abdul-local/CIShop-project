<main role="main" class="container">
    <?php $this->load->view('layouts/_alert') ?>
<div class="col-md-10 mx-auto">
  <div class="card">
  <div class="card-header mb-3">
    <span>Kategori</span>
    <a href="<?= base_url('index.php/category/create'); ?>" class="btn btn-sm btn-secondary">Tambah</a>
    <div class="float-right">
        <form action="">
            <div class="input-group">
             <input type="text" class="form-control form-control-sm text-center" placeholder="Cari">
             <div class="form-input-append">
                 <button class="btn btn-info btn-sm" type="submit">
                     <i class="fas fa-search"></i>
                 </button>
                 <a href="#" class="btn btn-info btn-sm">
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
           <th scope="col">No</th>
           <th scope="col">Title</th>
           <th scope="col">Slug</th>
           <th scope="col"></th>
       </thead>
       <tbody>
       <?php $no= 0; foreach($content as $row)  : $no++;?>
           <tr>
               <td><?= $no ?></td>
               <td><?= $row->title?></td>
               <td><?= $row->slug ?></td>
               <td>
                      <a href="<?= base_url("index.php/category/edit/$row->id") ?>">
                          <button class="btn btn-sm">
                              <i class="fas fa-edit text-info"></i>
                          </button>
                          <button class="btn btn-sm" type="submit"  onclick ="return confirm('Are you sure ?')">
                              <i class="fas fa-trash text-danger"></i>
                          </button>
                      </a>
               </td>
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