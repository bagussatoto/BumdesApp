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
            <?php $this->load->view('SuptPage/MenuPageGov') ?>
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
        <div class="right_col" role="main" style="color:black;">
          <div class="x_panel">
            <div class="x_title">
            <h1>Informasi kegiatan dagang BUMDes</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-5">
                </div>
                <div class="col-md-7 col-sm-7 col-xs-7">
                  <div class="row">
                    <form id="gov-penjualan" action="gov-penjualan" method="GET">
                      <div class="col-md-6 col-sm-6">  
                        <div class="form-group">
                          <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#gov-penjualan').submit()">
                            <?php 
                              foreach ($thn as $key => $val) {
                                $key==$y?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="">Bulan</label>
                          <select name="bulan" class="form-control" onchange="$('#gov-penjualan').submit()">
                            <?php 
                            foreach ($bln as $key => $val) {
                              $key==$m?$sel='selected':$sel=null;
                              echo '<option '.$sel.' value="'.$key.'">'.$val.'</option>';
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
          <div class="row tile_count">
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Jumlah distribusi</span>
              <div class="count" id="jdb"><?= $dst?''.$dst->cnt:'0' ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Nilai distribusi</span>
              <div class="count" id="ndb">Rp. <?= $dst?''.$dst->jlh:'0' ?></div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Jumlah non-dsitribusi</span>
              <div class="count" id="jndb"><?= $ndt?''.$ndt->cnt:'0' ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Nilai non-distribusi</span>
              <div class="count" id="nndb">Rp. <?= $ndt?''.$ndt->jlh:'0' ?></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan laba dagang <small class="g-time">Tahun 2020</small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik-laba-dagang"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan dagang distribusi <small class="g-time">Tahun 2020</small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik-distribusi"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan dagang non-distribusi <small class="g-time">Tahun 2020</small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik-non-distribusi"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          
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
    <script src="<?= base_url('asset') ?>/JS/Ajax_req_gov.js"></script>
    
    <script type="text/javascript">
      pertumbuhan_perdagangan_bulan(JSON.parse('<?= $v_grafik ?>'),'#grafik-laba-dagang', "<?= $y ?>")
      distribusi(JSON.parse('<?= $v_grafik2 ?>'),'#grafik-distribusi', "<?= $y ?>")
      non_distribusi(JSON.parse('<?= $v_grafik3 ?>'),'#grafik-non-distribusi', "<?= $y ?>")
    </script>
  </body>
</html>