		<?php include('header_global.php');?>
		<?php include('navigation_global.php');?>
    <div class="b-dot" style="margin-top:70px;">
			<div class="col-lg-12 well">
        <div class="row">

          <div style="padding:20px;">
            <div class="col-sm-3">
							<div class="profil-detail">
								<div class="picture" style="text-align:center;">
									<?php 
										$foto = $data_user->foto;
									?>
									<img src="<?= $foto ? base_url('assets/uploads/foto_siswa/'.$foto) : base_url('assets/images/user.png') ?>"  alt="Foto Profil Siswa" class="img-responsive">
								</div>
							</div>
						</div>
            <div class="col-sm-9">
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> <strong>Nama</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->nama_siswa ? $data_user->nama_siswa : 'No name'?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email</strong></div>
								<div class="col-sm-8 p10"><?php echo $data_user->email ? $data_user->email : '-'?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Username</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->username ? $data_user->username : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>No. Telepon Siswa</strong></div>
								<div class="col-sm-8 p10"><?php echo $data_user->telepon ? $data_user->telepon : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>No. Telepon Orang Tua</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->telepon_ortu ? $data_user->telepon_ortu : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> <strong>Sekolah</strong></div>
								<div class="col-sm-8 p10"><?php echo $data_user->nama_sekolah ? $data_user->nama_sekolah : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span> <strong>Kelas</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->tingkatan_kelas ? $data_user->tingkatan_kelas : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-12 p10">&nbsp;</div>
							</div>
						</div>
						<div class="row ptb0rl10">
							<div class="col-sm-9">&nbsp;</div>
							<div class="col-sm-3">
								<a href="<?php echo base_url('user/ubah_profil')?>" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-cog"></span> Edit Profil</a>
							</div>
						</div>
					</div>
					
        </div>
			</div>        
			<div class="clearfix"></div>
    </div>
    
    <?php include('footer_global.php');?>
