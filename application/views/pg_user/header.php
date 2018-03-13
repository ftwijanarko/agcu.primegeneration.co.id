        <div class="navbar navbar-fixed-top navhome" role="navigation">
          <div class="container-fluid" style="padding:0">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bso">
                <span class="icon-bar first"></span>
                <span class="icon-bar second"></span>
                <span class="icon-bar third"></span>
              </button>
              <a class="logo" href="<?php echo base_url(''); ?>"><img src="<?php echo base_url('assets/dashboard/images/logoWhite.png')?>" alt="Prime Generation Integrative Online Learning"></a>
            </div>
            
            <div class="collapse navbar-collapse navstyle" id="nav-bso">
              <ul class="nav navbar-nav">
                
				<?php 
				if (isset($_SESSION['akses'])){
					if (count($_SESSION['akses']) > 0){
						if (isset($_SESSION['akses']['reguler'])){
							$paketaktif = $_SESSION['akses']['reguler'][0]; 
						} else if (isset($_SESSION['akses']['premium'])){
							$paketaktif = $_SESSION['akses']['premium'][0]; 
						}
					} else {
						$paketaktif = 0;
					}
				} else {
					$paketaktif = 0;
				}
				?>
				
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <?php 
                if(!empty($_SESSION['id_siswa'])) { ?>
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
                    <ul class="dropdown-menu dropdown-paket">
											<li><a href="<?php echo base_url('user/dashboard');?>">Dashboard</a></li>
                      <li><a href="<?php echo base_url('user');?>">Profilku</a></li>
                      <li><a href="<?php echo base_url('user/ubah_profil');?>">Ubah Profil</a></li>
                      <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
                    </ul>
                  </li>
                <?php 
                } 
                else { ?>
                  <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url('pencarian'); } else { echo 'javascript:void(0);'; } ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                  <li><a href="<?php echo base_url('login')?>">LOGIN/DAFTAR</a></li>
                <?php 
                } ?>
              </ul>
             </div>
          </div>
        </div>
