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
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url('asset') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?= base_url('asset') ?>/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= site_url('home') ?>" class="site_title"><i class="fa fa-paw"></i> <span>Bumdes kalipuru</span></a>
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
        
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h1>Komoditas usaha</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-12">
                  <a href="unduh-daftar-komoditas"class="btn btn-md btn-warning" target="_blank">Unduh daftar komoditas</a>
                  <a href="add-commodites" class="btn btn-md btn-primary">Tambah komoditas</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h3>Informasi komoditas</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Komoditas</th>
                      <th>Stok</th>
                      <th>Harga jual</th>
                      <th>Harga beli</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody data-act="hapus-komoditas" data-meth="POST">
                      <?= $value ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
          <br>
        <div class="col-md-8 col-sm-8 col-xs-8">
          <div class="x_panel">
            <div class="x_title">
              <h4>Satuan produk dagang</h4>
            </div>
            <div class="x_content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Satuan</th>
                    <th>keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                  <tbody data-act="hapus-satuan" data-meth="POST" id="satuan">
                  <?= $sat ?>
                  </tbody>
              </table>
              <button class="btn btn-xs btn-primary" id="tambah-satuan">Tambah satuan</button>
            </div>
          </div>
        </div>
          <div class="row">
            <!-- Tambah satuan -->
            <div class="col-md-4 col-sm-4 col-xs-4 cls-but" style="display:none;" id="form-tambah-sat">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Tambah satuan</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <form id="set-tambah-satuan" action="tambah-satuan" method="POST" class="form-horizontal form-label-left"><br>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Satuan</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" required class="form-control" name="sat">
                      </div>
                    </div><br>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Keterangan</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" required class="form-control" name="ket_sat">
                      </div>
                    </div><br>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-xs btn-primary">Simpan</button>
                        <button onclick="$(this).closest('.cls-but').hide()" type="button" class="btn btn-xs btn-danger">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Edit satuan -->
            <div class="col-md-4 col-sm-4 col-xs-4 cls-but" style="display:none;" id="form-edit-sat">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Ubah satuan</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <form id="edit-satuan" action="edit-satuan" method="POST" class="form-horizontal form-label-left"><br>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Satuan</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" required class="form-control" name="sat" id="edit_sat">
                        <input type="hidden" name="id" id="id_sat">
                      </div>
                    </div><br>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Keterangan</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" class="form-control" name="ket" id="edit_ket">
                      </div>
                    </div><br>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-xs btn-primary">Simpan</button>
                        <button onclick="$(this).closest('.cls-but').hide()" type="button" class="btn btn-xs btn-danger">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <br>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="border-top: 1px solid #d9dee4;">
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php $this->load->view('SuptPage/JsP') ?>
    
    <script src="<?= base_url('asset') ?>/JS/Highchart.js"></script>
    <script src="<?= base_url('asset/JS/Form_hapus.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Fitur.js') ?>"></script>
    <script src="<?= base_url('asset') ?>/JS/Ajax_req.js"></script>

  </body>
</html>