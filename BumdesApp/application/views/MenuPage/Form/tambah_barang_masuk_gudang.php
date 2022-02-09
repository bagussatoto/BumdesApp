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
                    <h1>Tambah barang masuk</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="set-tambah-logistik" id="set-tambah-logistik" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Komoditas</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <select class="form-control " name="nama" id="komoditas" required>
                          <option value="">Pilih komoditas</option>
                          <?php foreach ($v as $key => $s) {
                            echo '<option data-s2="'.$s->st2.'" data-s="'.$s->st.'" value="'.$s->id.'">'.$s->kom.'</option>';
                          } ?>
                        </select>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Jenis</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input checked type="radio" name="jenis" value="Beli" class="jenis" id="primary">
                          <label for="">Pembelian</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="radio" name="jenis" value="Non-beli" class="jenis">
                          <label for="">Non-pembelian</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Jumlah</label>
                        <div class="col-md-5 col-sm-5 col-xs-5">
                          <input autocomplete="off" placeholder="Jumlah stok masuk sesuai satuan" type="text" required class="form-control empty-form float-nums" name="jumlah">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input readonly type="text" class="form-control empty-form" id="satuan"  name="n_sat">
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Harga</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input autocomplete="off" placeholder="Biaya yang dikeluarkan" type="text" required class="form-control" id="harga" name="harga" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                          <!--========================================================-->
                          <span><input checked type="checkbox" id="cut-saldo" name="potong_saldo" value="Ya"> <label for="">Potong otomatis saldo</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input readonly class="form-control" value="Rp. <?= isset($b[0])? $b[0]->ac:0 ?>" id="saldo">
                          <span><label for="">Saldo saat ini</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3" id="warning" style="display: none;">
                          <small class="label label-danger">Nilai melebihi saldo saat ini</small>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal masuk</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class='input-group date  tanggal_form tanggal_new'>
                              <input type='text' class="form-control" readonly="readonly"  name="tanggal" value="<?= date('d-m-Y') ?>" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
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
                        <!-- <button type="button" class="btn btn-md btn-info" onclick="reset_form()">Reset</button> -->
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