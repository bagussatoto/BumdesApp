<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bumdes kalipuru | <?= $title ?></title>

    <?php $this->load->view('SuptPage/CssP') ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url() ?>" class="site_title"><i class="fa fa-paw"></i> <span>Bumdes kalipuru</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?= isset($this->ses->img)?base_url('media/admin/'.$this->ses->img):base_url('media/admin/unnamed.png') ?>" alt="foto-admin" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $this->ses->nm ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php $this->load->view('SuptPage/'.$page) ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php $this->load->view('SuptPage/FooterButton') ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view('SuptPage/Notifikasi') ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="color: black;">
          <div class="col-md-12">
              <button class="btn btn-md btn-warning" onclick="window.location.href=document.referrer">Batal | Kembali</button>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Ubah Informasi Admin</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-profil') ?>" id="edit-profil" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" required class="form-control" name="nama" value="<?= isset($v->nm)?$v->nm:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group"><!-- ============================================================== -->
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Foto</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input class="form-control" type="file" name="foto" id="img-form">
                          <span><input name="del_fot" <?= !isset($v->img)?'disabled':null ?> value="<?= isset($v->img)?$v->img:null ?>" id="del-fot" type="checkbox"><label>Hapus foto | </label></span>
                          <span>Ukuran maksimal 5 Mb</span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <img id="image-asset" style="padding: 1px; border: 1px solid black;" src="<?= isset($v->img)?base_url('media/admin/'.$v->img):base_url('media/admin/unnamed.png') ?>" alt="" width="230" height="140" data-iv="<?= $v?$v->img:null ?>">
                          <input type="hidden" id="hid-img" name="img_val" value="<?= isset($v->img)?$v->img:null ?>">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <span id="warning-size" style="display: none;">
                            <small class="label label-warning">Ukuran file tidak sesuai</small>
                          </span><br>
                          <span id="warning-type" style="display: none;">
                            <small class="label label-warning">Tipe file tidak sesuai</small>
                          </span>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email/kontak</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="text" onkeypress="return (event.charCode !=32)" required class="form-control" name="email" value="<?= isset($v->em)?$v->em:'-' ?>" id="cek-email" data-old="<?= isset($v->em)?$v->em:'-' ?>">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="text" required class="form-control" name="kontak" value="<?= isset($v->kt)?$v->kt:'-' ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Konfirmasi password</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input required type="password" required class="form-control" name="password">
                        </div>
                      </div> <br>
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    

    <?php $this->load->view('SuptPage/JsP') ?>
    <script src="<?= base_url('asset/JS/Fitur.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
  </body>
</html>