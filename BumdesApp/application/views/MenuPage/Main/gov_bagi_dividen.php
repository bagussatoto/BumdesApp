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
            <?php $this->load->view('SuptPage/MenuPageGov') ?>
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
        <div class="right_col" role="main" style="color:black;">
          <div class="x_panel">
            <div class="x_title">
            <h1>Informasi kerjasama bagi hasil BUMDes</h1>
              <div class="clearfix"></div>
            </div>
            <!-- <div class="x_content">
              <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-9">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="row">
                    <form id="laporan-keuangan" action="<?= site_url('keuangan-bulanan') ?>" method="GET">
                      <div class="col-md-12  col-sm-12 col-xs-12">  
                        <div class="form-group">
                          <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#laporan-keuangan').submit()">
                            <?php 
                              foreach ($tahun as $key => $val) {
                                $key==$y?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                    </form>
                </div>
                </div>
              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Bagi hasil usaha BUMDes</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Total bagi hasil</th>
                            <th>Penerima</th>
                            <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($val as $key => $v) {
                                echo '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>Rp. '.$v->jd.'</td>
                                        <td>'.$v->je.'</td>
                                        <td>'.anchor('gov-det-bghu/'.$v->id,'Detail').'</td>
                                      </tr>';
                            }
                          ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan penerimaan bagi hasil <small>Bulan Januari 2020</small></h3>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_bagi_hasil"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="border-top: 1px solid #d9dee4;">
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php $this->load->view('SuptPage/JsP') ?>
    <script src="<?= base_url('asset') ?>/JS/Highchart.js"></script>
    
    <script type="text/javascript">
      bagi_hasil_usaha(JSON.parse('<?= $v_grafik ?>'),'#grafik_bagi_hasil');
    </script>
  </body>
</html>