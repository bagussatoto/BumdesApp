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
            <?php $this->load->view('SuptPage/MenuPage') ?>
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
                    <h1>Ubah informasi barang</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-komoditas-dagang') ?>" id="edit-komoditas-dagang" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input type="text" class="form-control" name="nama" value="<?= isset($v->kom)?$v->kom:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly class="form-control" name="id" value="<?= isset($v->id)?$v->id:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Harga beli</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input type="text" required class="form-control" name="har_beli" value="<?= isset($v->hb)?$v->hb:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input readonly type="text" class="form-control" value="Rp. <?= isset($v->hs)?$v->hs:'-' ?>">
                          <span><label>Harga perkiraan</label></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Harga jual</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input type="text" required class="form-control" name="har_jual" value="<?= isset($v->hj)?$v->hj:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Satuan</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <select <?= isset($v->id)?null:'disabled' ?> class="form-control" name="sat" required>
                            <option value="">Pilih satuan</option>
                          <?php 
                            foreach ($v2 as $key => $vl) {
                              $vl->id==$v->st?$sel='selected':$sel=null;
                              echo '<option '.$sel.' value="'.$vl->id.'">'.$vl->st.'</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div> <br>
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button <?= isset($v->id)?null:'disabled' ?> type="submit" class="btn btn-md btn-primary">Kirim</button>
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
  </body>
</html>