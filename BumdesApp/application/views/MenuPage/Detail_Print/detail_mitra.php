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
                <button class="btn btn-md btn-warning" onclick="window.location.href=document.referrer"> Kembali</button>
            </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h1>Detail informasi rekanan</h1>
                <!-- <h1>Detail bagi hasil aset</h1> -->
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="col-md-12 col-sm-12 col-xs-12">
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Nama rekanan :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= $v?$v->nm:'-' ?></h3></td>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Penanggung jawab :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= $v?$v->pj:'-' ?></h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Kontak :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= $v?$v->k1:'-' ?>/<?= $v?$v->k2:'-' ?></h3></td>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Alamat :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= $v?$v->addr:'-' ?></h3></td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
        <br>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h3>Daftar kerjasama bagi hasil dengan mitra</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td><strong>No</strong></td>
                            <td><strong>Aset</strong></td>
                            <td><strong>Rentang waktu kerjasama</strong></td>
                            <td><strong>Pers BUMDes</strong></td>
                            <td><strong>Pers Mitra</strong></td>
                            <td><strong>Total nilai bagi hasil</strong></td>
                            <td><strong>Status</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                      <?= $vbgh ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <br>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h3>Daftar distribusi ke mitra</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">

                    </div>
                  <div class="col-md-8 col-sm-8 col-xs-8">
                    <div class="row">
                        <form action="" class="form-filter" method="GET" id="detail-dist-mitra">
                          <div class="col-md-4 col-sm-4 col-xs-4">  
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <select name="tahun" class="form-control" onchange="$('#detail-dist-mitra').submit()">
                                  <?php 
                                    foreach ($thn as $key => $val) {
                                      $val->thn==$y?$sel='selected':$sel=null;
                                      echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                                    }
                                  ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                              <label for="">Bulan</label>
                              <select name="bulan" class="form-control" onchange="$('#detail-dist-mitra').submit()">
                              <?php 
                                foreach ($bln as $key => $val) {
                                  $key==$m?$sel='selected':$sel=null;
                                  echo '<option '.$sel.' value="'.$key.'">'.$val.'</option>';
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4">
                              <div class="form-group">
                                <label for="">Tampilkan</label>
                                <select name="limit" class="form-control" onchange="$('#detail-dist-mitra').submit()" id="limit">
                                  <?php 
                                  foreach ($form_lim as $key => $val) {
                                    $val==$lim?$sel='selected':$sel=null;
                                    echo '<option '.$sel.' value="'.$val.'">'.$val.'</option>';
                                  }
                                  ?>
                                </select>
                              </div>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <td><strong>No</strong></td>
                          <td><strong>Komoditas</strong></td>
                          <td><strong>Jumlah</strong></td>
                          <td><strong>Harga</strong></td>
                          <td><strong>Tanggal</strong></td>
                          <td><strong>Ekstra</strong></td>
                      </tr>
                  </thead>
                  <tbody id="val-body">
                    <?= $value['val'] ?>
                  </tbody>
                </table>
            </div>
                  <div class="pgn-cust">
                    <?= $value['paginasi'] ?>
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
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
  </body>
</html>