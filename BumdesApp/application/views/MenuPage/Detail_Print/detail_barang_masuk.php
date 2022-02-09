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
                <img src="https://1.bp.blogspot.com/-kuf6W_Yxf5E/WFqXlaCcAeI/AAAAAAAAIL0/V9UhNuz6MhMJciRalykCPaaPp6QCaPjYwCLcB/s1600/Arnold-Schwarzenegger-n-aime-pas-son-corps.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
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
                  <h1>Detail barang masuk</h1>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="col-md-12 col-sm-12 col-xs-12">
                      <tr>
                          <td class="col-md-2 col-sm-2 col-xs-2"><h4>Nama barang :</h4></td>
                          <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->nk)?$v->nk:'-' ?></h3></td>
                          <td class="col-md-2 col-sm-2 col-xs-2"><h4>Tanggal :</h4></td>
                          <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->nk)?date('d/m/Y',strtotime($v->tg)):'-' ?></h3></td>
                      </tr>
                      <tr>
                          <td class="col-md-2 col-sm-2 col-xs-2"><h4>Jumlah :</h4></td>
                          <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->nk)?$v->jl.' '.$v->st:'-' ?></h3></td>
                          <td class="col-md-2 col-sm-2 col-xs-2"><h4>Jenis :</h4></td>
                          <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->al)?$v->al:'-' ?></h3></td>
                      </tr>
                      <tr>
                          <td class="col-md-2 col-sm-2 col-xs-2"><h4>Harga :</h4></td>
                          <td class="col-md-4 col-sm-4 col-xs-4"><h3>Rp. <?= isset($v->nl)?$v->nl:'-' ?></h3></td>
                      </tr>
                      <tr>
                          <td class="col-md-2 col-sm-2 col-xs-2"><h4>Catatan :</h4></td>
                          <td style="padding-top: 20px;" colspan="3" class="col-md-4 col-sm-4 col-xs-4"><p><?= isset($v->ct)?$v->ct:'-' ?></p></td>
                      </tr>
                  </table>
                  <hr class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                    <a href="<?= site_url('pdf-detail-komoditas-in/'.$id) ?>"class="btn btn-md btn-primary" target="_blank">Unduh bentuk PDF</a>
                  </div> -->
                </div>
              </div>
            </div>
            <br>
            <br>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h1>Histori barang masuk</h1>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    
                  </div>
                <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <td><strong>No</strong></td>
                              <td><strong>Tanggal</strong></td>
                              <td><strong>Sumber</strong></td>
                              <td><strong>Jumlah</strong></td>
                              <td><strong>Stok</strong></td>
                              <td><strong>Nilai</strong></td>
                          </tr>
                      </thead>
                      <tbody>
                          <?= $v_masuk_tabel ?>
                      </tbody>
                  </table>
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
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>