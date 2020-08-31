
<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
<div class="col-md-8 mx-auto">
  <div class="card">
  <div class="card-header">
    Register
  </div>
  <div class="card-body">
   <!-- <form action=""> -->
   <?= form_open('register',['method'=>'POST']); ?>
       <div class="form-group">
           <label>Nama</label>
           <?= form_input('name', $input->name, ['class'=>'form-control','placeholder'=>'inputkan Nama Anda','required'=>true, 'autofocus'=>true]); ?>
           <?= form_error('name'); ?>
       </div>
       <div class="form-group">
           <label>E-Mail</label>
           <?= form_input(['name'=>'email','type'=>'email'],$input->email, ['class'=>'form-control', 'placeholder'=>'inpukan alamat email yang benar','required'=>true]); ?>
           <?= form_error('email'); ?>
       </div>
       <div class="form-group">
           <label>Password</label>
           <?= form_password('password','', ['class'=>'form-control', 'placeholder'=>'inpukan password minimal 8 karakter','required'=>true]); ?>
           <?= form_error('password'); ?>

       </div>
       <div class="form-group">
           <label>Konfirmasi Pasword</label>
           <?= form_password('password_confirmation','', ['class'=>'form-control', 'placeholder'=>'inputkan password yang sama dengan sebelumnya','required'=>true]); ?>

           <?= form_error('password_confirmation'); ?>
       </div>
       <button type="submit" class="btn btn-primary">Regiter</button>
   <?= form_close(); ?>
  </div>
</div>  
</div>
</main>