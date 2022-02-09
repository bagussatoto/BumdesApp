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
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
              <h1>Aset BUMDes</h1>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-md-6">
                  <a href="unduh-daftar-aset"class="btn btn-md btn-warning" target="_blank">Unduh daftar aset</a>
                  <!-- <button type="button" class="btn btn-md btn-warning" onclick="getpdf()">Get pdf</button> -->
                    <a href="add-asset" class="btn btn-md btn-info">Tambah aset baru</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="height: 70px;">
                <div class="x_content text-center">
                  <button class="btn btn-md btn-primary">Tambah Toko</button>
                </div>
              </div>
            </div>
          </div> -->
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Aset umum</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama aset</th>
                            <th>Nomor aset</th>
                            <th>Lokasi aset</th>
                            <th>Detail</th>
                            <th>Tahun terdaftar</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>

                        <tbody data-act="hapus-aset" data-meth="POST">
                          <?= $v1 ?>
                          
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Aset disewakan</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama aset</th>
                            <th>Nomor aset</th>
                            <th>Lokasi aset</th>
                            <th>Detail</th>
                            <th>Tahun terdaftar</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?= $v2 ?>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Aset bagi hasil</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama aset</th>
                            <th>Nomor aset</th>
                            <th>Lokasi aset</th>
                            <th>Detail</th>
                            <th>Tahun terdaftar</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?= $v3 ?>
                          
                        </tbody>
                      </table>
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
    <script src="<?= base_url('asset/JS/Form_hapus.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <!--Javascript tambahan -->
    <script src="<?= base_url('asset') ?>/JS/Fitur.js"></script>
    <script src="<?= base_url('asset/JS/Ajax_req.js') ?>"></script>
    <script>
      let doc = new jsPDF('p','pt','a4');
      
      function getpdf(){
        var html = $('.right_col');
        doc.addHTML(html,function() {
          doc.save('htmlp.pdf');
        });
      }
    </script>
  </body>
</html>