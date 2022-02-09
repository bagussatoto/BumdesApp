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
    <link href="<?= base_url('asset/') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?= base_url('asset/') ?>/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
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
        <div class="row tile_count">
            <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
              <span class="count_top"><h4><i class="fa fa-user"></i> Saldo</h4></span>
              <div class="count text-center" id="saldo">Rp. <?= isset($s[0])? $s[0]->ac:0 ?></div>
            </div>
          </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h1>Laporan keuangan tahunan BUMDes</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <!-- <button class="btn btn-md btn-warning">Unduh laporan keuangan</button> -->
                  <a href="unduh-keuangan-tahunan?tahun=<?=$tahun?>"class="btn btn-md btn-warning" target="_blank">Unduh laporan keuangan</a>
                  <a href="add-finr" class="btn btn-md btn-info">Input data keuangan</a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="row">
                    <form id="laporan-keuangan" action="annual-freport" method="GET" class="form-filter">
                      <div class="col-md-6 col-sm-6 col-xs-6">  
                        <div class="form-group">
                          <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#laporan-keuangan').submit()">
                              <option value="--">Pilih tahun</option>
                            <?php 
                              foreach ($thn as $key => $val) {
                                $val->thn==$tahun?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="form-group">
                            <label for="">Tampilkan</label>
                            <select name="limit" class="form-control" onchange="$('#laporan-keuangan').submit()" id="limit">
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
            </div>
          </div>
        </div>
        <br>
        <br>
          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Debit</span>
              <div class="count text-center" id="debit">Rp. <?= isset($kd[0])? $kd[0]->dbt:0 ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Kredit</span>
              <div class="count text-center" id="kredit">Rp. <?= isset($kd[0])? $kd[0]->kdt:0 ?></div>
            </div>
          </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h3>Informasi keuangan</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody id="val-body" data-act="hapus-keuangan/thn" data-meth="POST">
                  <?= $value['val'] ?>
                </tbody>
              </table>
            </div>
            <div class="pgn-cust">
              <?= $value['paginasi'] ?>
            </div>
          </div>
        </div>
          
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-9">
                    <h3>Grafik keuangan</h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div id="grafik_keuangan_tahunan"></div>
                </div>
                <div class="clearfix"></div>
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
    
    <!--Javascript tambahan -->
    <script src="<?= base_url('asset') ?>/JS/Fitur.js"></script>
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
    <script type="text/javascript">
      keuangan_tahunan(JSON.parse('<?= $v_grafik ?>'),'#grafik_keuangan_tahunan')
    </script>
  </body>
</html>