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
                <button class="btn btn-md btn-warning" onclick="window.history.back()">Batal | Kembali</button>
            </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h1>Ubah data penerimaan bagi hasil</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form action="<?= site_url('edit-pemb-bgh') ?>" id="edit-pemb-bgh" method="POST" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Rekanan</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="text" value="<?= isset($v->id)?$v->nm:'-' ?>" readonly class="form-control" name="mitra">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" value="<?= isset($v->id)?$v->id:'-' ?>" readonly class="form-control" name="id" >
                  </div>
                </div> <br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Aset</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="text" value="<?= isset($v->id)?$v->ast:'-' ?>" readonly class="form-control" name="aset" >
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal mulai / durasi</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" value="<?= isset($v->tm)?date('d-m-Y',strtotime($v->tm)):'-' ?>" readonly class="form-control">
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-1">
                    <input type="text" value="<?= isset($v->dur)?$v->dur:'-' ?>" readonly class="form-control">
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <input type="text" value="Bulan" readonly class="form-control">
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Catatan</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="text" value="<?= isset($v->id)?$v->ct:'-' ?>" required class="form-control" name="cat" >
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal bayar</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="input-group date  tanggal_form tanggal_edit">
                      <input value="<?= isset($v->id)?date('d-m-Y',strtotime($v->tb)):'-' ?>" <?= !isset($v->id)?'disabled':'data-tl="'.konv_waktu($v->id).'"' ?> type='text' class="form-control" readonly="readonly" id="tanggal_edit" name="tanggal" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div> <br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Nilai pembayaran (Rp)</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input autocomplete="off" value="<?= isset($v->id)?$v->jl:'-' ?>" type="text" required class="form-control" name="jumlah" id="nominal-edit-pbgh" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    <span><input <?= isset($v->idf)?'checked':null ?> type="checkbox" name="tambah_trans" value="Ya"> <label>Catat ke keuangan</label></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >BUMDes (Rp)</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" value="<?= isset($v->id)?$v->pnb:'-' ?>" readonly class="form-control text-center" id="val-b" name="pen_b">
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <input type="text" value="<?= isset($v->id)?$v->pb.'%':'-' ?>" readonly class="form-control text-center" id="pers-b" name="pers_b">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Rekanan (Rp)</label>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                    <input type="text" value="<?= isset($v->id)?$v->pnm:'-' ?>" readonly class="form-control text-center" id="val-m" name="pen_m">
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <input type="text" value="<?= isset($v->id)?$v->pm.'%':'-' ?>" readonly class="form-control text-center" id="pers-m" name="pers_m">
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <button type="submit" class="btn btn-md btn-primary">Kirim</button>
                </div>
              </form>
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
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Fitur.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Dtmpicker.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
  </body>
</html>