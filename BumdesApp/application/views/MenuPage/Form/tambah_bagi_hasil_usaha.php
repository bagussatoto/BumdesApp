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
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <h1>Pembagian hasil usaha tahunan</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form action="set-bagi-dividen" id="set-bagi-dividen" method="POST" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="mitra">Tahun / Jumlah bagi hasil</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input autocomplete="off" type="text" placeholder="Masukkan tahun" class="form-control" name="tahun" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" class="form-control" name="nilai" id="nilai-dividen" placeholder="Masukkan jumlah bagi hasil" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    <!-- <span><input <?= isset($v->idf)?'checked':null; ?> type="checkbox" id="cut-saldo" name="potong_saldo" value="Ya"> <label for="">Potong otomatis saldo</label></span> -->
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Total</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input readonly type="text" class="form-control" name="total" id="total-pers">
                  </div>
                  <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="checkbox">
                    <label>Catat ke keuangan</label>
                  </div> -->
                </div> <br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Pembagian dividen</label>
                  <div class="col-md-7 col-sm-7 col-xs-7">
                    <table id="table-master">
                        <tr>
                            <td class="col-md-4 col-sm-4 col-xs-4">
                                <input autocomplete="off" required type="text" class="form-control" name="entitas[]">
                                <label>Penerima</label>
                            </td>
                            <td class="col-md-1 col-sm-1 col-xs-1 last-child">
                                <input autocomplete="off" required type="text" class="form-control jumlah-div" name="jumlah[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                <label>Jumlah (%)</label>
                            </td>
                        </tr>
                    </table>
                  </div>
                </div> <br>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <button type="button" id="tambah-form" class="btn btn-xs btn-info">Tambah form</button>
                  </div>
                </div> <br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" >Catatan</label>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <textarea class="form-control empty-form" name="cat" id="" cols="30" rows="10" style="resize:none;"></textarea>
                    <small class="label label-info">Opsional</small>
                  </div>
                </div> <br>
                
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
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
  </body>
</html>