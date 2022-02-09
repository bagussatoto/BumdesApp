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
              <h1>Detail aset bagi hasil <?= isset($v->na)?$v->na:'tidak terdaftar' ?></h1>
                <!-- <h1>Detail bagi hasil aset</h1> -->
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="col-md-12 col-sm-12 col-xs-12">
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Aset :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3 id="aset"><?= isset($v->na)?$v->na:'-' ?></h3></td>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Mitra :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3 id="mitra"><?= isset($v->nm)?anchor('detail-mit/'.$v->idm,$v->nm,'target="_blank"'):'-' ?></h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Tanggal mulai :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->tm)?date('d-m-Y',strtotime($v->tm)):'-' ?></h3></td>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Tanggal selesai :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->ts)?date('d-m-Y',strtotime($v->ts)):'-' ?></h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Total bagi hasil :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3 id="jum_bgh"><?= isset($v->jl)?'Rp. '.$v->jl:'Rp. 0' ?></h3></td>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Pembagian :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->id)?'BUMDes: '.$v->pb.'% | Mitra: '.$v->pm.'%':'-' ?></h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Penerimaan BUMDes :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3 id="pen_b"><?= isset($v->pnb)?'Rp. '.$v->pnb:'Rp. 0' ?></h3></td>
                        <td class="col-md-2 col-sm-2 col-xs-2"><h4>Durasi :</h4></td>
                        <td class="col-md-4 col-sm-4 col-xs-4"><h3><?= isset($v->dur)?$v->dur.' Bulan':'-' ?></h3></td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
        <br>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h3>Histori pembayaran bagi hasil</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td><strong>No</strong></td>
                            <td><strong>Keterangan</strong></td>
                            <td><strong>Tanggal bayar</strong></td>
                            <td><strong>Penerimaan BUMDes</strong></td>
                            <td><strong>Penerimaan Rekanan</strong></td>
                            <td><strong>Nilai pembayaran</strong></td>
                            <td><strong>Aksi</strong></td>
                        </tr>
                    </thead>
                    <tbody data-act="<?= site_url('hapus-pemb-bagi-hasil') ?>" data-meth="POST" data-id="<?= isset($v->id)?$v->id:'-' ?>">
                      <?= $v_histori_bgh ?>
                    </tbody>
                </table>
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
    <script src="<?= base_url('asset/JS/Form_hapus.js') ?>"></script>
  </body>
</html>