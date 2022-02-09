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
          <div class="row tile_count">
            <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Saldo saat ini</span>
              <div class="count text-center" id="saldo">Rp. <?= isset($blc[0]->ac)?$blc[0]->ac:'0' ?></div>
            </div>
          </div>
        
          <div class="x_panel">
            <div class="x_title">
            <h1>Informasi keuangan BUMDes</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <form id="gov-fin" action="gov-finansial" method="GET">
                      <div class="col-md-4 col-sm-4 col-xs-4">  
                        <div class="form-group">
                          <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#gov-fin').submit()">
                            <?php 
                              foreach ($thn as $key => $val) {
                                $key==$y?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                          <label for="">Bulan</label>
                          <select name="bulan" class="form-control" onchange="$('#gov-fin').submit()">
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
                          <label for="">Minggu</label>
                          <select name="minggu" class="form-control" onchange="$('#gov-fin').submit()">
                          <?php 
                              foreach ([1,2,3,4] as $key => $v) {
                                $v==$w?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$v.'">'.$v.'</option>';
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
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Debit minggu ini</span>
              <div class="count text-center" id="dbw">Rp. <?= isset($dkw[0]->dbt)?$dkw[0]->dbt:'0' ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Kredit minggu ini</span>
              <div class="count text-center" id="kdw">Rp. <?= isset($dkw[0]->kdt)?$dkw[0]->kdt:'0' ?></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Keuangan Mingguan BUMDes <small id="ig_w"><?= $nam_bulan ?> <?= $y ?></small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_keuangan_mingguan"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Debit bulan ini</span>
              <div class="count text-center" id="dbm">Rp. <?= isset($dkm[0]->dbt)?$dkm[0]->dbt:'0' ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Kredit bulan ini</span>
              <div class="count text-center" id="kdm">Rp. <?= isset($dkm[0]->kdt)?$dkm[0]->kdt:'0' ?></div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Keuangan Bulanan BUMDes <small id="ig_m">Tahun <?= $y ?></small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_keuangan_bulanan"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Debit tahun ini</span>
              <div class="count text-center" id="dby">Rp. <?= isset($dky[0]->dbt)?$dky[0]->dbt:'0' ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Kredit tahun ini</span>
              <div class="count text-center" id="kdy">Rp. <?= isset($dky[0]->kdt)?$dky[0]->kdt:'0' ?></div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Keuangan Tahunan BUMDes</h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_keuangan_tahunan"></div>
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
      keuangan_mingguan(JSON.parse('<?= $gf_w ?>'),'#grafik_keuangan_mingguan', '<?= $nam_bulan ?>', '<?= $y ?>')
      keuangan_bulanan(JSON.parse('<?= $gf_m ?>'),'#grafik_keuangan_bulanan', '<?= $y ?>')
      keuangan_tahunan(JSON.parse('<?= $gf_y ?>'),'#grafik_keuangan_tahunan')
    </script>
  </body>
</html>