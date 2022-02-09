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
            <?php $this->load->view('SuptPage/'.$page) ?>
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
              <h1>Log admin pengelola</h1>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12 ccol-sm-12 col-xs-12">
                    <div class="row">
                        <form id="log-admin" action="admin-log" class="form-filter">
                          <div class="col-md-4 col-sm-4 col-xs-4">  
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <select name="tahun" class="form-control" onchange="$('#log-admin').submit()">
                                  <?php 
                                    foreach ($v_tahun as $key => $val) {
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
                              <select name="bulan" class="form-control" onchange="$('#log-admin').submit()">
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
                                <select name="limit" class="form-control" onchange="$('#log-admin').submit()" id="limit">
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
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Manajemen BUMDes</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Waktu log</th>
                          <th>Tanggal log</th>
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
          <br>
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
    <!--Javascript tambahan -->
    <script src="<?= base_url('asset') ?>/JS/Fitur.js"></script>
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
  </body>
</html>