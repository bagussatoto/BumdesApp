<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url(); ?>favicon.ico" type="image/gif">
    <title><?= $title?></title>

    <!-- Bootstrap -->
    <link href="<?=base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url(); ?>asset/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url(); ?>asset/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login" style="color:black;">
    <div>
      <div class="login_wrapper">
        <div class=" form login_form">
          <section class="login_content">
            <form id="login-system" method="POST" action="masuk" >
            <h1><img src="<?=base_url(); ?>logo2.png"style="max-width:100px;max-height:100px;"> BUMDes</h1>
              
              <div>
                <input title="Masukkan email" type="text" class="form-control" placeholder="Email" required name="email" />
              </div>
              <div>
                <input title="Masukkan password" type="password" class="form-control" placeholder="Password" required name="password" />
              </div>
              <span id="failed-login" style="display: none;">
                <div style="color: red;">
                  Kombinasi email dan password tidak terdaftar
                </div><br>
              </span>
              <div>
                <button class="btn btn-default submit" id="login-conf-but" type="submit" disabled>Masuk</button>
              </div>
              <div class="separator">
                <p class="change_link">Lupa password
                  <a href="lupa-password" class="to_register"> Klik di sini </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> BUMDes Indrakila Jaya</h1>
                  <!-- <p>©2019 All Rights Reserved. Dashboard design By Gentelella & Colorlib, system by TA Informatika UII 2020</p> -->
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <?php $this->load->view('SuptPage/JsP') ?>
  </body>
</html>
