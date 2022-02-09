        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Umum</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-desktop"></i>Logistik<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= site_url('stok-masuk') ?>">Belanja barang</a></li>
                      <li><a href="<?= site_url('exit-item') ?>">Barang keluar</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i>Perdagangan<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= site_url('distribution') ?>">Distribusi</a></li>
                      <li><a href="<?= site_url('commodity') ?>">Komoditas dagang</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i>Penyewaan<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= site_url('rentalling') ?>">Penyewaan barang</a></li>
                      <li><a href="<?= site_url('rent-price') ?>">Harga penyewaan</a></li>
                    </ul>
                  </li>

                  <li><a href="<?= site_url('bagi-hasil') ?>"><i class="fa fa-home"></i>Kerjasama bagi hasil<span class="fa fa-chevron-right"></span></a></li>
                  <li><a href="<?= site_url('dividen-bumdes') ?>"><i class="fa fa-home"></i>Bagi hasil usaha<span class="fa fa-chevron-right"></span></a></li>
                  <li><a href="<?= site_url('assets') ?>"><i class="fa fa-home"></i>Aset<span class="fa fa-chevron-right"></span></a></li>
                  <!-- <li><a><i class="fa fa-home"></i>Aset<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="shop-list">Daftar toko</a></li>
                      <li><a href="<?= site_url('warehouse-list') ?>">Daftar gudang</a></li>
                      <li><a href="<?= site_url('assets') ?>">Aset usaha</a></li>
                    </ul>
                  </li> -->
                  <li><a><i class="fa fa-edit"></i>Finansial<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= site_url('weekly-freport') ?>">Laporan Mingguan</a></li>
                      <li><a href="<?= site_url('monthly-freport') ?>">Laporan Bulanan</a></li>
                      <li><a href="<?= site_url('annual-freport') ?>">Laporan Tahunan</a></li>
                      <li><a href="<?= site_url('corp-profits') ?>">Laba dagang perusahaan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Administrasi<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="business-letter">Pencatatan surat</a></li> -->
                      <li><a href="<?= site_url('business-partner') ?>">Rekanan usaha</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Khusus</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-windows"></i>Administrator<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= site_url('user-management') ?>">Daftar admin</a></li>
                      <li><a href="<?= site_url('admin-log') ?>">Log admin</a></li>
                    </ul>
                  </li>
                  <li><a href="<?= site_url('account') ?>"><i class="fa fa-home"></i>Akun<span class="fa fa-chevron-right"></span></a></li>
                </ul>
              </div>
            </div>