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
                    <h1>Tambah barang keluar/distribusi</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="set-barang-keluar" id="set-barang-keluar" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Komoditas</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <select class="form-control" name="komoditas" id="komoditas" required>
                          <option value="">Pilih komoditas</option>
                          <?php foreach ($v as $key => $s) {
                            echo '<option data-s2="'.$s->st2.'" data-sk="'.$s->stk.'" data-s="'.$s->st.'" value="'.$s->id.'">'.$s->kom.'</option>';
                          } ?>
                        </select>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Jumlah</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input autocomplete="off" type="text" required class="form-control empty-form float-nums" id="jumlah" name="jumlah">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly id="stok" class="form-control empty-form">
                          <span><label>Stok saat ini</label></span>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input readonly type="text" class="form-control empty-form" id="satuan" name="n_sat">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3" style="display: none;" id="ov-val">
                          <small class="label label-danger">Input melebihi stok</small>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Tujuan</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input class="tujuan" checked type="radio" name="tujuan" id="primary" value="Distribusi">
                          <label>Distribusi</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input class="tujuan" type="radio" name="tujuan" value="Non-distribusi">
                          <label>Non-Distribusi</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tujuan distribusi</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <select name="mitra" class="form-control enab-input" id="mitra" required>
                          <option value="">Pilih rekanan</option>
                          <?php foreach ($v2 as $key => $s2) {
                            echo '<option value="'.$s2->id.'">'.$s2->nr.'</option>';
                          } ?>
                          </select>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Nilai</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" class="form-control empty-form" name="nilai" id="tang_mul" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                          <span><input checked type="checkbox" name="tambah_trans" value="Ya"> <label>Catat ke keuangan</label></span>
                          <small class="label label-info">Opsional</small>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class='input-group date  tanggal_form tanggal_new'>
                              <input  type='text' class="form-control" readonly="readonly"  id="edit_tanggal" name="tanggal" value="<?= date('d-m-Y') ?>" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Catatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <textarea class="form-control empty-form" name="cat" id="" cols="30" rows="10" style="resize:none;"></textarea>
                          <small class="label label-info">Opsional</small>
                        </div>
                      </div> <br>
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-md btn-primary">Kirim</button>
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
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Fitur.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Dtmpicker.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>