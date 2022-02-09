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
                    <h1>Ubah barang ter-distribusi/keluar</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-barang-keluar') ?>" id="edit-barang-keluar" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Komoditas</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input type="text" readonly class="form-control" name="nama" value="<?= isset($v->kom)?$v->kom:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly class="form-control" name="id" value="<?= isset($v->id)?$v->id:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Tujuan</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input class="tujuan" <?= isset($v->tj)? $v->tj=='Distribusi'?'checked':null :'Checked disabled' ?>  type="radio" name="tujuan" value="Distribusi">
                          <label for="">Distribusi</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input class="tujuan" <?= isset($v->tj)? $v->tj!='Distribusi'?'checked':null :'disabled' ?> type="radio" name="tujuan" value="Non-distribusi">
                          <label for="">Non-distribusi</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tujuan distribusi</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <select id="mitra" <?= isset($v->id)?$v->tj!='Distribusi'?'disabled':null:null ?> class="form-control" name="mitra" required>
                            <option value="">Pilih tujuan distribusi</option>
                            <?php 
                            foreach ($v2 as $key => $vl) {
                              $vl->id==$v->nm?$sel='selected':$sel=null;
                              echo '<option '.$sel.' value="'.$vl->id.'">'.$vl->nr.'</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Jumlah</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input <?= isset($v->id)?null:'disabled' ?> type="text" required class="form-control float-nums" name="jumlah"  value="<?= isset($v->jl)?$v->jl:'0' ?>" data-jumlah="<?= isset($v->jl)?$v->jl:'0' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input readonly class="form-control"  value="<?= $sk ?>" id="stok">
                          <span><label for="">Stok saat ini</label></span>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input type="text" name="satuan" readonly class="form-control"  value="<?= isset($v->st)?$v->st:'-' ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Nilai</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input name="nilai" type="text" class="form-control" value="<?= isset($v->hg)?$v->hg:'0' ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                          <!--========================================================-->
                          <span><input <?= isset($v->idf)?'checked':null ?> type="checkbox" name="potong_saldo" value="Ya"> <label for="">Catat ke keuangan</label></span>
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class='input-group date  tanggal_form tanggal_edit'>
                            <input id='tanggal_edit' readonly <?= !isset($v->id)?'disabled':'data-tl="'.konv_waktu($v->id).'"' ?> type="text" class="form-control" name="tanggal" value="<?= isset($v->dt)?date('d-m-Y',strtotime($v->dt)):'-' ?>">
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Catatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <textarea name="catatan" class="form-control" name="catatan" id="" cols="30" rows="10" style="resize:none;"><?= isset($v->ct)?$v->ct:null ?></textarea>
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
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
  </body>
</html>