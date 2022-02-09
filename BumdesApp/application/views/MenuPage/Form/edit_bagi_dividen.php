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
              <form action="<?= site_url('edit-bagi-dividen') ?>" id="edit-bagi-dividen" method="POST" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="mitra">Tahun</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input autocomplete="off" type="text" placeholder="Masukkan tahun" class="form-control" name="tahun" value="<?= isset($v->td)?$v->td:'-' ?>">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input name="id" readonly type="text" class="form-control" name="nilai" id="nilai-dividen" placeholder="Masukkan jumlah bagi hasil" value="<?= isset($v->id)?$v->id:'-' ?>">
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Total / persentase</label>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input required type="text" name="nilai" class="form-control" value="<?= isset($v->jd)?$v->jd:'-' ?>">
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <input readonly min="100" type="number" class="form-control" id="total-pers" value="100">
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Pembagian dividen</label>
                  <div class="col-md-7 col-sm-7 col-xs-7">
                    <table id="table-master">
                      <?php 
                        foreach ($v2 as $key => $val) {
                          $but = $key?'<td class="col-md-1 col-sm-1 col-xs-1"><button type="button" class="btn btn-xs btn-danger kill-but">X</button></td>':null;
                          echo '<tr>
                                    <td class="col-md-4 col-sm-4 col-xs-4">
                                        <input autocomplete="off" required type="text" class="form-control" name="entitas[]" value="'.$val->ent_d.'">
                                        <label>Penerima</label>
                                    </td>
                                    <td class="col-md-1 col-sm-1 col-xs-1 last-child">
                                        <input autocomplete="off" required type="text" class="form-control jumlah-div" name="jumlah[]" value="'.$val->pers_d.'">
                                        <label>Jumlah (%)</label>
                                    </td>
                                    '.$but.'
                                </tr>';
                        }
                      ?>
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
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
  </body>
</html>