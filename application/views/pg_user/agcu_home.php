		<?php include('header_global.php');?>
		<?php include('navigation_global.php');?>

		<?php
		if ($avail == 1){
			$x = 0;
			$y = 0;
			foreach($jumlahsoaldiagnostic as $jumlahsoal){
				foreach($jumlahsoaldikerjakan as $jumlahdikerjakan){
					if($jumlahdikerjakan->id_diagnostic == $jumlahsoal->id_diagnostic){
						if($jumlahsoal->jumlah_soal == $jumlahdikerjakan->jumlah){
							$iddiagnostic[$jumlahsoal->id_diagnostic] = 'selesai';
							$y += 1;
						}
					}
				}
				$x += 1;
			}
			if($x == $y){
				$statdiag = 'selesai';
			}else{
				$statdiag = 'tidak selesai';
			}	
		}
		?>
		
    <div class="b-dot" style="margin-top:70px;">
			<div class="x_panel">

				<div class="well">
					<div class="col-xs-12 col-sm-6 col-md-6" style="margin-bottom:10px;text-align:justify;">
						<h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
						<p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar anda dengan mengikuti Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, anda akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
						<? /* DISABLE LIHAT HASIL
						<? if ($avail == 1){ ?>
							<?php
								if($statdiag == 'selesai' and $hasileq == 1 and $hasills == 1){
							?>
							<a href="<?= base_url('agcutest/statistik/'.$idprofil) ?>" class="btn btn-primary">Lihat Statistik Nilai</a>
							<?php
								}else{
							?>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Lihat Statistik Nilai</button>
							<?php
								}
							?>
						<? } else { ?>
						<label class="label label-success" style="padding:10px;"><i>Kode Aktivasi yang anda masukkan sudah tidak valid</i></label>
						<div class="clearfix" style="margin-top:20px;"></div>
						<a href="<?= base_url() ?>" class="btn btn-primary">Kembali</a>
						<? } ?>
						*/ ?>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2"></div>
					<div class="col-xs-12 col-sm-4 col-md-4" style="margin-bottom:0px;padding:20px;">
						<img class="img-responsive" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>">
					</div>
					<div class="clearfix"></div>
				</div>

			<? if ($avail == 1){ ?>
			
				<div class="agcu-content">
					<h4>Psychology Potential Test</h4>
					<p>Psychology Potential Test bertujuan untuk mengetahui kemampuan siswa untuk menerima, menilai, mengelola, serta mengontrol emosi dirinya dan orang lain di sekitarnya, mengetahui kesiapan siswa dalam menghadapi tantangan, dan mengetahui seberapa besar motivasi berprestasi siswa</p>
					<?php
					if($hasileq == 0){
					?>
						<a href="<?php echo base_url('agcutest/mulaieqtest/'.$idprofil);?>" class="btn btn-danger">Mulai Test</a>
					<?php
						}else{
					?>
						<a class="btn btn-success">Selesai</a>
					<?php
						}
					?>
				</div>
			 
				<div class="agcu-content">
					<h4>Learning Style Test</h4>
					<p>Learning Style Test bertujuan untuk mengetahui cara siswa dalam menangkap stimulus atau informasi, cara mengingat, berpikir, dan memecahkan persoalan</p>
					<?php
						if($hasills == 0){
					?>
						<a href="<?php echo base_url('agcutest/mulailstest/'.$idprofil);?>" class="btn btn-danger">Mulai Test</a>
					<?php
						}else{
					?>
						<a class="btn btn-success">Selesai</a>
					<?php
						}
					?>
				</div>

				<div class="agcu-box-wrapper">
				<div class="content">
					<h6>Diagnostic Test</h6>
					<p>Diagnostic Test bertujuan untuk mengetahui kemampuan akademik siswa</p>
				</div>
				<?php foreach($kategoridiagnostic as $diagnostic){ ?>
					<div class="agcu-box-container" style="margin-bottom:10px;">
							<div class="header">
								<?php echo $diagnostic->jumlah_soal; ?> Soal
							</div>
							<div class="content">
								<div class="title">
									<h5><?php echo $diagnostic->alias_kelas; ?></h5>
									<h3><?php echo $diagnostic->nama_kategori; ?></h3>
									<br>Durasi : <?php echo $diagnostic->durasi ;?> Menit
									<br>Ketuntasan : <?php echo $diagnostic->ketuntasan ;?>%
								</div>
								<?php
								if(isset($iddiagnostic[$diagnostic->id_diagnostic])){	
								?>
									<a class="btn btn-success">Selesai</a>
								<?php
									}else{
								?>
									<a href="<?= base_url() ?>agcutest/mulaidiagnostic/<?php echo $diagnostic->id_diagnostic;?>" class="btn btn-danger">Mulai Test</a>
								<?php
									}
								?>
							</div>
					</div>
				<?php }?>
				</div>
			 
			<? } ?>
     
			</div>
    </div>

		<!-- MODAL JIKA BELUM MELENGKAPI AGCU -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body text-center">
						<h4>Anda harus melengkapi semua test untuk melihat statistik nilai</h4>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

    <?php include('footer_global.php');?>
