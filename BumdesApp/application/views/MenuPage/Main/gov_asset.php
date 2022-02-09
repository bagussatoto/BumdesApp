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
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset umum</span>
              <div class="count" ><?= count($v1) ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset disewakan</span>
              <div class="count"><?= $v2?$v2->tp:0 ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Aset bagi hasil</span>
              <div class="count"><?= count($v3) ?></div>
            </div>
          </div>

          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Aset BUMDes Indrakila Jaya</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama aset</th>
                            <th>Nomor aset</th>
                            <th>Lokasi aset</th>
                            <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?= $v ?>
                        </tbody>
                      </table>
                  </div>
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
    
  </body>
</html>