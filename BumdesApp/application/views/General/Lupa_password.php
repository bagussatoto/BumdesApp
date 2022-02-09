<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>favicon.ico" type="image/gif">
    <title><?= $title?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url(); ?>asset/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>asset/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login" style="color:black;">
    <div>
      <div class="login_wrapper">
        <div class=" form login_form">
          <section class="login_content">
            <form method="POST" action="req-password" >
            <h1><img src="<?= base_url(); ?>logo2.png"style="max-width:100px;max-height:100px;"> BUMDes</h1>
              
              <div>
                <input type="text" class="form-control" placeholder="Email" required name="email" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Kirim</button>
              </div>
              <div class="separator">
                <p class="change_link">Ke halaman masuk
                  <a href="<?= base_url(); ?>" class="to_register"> Klik di sini </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> BUMDes Indrakila Jaya</h1>
                  <p>©2019 All Rights Reserved. Dashboard design By Gentelella & Colorlib, system by TA Informatika UII 2015</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <style>
        h1:after, h1:before{
            content:none;
        }
    </style>
  </body>
</html>
