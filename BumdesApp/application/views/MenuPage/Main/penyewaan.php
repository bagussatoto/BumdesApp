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
            <h1>Penyewaan aset perusahaan </h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-7">
                  <a href="unduh-daftar-sewa?tahun=<?=$tahun?>&bulan=<?=$bulan?>"class="btn btn-md btn-warning" target="_blank">Unduh laporan penyewaan</a>
                  <a href="add-schedule" class="btn btn-md btn-info">Tambah jadwal sewa</a>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5">
                  <div class="row">
                    <form id="sewa-aset" action="rentalling" method="GET" class="form-filter">
                      <div class="col-md-4 col-sm-4 col-xs-4">  
                        <div class="form-group">
                            <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#sewa-aset').submit()">
                            <?php 
                              foreach ($thn as $key => $val) {
                                $key==$tahun?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="">Bulan</label>
                          <select name="bulan" class="form-control" onchange="$('#sewa-aset').submit()">
                              <?php 
                              foreach ($bln as $key => $val) {
                                $key==$bulan?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$key.'">'.$val.'</option>';
                              }
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-4">
                          <div class="form-group">
                            <label for="">Tampilkan</label>
                            <select name="limit" class="form-control" onchange="$('#sewa-aset').submit()" id="limit">
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
          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Jumlah penyewaan</span>
              <div class="count text-center" id="jpn"><?= $v?$v->tp:0 ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total pendapatan sewa</span>
              <div class="count text-center" id="tps">Rp. <?= $v2?$v2->tps:0 ?></div>
            </div>
          </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h3>Informasi jadwal sewa</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Aset</th>
                    <th>Waktu mulai</th>
                    <th>Waktu selesai</th>
                    <th>Penyewa</th>
                    <th>Nominal</th>
                    <th>Ekstra</th>
                  </tr>
                </thead>

                <tbody id="val-body" data-act="hapus-penyewaan" data-meth="POST">
                  <?= $value['val'] ?>
                </tbody>
              </table>
            </div>
            <div class="pgn-cust">
              <?= $value['paginasi'] ?>
            </div>
            <h6>Cat: Setelah 10 hari, penyewaan hanya bisa dibatalkan</h6>
          </div>
        </div>
          
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-9">
                    <h3>Pertumbuhan penyewaan aset <small>tahun 2019</small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_penyewaan"></div>
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
      penyewaan(JSON.parse('<?= $v_grafik ?>'),'#grafik_penyewaan', '<?= $tahun ?>')
    </script>
  </body>
</html>