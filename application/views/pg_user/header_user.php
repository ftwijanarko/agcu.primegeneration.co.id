        <nav class="navbar navbar-default navbar-static-top navbar-page">
         <div class="container container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-bso">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>  
            </button>
            <a class="navbar-brand" href="<?php echo base_url(''); ?>"></a>
          </div>
          <div class="collapse navbar-collapse" id="nav-bso">
            <ul class="nav navbar-nav">
            <li class="dropdown menu-large">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">MATA PELAJARAN 
              <span class="caret"></span></a>
              <ul class="dropdown-menu megamenu mega-mapel row">
                <li class="col-sm-3">
                  <ul>
                    <li class="dropdown-header">Bahasa Indonesia</li>
                    <li><a href="#">Bahasa Indonesia Kelas 7</a></li>
                    <li class="dropdown-header">Bahasa Inggris</li>
                    <li><a href="#">Bahasa Inggris Kelas 7</a></li>
                  </ul>
                </li>
                <li class="col-sm-3">
                  <ul>
                    <li class="dropdown-header">Matematika</li>
                    <li><a href="#">Matematika Kelas 7</a></li>
                    <li class="dropdown-header">Fisika</li>
                    <li><a href="#">Fisika Kelas 7</a></li>
                    <li class="dropdown-header">Biologi</li>
                    <li><a href="#">Biologi Kelas 7</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">BELI PAKET <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-paket">
                <li>
                  <a href="<?php echo base_url('user/beli');?>">Beli</a>
                  <a href="<?php echo base_url('user/buylist');?>">Riwayat</a>
                  <a href="<?php echo base_url('user/aktivasi');?>">Aktivasi</a>
                </li>
              </ul>
            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                  <li class="user-name"><a href="<?php echo base_url('user')?>">Selamat datang, <span class="label label-success"><?php echo isset($_SESSION['nama_siswa']) ? strtok($_SESSION['nama_siswa'], ' ') : 'No name' ?></label></a></li>
                  <li><a href="<?php echo base_url('pencarian');?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                  <li class="dropdown user-profile">
                      <a class="dropdown-toggle img-user" data-toggle="dropdown" href="#">
                          <div class="img-circle">
                            <?php 
                              $foto = (isset($_SESSION['foto']) && !empty($_SESSION['foto'])) ? $_SESSION['foto'] : 'default.jpg';
                            ?>
                              <img src="<?php echo base_url('assets/uploads/foto_siswa/'.$foto);?>" width="376" height="500" alt="Prime Generation User Profile" class="img-responsive">
                          </div>
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url('user');?>">Profilku</a></li>
                          <li><a href="<?php echo base_url('user/ubah_profil');?>">Ubah Profil</a></li>
                          <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
                      </ul>
                  </li>
             </ul>
          </div>
                </div>
            </nav>