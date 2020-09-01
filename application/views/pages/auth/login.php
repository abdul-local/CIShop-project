
<main role="main" class="container">
<?php $this->load->view('layouts/_alert'); ?>
<div class="col-md-8 mx-auto">
  <div class="card">
  <div class="card-header">
   Form Login
  </div>
  <div class="card-body">

       <?= form_open('login',['method'=>'POST']) ?>
       <div class="form-group">
       <div class="form-group">
           <label>E-Mail</label>
           <?= form_input(['name'=>'email','type'=>'email'],$input->email, ['class'=>'form-control', 'placeholder'=>'inpukan alamat ','required'=>true]); ?>
           <?= form_error('email'); ?>
       </div>
       <div class="form-group">
           <label>Password</label>
           <?= form_password('password','', ['class'=>'form-control', 'placeholder'=>'inpukan password ','required'=>true]); ?>
           <?= form_error('password'); ?>
        </div>
       <button type="submit" class="btn btn-primary">Login</button>
   <?= form_close() ?>
  </div>
</div>  
</div>
 
</main>


