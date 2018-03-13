<?php include('header_dashboard.php'); ?>

<?php
$x = 1;
foreach($dataperingkat as $peringkat){
	$skor[$x] =round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
	$nilai[$x] =$peringkat->jumlah_bobot_benar;
	if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
		$skorsaya = round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
		$nilaisaya = $peringkat->jumlah_bobot_benar;
		
		$peringkatsaya = $x;
	}
	
	$x++;
}

if(!isset($skorsaya)){
	$skorsaya = 0;
}
if(!isset($nilaisaya)){
	$nilaisaya = 0;
}
if(!isset($peringkatsaya)){
	$peringkatsaya = "N/A";
}

?>
    <div class="hasil-wrapper">
      <div class="hasil-left">
        <h3><?php echo $aliaskelas->nama_profil; ?></h3>
        <h5>AKTIFITAS PROGRESS</h5>
        <canvas id="myChart" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
        <h5>DAFTAR SEMUA MATERI</h5>
        <ul class="materi">
		  
		  <?php foreach($analisis_mapel as $statmapel){
			?>
			<li>
			<h6><span class="glyphicon glyphicon-play"></span><?php echo $statmapel->nama_kategori; ?></h6>
			<div class="progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($statmapel->jumlah_bobot_benar/$statmapel->jumlah_bobot)*100)."%"; ?>;">
			  </div>
			</div>
			</li>
			<?php
			}
			?>
        </ul>
      </div>
      <div class="hasil-right">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Total Peserta: <?php echo count($dataperingkat);?></h5>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Total Soal: <?php echo $totalsoal->jumlah_soal;?></h5>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Benar: <?php echo $jumlahbenar->jumlah_benar;?></h5>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Peringkat: <?php echo $peringkatsaya;?></h5>
		  </div>
		  <div class="col=lg-12">
			&nbsp;
		  </div>
        <ul class="score">
          <li>
              <h4>TERTINGGI</h4>
              <h5>NILAI : 
			  <?php
			  if(isset($nilai)){
				  echo number_format($nilai[1], 2, '.', '');
			  }else{
				  echo number_format(0, 2, '.', '');
			  }
			  ?></h5>
              <h5>SKOR : 
			  <?php 
			  if(isset($nilai)){
				  echo number_format($skor[1], 2, '.', ''); 
			  }else{
				  echo number_format(0, 2, '.', ''); 
			  }
			  ?>
			  %
			  </h5>
          </li>
          <li>
              <h4>ANDA</h4>
              <h5>NILAI : <?php echo number_format($nilaisaya, 2, '.', ''); ?></h5>
              <h5>SKOR : <?php echo number_format($skorsaya, 2, '.', ''); ?>%</h5>
          </li>
          <li>
              <h4>TERENDAH</h4>
              <h5>NILAI : <?php echo number_format(min($nilai), 2, '.', ''); ?></h5>
              <h5>SKOR : <?php echo number_format(min($skor), 2, '.', ''); ?>%</h5>
          </li>
        </ul>
		<p>&nbsp;
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Hasil Tes</a></li>
			<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Rangking</a></li>
			<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Grafik</a></li>
			<li role="presentation"><a href="#rekap" aria-controls="messages" role="tab" data-toggle="tab">Rekap</a></li>
		  </ul>
		
