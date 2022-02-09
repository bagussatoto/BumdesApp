<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title><?= $title?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>asset/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login" style="color:black;">
    <div class="container body">
      <div class="login_content">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h1><img src="<?php echo base_url(); ?>logo2.png"style="max-width:100px;max-height:100px;"> BUMDes Indrakila Jaya</h1>
        </div>
      </div>
      <div class="main_container text-center">
        <h1>Email berhasil diubah</h1>
        <br>
        <br>
        <a href="<?= base_url() ?>" class="btn btn-md btn-primary">Masuk kembali</a>
      </div>
    </div>
  </body>
</html>
