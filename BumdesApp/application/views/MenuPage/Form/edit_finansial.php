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
              <button class="btn btn-md btn-warning" onclick="window.location.href=document.referrer">Batal | Kembali</button>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Ubah catatan keuangan</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-arus-kas') ?>" id="edit-arus-kas" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Keterangan</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input type="text" required class="form-control" name="ket" value="<?= isset($v->kt)?$v->kt:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly class="form-control" name="id" value="<?= isset($v->id)?$v->id:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Jumlah</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input id="jumlah-edit-fin" type="text" required class="form-control" name="jumlah" value="<?= isset($v->db)||isset($v->kd)? $v->db!=null?$v->db:$v->kd :'-' ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input id="jenis-edit-fin" type="text" readonly class="form-control" value="<?= isset($v->db)||isset($v->kd)? $v->db!=null?'Debit':'Kredit' :'-' ?>" name="jenis">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" id="saldo" readonly class="form-control" value="Rp. <?= isset($s[0])? $s[0]->ac:0 ?>">
                          <span><label for="">Saldo saat ini</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3" id="warning" style="display: none;">
                          <small class="label label-danger">Nilai melebihi saldo saat ini</small>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Tanggal</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <div class='input-group date  tanggal_form tanggal_edit'>
                            <input id='tanggal_edit' readonly <?= !$v?'disabled':'data-tl="'.konv_waktu($v->id).'"' ?> type="text" required class="form-control" name="tanggal" value="<?= isset($v->tg)?date('d-m-Y',strtotime($v->tg)):'-' ?>">
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Pengecualian</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <ul>
                            <li>Pencatatan pemasukan dagang secara otomatis</li>
                            <li>Pencatatan pembelian aset secara otomatis</li>
                            <li>Pencatatan pembelian kebutuhan dagang secara otomatis</li>
                          </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <ul>
                            <li>Pencatatan bagi hasil</li>
                            <li>Pencatatan pembayaran sewa</li>
                          </ul>
                        </div>
                      </div> <br>
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button <?= isset($v->id)?null:'disabled' ?> type="submit" class="btn btn-md btn-primary">Kirim</button>
                      </div>
                    </form>
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
    <script src="<?= base_url('asset/JS/Dtmpicker.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
  </body>
</html>