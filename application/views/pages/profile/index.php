
<main role="main" class="container">
<div class="row">
   <?php $this->load->view('layouts/_menu') ?>
    <div class="col-md-9">
       <div class="row">
           <div class="col-md-4">
               <div class="card-body text-center">
                   <img src="<?= $content->image ? base_url("/images/user/$content->image"): base_url("/images/user/avatar.png")?>" alt="" height="150">
               </div>
           </div>
           <div class="col-md-8">
               <div class="card">
                   <div class="card-body">
                       <p>Nama: <?= $content->name ?></p>
                       <p>Alamat Email: <?= $content->email ?></p>
                       <a href="<?= base_url("index.php/profile/update/$content->id")?>" class="btn btn-primary">Edit</a>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
</main>