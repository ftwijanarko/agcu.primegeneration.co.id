<!DOCTYPE html>
<html lang="en">
  <head>    
    <title>Prime Mobile - Cara belajar masa kini</title>
    
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
    
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    
	<script>
	$(function(){
		$("#kelas").change(function(){
			$("#mapel").load("mapel/" + $("#kelas").val());
		});
		$("#mapel").change(function(){
			$("#tryout").load("tryout/" + $("#mapel").val());
		});
	});
	</script>
  </head>
  <body>

  
<?php
$x = 1;
foreach($dataperingkat as $peringkat){
	$skor[$x] = round(($peringkat->jumlah_benar/$totalsoal->jumlah_soal)*100, 2);
	
	if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
		$skorsaya = round(($peringkat->jumlah_benar/$totalsoal->jumlah_soal)*100, 2);
	}
	
	$x++;
}


?>
    <header class="header">
      <!-- nav bar -->
         <?php include('header_dynamic.php'); ?>
        <div class="mapel-header">
            <h2 class="mapel-title">Statistik Nilai <?php echo $aliaskelas->nama_profil; ?></h2>
        </div>
    </header>

    <!-- Table of Content -->
    <div id="content-sidebar">
        <div class="tableofcontent">
            <div class="table-sidebar">
                <div id="sidebar" class="left-side">
				
					<canvas id="myChart" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
					
					
					<?php foreach($analisis_mapel as $statmapel){
					?>
					<h4><?php echo $statmapel->nama_kategori; ?></h4>
					<div class="progress">
					  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($statmapel->skor, 1)."%"; ?>;">
						<?php echo round($statmapel->skor, 1)."%"; ?>
					  </div>
					</div>
					<?php
					}
					?>
					
                </div>
            </div>
      
		  <div class="table-desc">
		  
		  <div class="col-lg-12">
			<h3>Analisis Report</h3>
		  </div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Total Peserta: <?php echo $totalpeserta;?></h4>
		  </div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Total Soal: <?php echo $totalsoal->jumlah_soal;?></h4>
		  </div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<h4><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Benar: <?php echo $jumlahbenar->jumlah_benar;?> Salah /  Belum terjawab: <?php echo $totalsoal->jumlah_soal - $jumlahbenar->jumlah_benar;?></h4>
		  </div>
		  <p>&nbsp;
		  
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="text-align: center; background-color: #dff0d8;">
			<span class="glyphicon glyphicon-queen" aria-hidden="true" style="font-size: 40px; margin-top: 15px; color: #59c9ff;"></span>
			<h4>Tertinggi</h4>
			<br>Nilai : <?php echo $skor[1]; ?>
			<br>Skor : <?php echo $skor[1]; ?>%
		  </div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="text-align: center; background-color: #d9edf7;">
			<span class="glyphicon glyphicon-bishop" aria-hidden="true" style="font-size: 40px; margin-top: 15px; color: #59c9ff;"></span>
			<h4>Anda</h4>
			<br>Nilai : <?php echo $skorsaya; ?>
			<br>Skor : <?php echo $skorsaya; ?>%
		  </div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="text-align: center; background-color: #f2dede;">
			<span class="glyphicon glyphicon-pawn" aria-hidden="true" style="font-size: 40px; margin-top: 15px; color: #59c9ff;"></span>
			<h4>Terendah</h4>
			<br>Nilai : <?php echo min($skor); ?>
			<br>Skor : <?php echo min($skor); ?>%
		  </div>
		  
		  <p>&nbsp;
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Hasil Tes</a></li>
			<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Rangking</a></li>
			<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Grafik</a></li>
		  </ul>
			
		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
			
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h4>Analisis Pelajaran dan Waktu</h4>
			  </div>
			  <div class="panel-body" style="overflow: auto;">
				<!-- analisis pelajaran -->
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="background-color: #E3E3E3; padding-top: 25px; padding-bottom: 25px; color: #DB5C5C;">
					<span class="glyphicon glyphicon-file" aria-hidden="true" style="font-size: 85px;"></span>
					<h4>Mata Pelajaran</h4>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<table class="table table-stripped table-hover">
						<thead>
							<tr>
								<th class="text-center">Try Out</th>
								<th class="text-center">Jumlah Soal</th>
								<th class="text-center">Benar</th>
								<th class="text-center">Salah</th>
								<th class="text-center">Nilai</th>
								<th class="text-center">Skor</th>
								<th class="text-center">Tuntas</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($analisis_mapel as $datamapel){
							?>
								<tr>
									<td class="text-center"><?php echo $datamapel->nama_kategori; ?></td>
									<td class="text-center"><?php echo $datamapel->jumlah_soal; ?></td>
									<td class="text-center"><?php echo $datamapel->benar; ?></td>
									<td class="text-center"><?php echo $datamapel->salah; ?></td>
									<td class="text-center"><?php echo $datamapel->nilai; ?></td>
									<td class="text-center"><?php echo round($datamapel->skor, 1)."%"; ?></td>
									<td class="text-center">
										<?php
											if($datamapel->tuntas == '1'){
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
				<!-- end analisis pelajaran -->
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<hr>
				</div>
				<!-- analisis waktu -->
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-center" style="background-color: #E3E3E3; padding-top: 25px; padding-bottom: 25px; color: #DB5C5C;">
					<span class="glyphicon glyphicon-time" aria-hidden="true" style="font-size: 85px;"></span>
					<h4>Waktu</h4>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<table class="table table-stripped table-hover">
						<thead>
							<tr>
								<th class="text-center">Try Out</th>
								<th class="text-center">Jumlah Soal</th>
								<th class="text-center">Disediakan</th>
								<th class="text-center">Dikerjakan</th>
								<th class="text-center">Rata - rata</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($analisis_waktu as $datawaktu){
							?>
								<tr>
									<td class="text-center"><?php echo $datawaktu->nama_kategori; ?></td>
									<td class="text-center"><?php echo $datawaktu->jumlah_soal; ?></td>
									<td class="text-center"><?php echo $datawaktu->disediakan; ?></td>
									<td class="text-center"><?php echo $datawaktu->dikerjakan; ?></td>
									<td class="text-center"><?php echo $datawaktu->rata_rata; ?></td>
								</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
				<!-- end analisis waktu -->
			  </div>
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
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h4><?php echo $kategoritopik->nama_kategori; ?> / <?php echo $kategoritopik->alias_kelas; ?></h4>
			  </div>
			  <div class="panel-body" style="overflow: auto;">
				<table class="table table-stripped table-hover">
					<thead>
						<tr>
							<th class="text-center">Topik/Indikator</th>
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
									<td class="text-center">
									<?php if($topik->status == 1){
									?>
									100%
									<?php
									}else{
									?>
									0%
									<?php	
									}?>
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
			 </div>
			<?php
			}
			?>
			</div>
			
			</div>

			<div role="tabpanel" class="tab-pane" id="profile">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama</th>
						<th>Sekolah</th>
						<th>Nilai</th>
						<th>Skor</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach($dataperingkat as $peringkat){
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td>
							
							<?php 
							if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
								echo "<b>".$peringkat->nama_siswa."</b>"; 
							}else{
								echo $peringkat->nama_siswa;
							}
							
							
							?>
							
							</td>
							<td><?php echo $peringkat->nama_sekolah; ?></td>
							<td><?php echo round(($peringkat->jumlah_benar/$totalsoal->jumlah_soal)*100, 2); ?></td>
							<td><?php echo round(($peringkat->jumlah_benar/$totalsoal->jumlah_soal)*100, 2); ?>%</td>
						</tr>
					<?php
					$no++;
					}
					?>
				</tbody>
			</table>
			</div>
			<div role="tabpanel" class="tab-pane" id="messages">
			
			<canvas id="grafik" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
			
			</div>
		  </div>
		  
		  
		  
			
		  </div><!-- side kanan -->
    </div> 
      </div>       
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
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
				echo $statmapel->skor.",";
			}
			?>
			],
        }]
    }
});
</script>
	
  </body>
</html>