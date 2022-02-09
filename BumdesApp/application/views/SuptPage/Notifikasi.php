        <div class="top_nav">
          <div class="nav_menu" style="background: #ffffff;">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img class="admin-img-disp" src="<?= isset($this->ses->img)?base_url('media/admin/'.$this->ses->img):base_url('media/admin/unnamed.png') ?>" alt="foto-admin"><?= $this->ses->nm ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?= site_url('account') ?>"> Akun</a></li>
                    <li><a href="<?= site_url('keluar-sistem') ?>" class="keluar-sistem"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>
                <!-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTfvhkTn730H-IIpncfsMdmVtrQKSQ6JvH_0LJsBXhtCn0j-fpc" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTfvhkTn730H-IIpncfsMdmVtrQKSQ6JvH_0LJsBXhtCn0j-fpc" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTfvhkTn730H-IIpncfsMdmVtrQKSQ6JvH_0LJsBXhtCn0j-fpc" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTfvhkTn730H-IIpncfsMdmVtrQKSQ6JvH_0LJsBXhtCn0j-fpc" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>