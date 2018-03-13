    <header class="akun-header">
      <div class="wrapper">
        <img src="<?php 
				if($infosiswa->foto == ""){
				echo base_url('assets/uploads/foto_siswa/default.jpg');
				}else{
				echo base_url('assets/uploads/foto_siswa/'.$infosiswa->foto);
				}
				?>">
        <div class="profile-name">
          <h5><?php echo $infosiswa->nama_siswa; ?></h5>
          <h6><?php echo $infosiswa->nama_sekolah; ?></h6>
        </div>
        <div class="akun-edit">
          <a id="edit-profile-menu2" href="<?php echo base_url('user/ubah_profil');?>" class="btn btn-default btn-edit"><span class="glyphicon glyphicon-cog"></span>Edit Profil</a>
          <div class="score">
            <button class="btn number orange">1</button>
            <button id="poinSiswa" class="btn number blue" title="Poin Kamu">
              <?php echo $infosiswa->poin; ?>
            </button>
          </div>
        </div>
      </div>
    </header>
