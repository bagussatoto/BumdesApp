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
          <div class="col-md-12">
              <button class="btn btn-md btn-warning" onclick="window.location.href=document.referrer"> Kembali</button>
          </div>
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Profil admin</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Informasi user</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img style="padding: .5px; border: 1px solid black; max-height: 150px; max-width: 250px;" class="img-responsive avatar-view" src="<?= isset($u->ft)?base_url('media/admin/'.$u->ft):base_url('media/admin/unnamed.png') ?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?= isset($v->nm)?$v->nm:'-'?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> Kalipuru, Kebumen, Jawa Tengah
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?= $k ?>
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i> <?= isset($v->kn)?$v->kn:'-'?>
                        </li>
                      </ul>

                      <a href="ubah-profil" class="btn btn-xs btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                      <a href="ganti-password" class="btn btn-xs btn-warning"><i class="fa fa-gears m-right-xs"></i> Ganti password</a>
                      <br />

                      <!-- start skills -->
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Histori aktivitas</h2>
                        </div>
                        <div class="col-md-6">
                          <!-- <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                          </div> -->
                          <form action="<?= site_url('detail-user/'.$id) ?>" class="form-filter" method="GET">
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
                      </div><br>
                      <!-- start of user-activity-graph -->
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Waktu</th>
                            <th>Tanggal</th>
                          </tr>
                        </thead>

                        <tbody id="val-body" data-act="hapus-stok-masuk" data-meth="POST">
                            <?= $value['val'] ?>
                        </tbody>
                      </table>
                      <div class="pgn-cust">
                        <?= $value['paginasi'] ?>
                      </div>
                      <!-- end of user-activity-graph -->
                    </div>
                  </div>
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
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
  </body>
</html>