<div class="tab-content" style="overflow-x: scroll;">
	<div role="tabpanel" class="tab-pane active" id="home">
        <div class="hasil-container">
          <div class="tabel-analisa">
            <div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">ANALISIS PELAJARAN</div>
            <table class="table">
              <thead>
                <tr>
			<th style="text-align: center; width: 10px;">KAtegori</th>
			<th style="text-align: center;">Jumlah Soal</th>
			<th style="text-align: center;">Benar</th>
			<th style="text-align: center;">Salah</th>
			<th style="text-align: center;">Nilai</th>
			<th style="text-align: center;">Skor</th>
			<th style="text-align: center;">Tuntas</th>
		</tr>
              </thead>
              <tbody>
				<?php
					foreach($analisis_mapel as $datamapel){
						$skor = round(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100);
				?>
					<tr>
						<td><?php echo $datamapel->nama_kategori; ?></td>
						<td><?php echo $datamapel->count_benar + $datamapel->count_salah; ?></td>
						<td>
						<?php 
						if($datamapel->count_benar == ""){
							echo "0";
						}else{
							echo $datamapel->count_benar;
						}
						?></td>
						<td><?php echo $datamapel->count_salah; ?></td>
						<td>
						<?php  
						if($datamapel->count_benar == ""){
							echo "0";
						}else{
							if($datamapel->jumlah_bobot_benar > 100){
								echo "100.00";
							}else{
								echo number_format($datamapel->jumlah_bobot_benar, 2, '.', '');
							}
						}
						?></td>
						<td><?php echo number_format(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100, 2, '.', '')."%"; ?></td>
						<td>
							<?php
								if($skor > $datamapel->ketuntasan){
							?>
								<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: green;"></span>	
							<?php
								}else{
							?>
								<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: red;"></span>
							<?php
								}
							?>
						</td>
					</tr>
				<?php
					}
				?>
              </tbody>
            </table>
          </div>
          <div class="tabel-analisa waktu">
            <div class="title"><img src="<?php echo base_url('assets/dashboard/images/alarm.png'); ?>">ANALISIS WAKTU</div>
            <table class="table">
              <thead>
                <tr>
                  <td>Try Out</td>
                  <td>jumlah Soal</td>
                  <td>Disediakan</td>
                  <td>Dikerjakan</td>
                  <td>Rata - rata</td>
                </tr>
              </thead>
              <tbody>
                <?php
					foreach($analisis_waktu as $datawaktu){
				?>
					<tr>
						<td><?php echo $datawaktu->nama_kategori; ?></td>
						<td><?php echo $datawaktu->jumlah_soal; ?></td>
						<td><?php echo $datawaktu->disediakan; ?></td>
						<td><?php echo $datawaktu->dikerjakan; ?></td>
						<td><?php echo $datawaktu->rata_rata; ?></td>
					</tr>
				<?php
					}
				?>
              </tbody>
            </table>
          </div>
		  <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			<div class="col-lg-12" style="background-color: #DB5C5C;; text-align: center;">
				<h4 style="color: white;">Analisis Topik</h4>
			</div>
			</a>
			<p>&nbsp;
			
			<!-- analisis topik -->
			<div class="collapse" id="collapseExample">
			<?php foreach($kategori as $kategoritopik){
			?>
			<div class="tabel-analisa waktu">
			  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/atom.png'); ?>"><?php echo $kategoritopik->nama_kategori; ?></div>
				<table class="table">
					<thead>
						<tr>
							<th class="text-center">Topik/Indikator</th>
							<th class="text-center">Jml Soal</th>
							<th class="text-center">Benar</th>
							<th class="text-center">Salah</th>
							<th class="text-center">Skor</th>
							<th class="text-center">Ketuntasan</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($analisis_topik as $topik){
								if($topik->id_kategori == $kategoritopik->id_kategori){
						?>
								<tr>
									<td class="text-center"><?php echo $topik->topik; ?></td>
									<td><?php echo $topik->jumlah_soal ?></td>
									<td><?php echo $topik->jumlah_benar ?></td>
									<td><?php echo $topik->jumlah_salah ?></td>
									<td class="text-center">
									<?php 
										echo round((($topik->jumlah_benar / $topik->jumlah_soal) * 100), 2).'%';
									?>
									</td>
									<td class="text-center">
									<?php if($topik->status == 1){
									?>
									<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: green;"></span>
									<?php
									}else{
									?>
									<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: red;"></span>
									<?php	
									}?>
									</td>
								</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			 </div>
			<?php
			}
			?>
			</div>
        </div>
	</div>
	
	<div role="tabpanel" class="tab-pane" id="profile">
	<div class="tabel-analisa waktu">
	  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>">Daftar Ranking</div>
		<table class="table">
			<thead>
				<tr>
					<th style="text-align: center; width: 10px;">No.</th>
					<th style="text-align: center;">Foto</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Sekolah</th>
					<th style="text-align: center;">Waktu</th>
					<th style="text-align: center;">Nilai</th>
					<th style="text-align: center;">Skor</th>
				</tr>
			</thead>
			<tbody id="list-profil">
				
			</tbody>
		</table>
	 </div>
	</div>
	
	<div role="tabpanel" class="tab-pane" id="messages">	
	<canvas id="grafik" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
	</div>
	
	<div role="tabpanel" class="tab-pane" id="rekap" style="height: 800px;">
	<div class="tabel-analisa waktu">
	  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>">Rekapitulasi Nilai</div>
		<table class="table">
			<thead>
				<tr>
					<th style="text-align: center; width: 10px;">No.</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Sekolah</th>
					<?php
					foreach($kategori as $kategoritopik){
					echo "<td>".$kategoritopik->nama_kategori."</td>";
					}
					?>
					<th style="text-align: center;">Jumlah Nilai</th>
					<th style="text-align: center;">Skor</th>
					<th style="text-align: center;">Waktu</th>
				</tr>
			</thead>
			<tbody id="list-rekap">
				
			</tbody>
		</table>
	 </div>
	</div>
</div>
		
      </div>
    </div>
    
    <?php include('footer.php');?>

  <script src="js/jquery1.11.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/init.js"></script>
  <div id="edit-profile" class="edit-profile-wrapper">
    <div class="edit-profile-container">
      <div class="header"><img src="images/logo.png"></div>
      <h4>Edit Basic Info</h4><a href="javascript:;" class="close"><span class="glyphicon glyphicon-remove"></span></a>
      <form id="edit-profile-form" class="edit-profile-form">
        <div class="form-group">
          <div class="label-style required">Nama</div>
          <input class="input-style form-control" type="text" id="name" name="name" placeholder="Nama">
        </div>
        <div class="form-group">
          <div class="label-style">Tanggal Lahir</div>
          <input class="input-style form-control" type="text" id="datebirth" name="datebirth" placeholder="Tanggal Lahir">
        </div>
        <div class="form-group">
          <div class="label-style">Nomor HP</div>
          <input class="input-style form-control" type="text" id="phone" name="phone" placeholder="Nomor HP">
        </div>
        <div class="form-group">
          <div class="label-style required">Email</div>
          <input class="input-style form-control" type="text" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <div class="label-style required">Jenis Kelamin</div>
          <select class="form-control input-style" id="gender" name="gender">
              <option value="laki">Laki - laki</option><option value="perempuan">Perempuan</option>               
          </select>
        </div>
        <div class="form-group">
          <div class="label-style required">Alamat (Domisili)</div>
          <input class="input-style form-control" type="text" id="address" name="address" placeholder="Alamat">
        </div>
        <div class="form-group">
          <div class="label-style required">Kelas/Tingkat</div>
          <input class="input-style form-control" type="text" id="class" name="class" placeholder="KELAS XI IPA">
        </div>
        <div class="form-group">
          <div class="label-style required">Sekolah</div>
          <input class="input-style form-control" type="text" id="school" name="school" placeholder="Sekolah">
        </div>
        <div class="form-group">
          <div class="label-style">Ganti Foto</div>
          <input class="input-style" type="file" id="exampleInputFile">
        </div>
        <div class="form-group">
          <div class="label-style">&nbsp;</div>
          <div class="input-style form-thanks">Thank you for submitting your booking with us, this is not a confirmation for your booking, our reservation staff will contact you through your email within 24 hours. Please also check your SPAM or JUNK mail.</div>
        </div>
        <div class="form-group">
          <div class="label-style">&nbsp;</div>
          <button name="csubmit" type="submit" class="btn btn-primary">Submit</button>&nbsp;<button id="Rreset" name="rreset" type="reset" class="btn btn-warning">Reset</button>
        </div>
      </form>
    </div>
  </div>
  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  
  <!-- import chart.js -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript">
        $('#fixednav').scrollToFixed();
        $('#sidebar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#sidebar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
    
	<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        "Soal Selesai",
        "Sisa Soal"
    ],
    datasets: [
        {
            data: [<?php echo $jumlahbenar->jumlah_benar;?>, <?php echo $totalsoal->jumlah_soal - $jumlahbenar->jumlah_benar;?>],
            backgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ],
            hoverBackgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ]
        }]
    }
});
</script>
<script>
var ctx = document.getElementById("grafik");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        <?php
			foreach($analisis_mapel as $statmapel){
				echo '"'.$statmapel->nama_kategori.'",';
			}
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			foreach($analisis_mapel as $statmapel){
				echo (($statmapel->jumlah_bobot_benar/$statmapel->jumlah_bobot)*100) . ",";
			}
			?>
			],
        }]
    }
});
</script>

<script>
window.onload = function () {
	$(function(){
	$("#list-profil").html("<img src='<?php echo base_url('assets/pg_user/images/spinner.gif');?>' style='margin: 0 auto; width: 100px;' />"); 
	$("#list-rekap").html("<img src='<?php echo base_url('assets/pg_user/images/spinner.gif');?>' style='margin: 0 auto; width: 100px;' />"); 
	$("#list-profil").load("../listprofil/" + <?php echo $idprofil;?>);
	$("#list-rekap").load("../listrekap/" + <?php echo $idprofil;?>);
});
};
</script>
  </body>
</html>