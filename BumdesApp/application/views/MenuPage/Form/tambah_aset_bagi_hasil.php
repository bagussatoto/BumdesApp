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
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h1>Tambah kerjasama bagi hasil aset</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form action="set-bagi-hasil" id="set-bagi-hasil" method="POST" class="form-horizontal form-label-left" data-cek="cek-jadwal-bgh" data-tp="new">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="mitra">Mitra</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <select class="form-control" name="mitra" id="mitra" required>
                      <option value="">Pilih mitra</option>
                      <?php foreach ($v2 as $key => $s2) {
                        echo '<option value="'.$s2->id.'">'.$s2->nr.'</option>';
                      } ?>
                    </select>
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Sumber aset</label>
                  <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                    <input checked type="radio" name="sumber" value="Internal" class="s-aset" id="primary">
                    <label>Aset Internal</label>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="radio" name="sumber" value="Eksternal" class="s-aset">
                    <label>Aset luar</label>
                  </div>
                </div> <br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3">Aset</label>
                  <div class="col-md-6 col-sm-6 col-xs-6" id="internal">
                    <select class="form-control" name="aset" id="inter_aset" required>
                      <option value="">Pilih aset</option>
                      <?php foreach ($v3 as $key => $s2) {
                        echo '<option value="'.$s2->id.'">'.$s2->nm.'</option>';
                      } ?>
                    </select>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6" id="external" style="display:none;">
                    <input disabled required type="text" class="form-control" name="aset" placeholder="Masukkan aset">
                  </div>
                </div> <br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Pembagian bagi hasil (%)</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input max="100" autocomplete="off" required type="number" id="pers-bumdes" name="pers_bumdes" class="form-control rem-panah" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    <span><label>BUMDes</label></span>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" id="pers-mitra" name="pers_mitra" readonly class="form-control" value="0">
                    <span><label>Mitra</label></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Tanggal mulai / lama kerja sama</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class='input-group date  tanggal_form tanggal_new' id="tanggal-bgh">
                        <input  type='text' class="form-control" readonly="readonly" name="tanggal" value="<?= date('d-m-Y') ?>" />
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <input type="number" min="12" required class="form-control" name="bulan" value="12" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" id="jum_bulan" max="100">
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-1">
                    <input readonly class="form-control" value="Bulan">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3" id="warning" style="display: none;">
                    <small class="label label-danger">Ada tabrakan jadwal bagi hasil</small>
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
    <script src="<?= base_url('asset/JS/Dtmpicker.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>