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
            <h1>Informasi kerjasama bagi hasil BUMDes</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-7">
                </div>
                <div class="col-md-5">
                  <div class="row">
                    <form id="gov-kbgh" action="gov-kerjasama-bgh" method="GET">
                      <div class="col-md-6 col-sm-6">  
                        <div class="form-group">
                          <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#gov-kbgh').submit()">
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
                          <select name="bulan" class="form-control" onchange="$('#gov-kbgh').submit()">
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
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> <span id="k-pbgh-m">Penerimaan BUMDes bagi hasil <?= $nb ?> <?= $y ?></span></span>
              <div class="count text-center" id="pbgh-m">Rp. <?= isset($pbm->pnb)?''.$pbm->pnb:'0' ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> <span id="k-pbgh-y">Penerimaan BUMDes bagi hasil tahun <?= $y ?></span></span>
              <div class="count text-center" id="pbgh-y">Rp. <?= isset($pby->pnb)?''.$pby->pnb:'0' ?></div>
            </div>
          </div>
          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> <span id="k-nbgh-m">Nilai bagi hasil <?= $nb ?> <?= $y ?></span></span>
              <div class="count text-center" id="nbgh-m">Rp. <?= isset($pbm->hg)?''.$pbm->hg:'0' ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> <span id="k-nbgh-y">Nilai bagi hasil tahun <?= $y ?></span></span>
              <div class="count text-center" id="nbgh-y">Rp. <?= isset($pby->hg)?''.$pby->hg:'0' ?></div>
            </div>
          </div>
          <div class="row tile_count">
            <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset internal <?= $nb ?> <?= $y ?></span>
              <div class="count" id="int-m"><?= $vt?''.$vt->jints:'0' ?></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset eksternal <?= $nb ?> <?= $y ?></span>
              <div class="count" id="ext-m"><?= $vt?''.$vt->exts:'0' ?></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset internal tahun <?= $y ?></span>
              <div class="count" id="int-y"><?= $va?''.$va->jints:'0' ?></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset eksternal tahun <?= $y ?></span>
              <div class="count" id="ext-y"><?= $va?''.$va->exts:'0' ?></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan penerimaan bagi hasil <small id="g-tahun">Tahun <?= $y ?></small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_bagi_hasil"></div>
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
      bagi_hasil(JSON.parse('<?= $v_grafik ?>'),'#grafik_bagi_hasil',"<?= $y ?>");
    </script>
  </body>
</html>