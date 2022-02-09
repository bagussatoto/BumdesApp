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
      <div class="main_container">
        <form method="POST" class="form-horizontal form-label-left tex-center" id="ganti-password">
            <div class="form-group text-center">
                <h2>Ubah <i>password</i></h2>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama / Email</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" readonly class="form-control" value="<?= $v[0] ?>">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" readonly class="form-control" value="<?= $v[1] ?>" >
                </div>
            </div> <br>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3">Kata sandi</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="password" required class="form-control" placeholder="Masukkan kata sandi anda" name="password" autocomplete="off" id="sandi1">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="password" required class="form-control" placeholder="Konfirmasi kata sandi anda" name="password2" autocomplete="off" id="sandi2">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <span id="warning1" style="display: none;">
                        <small class="label label-danger">Minimal 8 karakter</small>
                    </span><br>
                    <span id="warning2" style="display: none;">
                        <small class="label label-danger">Kata sandi tidak sama</small>
                    </span>
                </div>
            </div> <br>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <button type="submit" class="btn btn-md btn-primary">Kirim</button>
            </div>
        </form>
      </div>
    </div>
    <?php $this->load->view('SuptPage/JsP') ?>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
  </body>
</html>
