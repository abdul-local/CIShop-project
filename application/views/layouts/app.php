<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title><?= isset($title) ? $title : 'CIShop'?> - Codeigneter E-Comerce</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
<link href="<?php echo base_url('assets/libs/bootstrap-4.5.2-dist/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">
    <!-- untuk css -->
    

    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">
    <!-- css fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/fontawsome/css/all.min.css'); ?>">
  </head>
  <body>
  <!-- Navbar -->
<?php $this->load->view('layouts/_navbar'); ?>
  <!-- endNavbra-->
  <!-- Content -->
<?php $this->load->view($page); ?>
  <!-- endContent -->

<script src="<?php  echo base_url('assets/libs/jquery/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-4.5.2-dist/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
