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
                    <h1>Aset umum</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="set-aset-baru" id="set-aset-baru" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama aset</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" required class="form-control" name="nama_aset">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="penyewa">Nomor aset</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input autocomplete="off" type="text" required class="form-control" name="nomor_aset">
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Sumber</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input checked type="radio" name="sumber" class="sumber primary jenis-ast" value="Beli">
                          <label for="">Pembelian</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="radio" name="sumber" class="sumber jenis-ast" value="Non-beli">
                          <label for="">Non-Pembelian</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Harga</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input autocomplete="off" type="text" required class="form-control" name="harga" id="harga-ast"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"><!--id="harga"
                          <span><input checked id="cut-saldo" type="checkbox" name="potong_saldo" value="Ya"> <label for="">Potong otomatis saldo</label></span>-->
                        </div><!--
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input readonly class="form-control" id="saldo" value="Rp. <?= isset($b[0])? $b[0]->ac:0 ?>">
                          <span><label for="">Saldo saat ini</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3" id="warning" style="display: none;">
                          <small class="label label-danger">Nilai melebihi saldo saat ini</small>
                        </div>-->
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Lokasi</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" required class="form-control" name="lokasi">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Kondisi</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input checked type="radio" name="kondisi" value="Baru" class="primary">
                          <label for="">Baru</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="radio" name="kondisi" value="Bekas">
                          <label for="">Bekas</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal masuk</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class="input-group date  tanggal_form tanggal_new">
                              <input  type='text' class="form-control" readonly="readonly"  id="edit_tanggal" name="tanggal_masuk" value="<?= date('d-m-Y') ?>" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Keadaan</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input checked type="radio" name="keadaan" value="Baik"  class="primary">
                          <label for="">Baik</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="radio" name="keadaan" value="Rusak">
                          <label for="">Rusak</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Gambar</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="file" name="gambar" id="gam_file" class="form-control">
                          <span>Tipe file JPG atau PNG</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Catatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <textarea name="catatan" class="form-control" name="cat" id="" cols="30" rows="10" style="resize:none;"></textarea>
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
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>