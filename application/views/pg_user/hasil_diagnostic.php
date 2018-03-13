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
    
  </head>
  <body>
    <header class="header">
      <!-- nav bar -->
         <?php include('header_dynamic.php'); ?>
        <div class="mapel-header">
            <h2 class="mapel-title">Hasil Diagnostic Test</h2>
        </div>
    </header>

	
<?php
//PERHITUNGAN SKOR
foreach($kategoridiagnostic as $diagnostic){
	foreach($datasoal as $soal){
		if($soal->id_diagnostic == $diagnostic->id_diagnostic){
			foreach($jumlahbenar as $datanilai){
				if($datanilai->id_diagnostic == $diagnostic->id_diagnostic){
					$skor[$diagnostic->id_diagnostic] = round(($datanilai->jumlah_benar / $soal->jumlah)*100, 2);
					$soalbenar[$diagnostic->id_diagnostic] = $datanilai->jumlah_benar;
					$soalsalah[$diagnostic->id_diagnostic] = $soal->jumlah - $datanilai->jumlah_benar;
				}
			}
		}
	}
}

foreach($kategoridiagnostic as $diagnostic){
	if(!isset($skor[$diagnostic->id_diagnostic])){
		$skor[$diagnostic->id_diagnostic] = 0;
	}
	if($skor[$diagnostic->id_diagnostic] < 40){
		$kategori[$diagnostic->id_diagnostic] = "Sangat Rendah";
	}elseif($skor[$diagnostic->id_diagnostic] >= 40 AND $skor[$diagnostic->id_diagnostic] < 56){
		$kategori[$diagnostic->id_diagnostic] = "Rendah";
	}elseif($skor[$diagnostic->id_diagnostic] >= 56 AND $skor[$diagnostic->id_diagnostic] < 71){
		$kategori[$diagnostic->id_diagnostic] = "Sedang";
	}elseif($skor[$diagnostic->id_diagnostic] >= 71 AND $skor[$diagnostic->id_diagnostic] < 86){
		$kategori[$diagnostic->id_diagnostic] = "Tinggi";
	}elseif($skor[$diagnostic->id_diagnostic] >= 86){
		$kategori[$diagnostic->id_diagnostic] = "Sangat Tinggi";
	}
}

foreach($kategoridiagnostic as $diagnostic){
	foreach($jumlahhasil as $jumlah){
		if($jumlah->id_diagnostic == $diagnostic->id_diagnostic){
			foreach($jumlahbenarhasil as $jumlahbenar){
				if($jumlahbenar->id_diagnostic == $diagnostic->id_diagnostic){
					$average[$diagnostic->id_diagnostic] = round(($jumlahbenar->jumlah_benar / $jumlah->jumlah_soal) * 100, 2);
				}
			}
		}
	}
}


?>
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="col-lg-12">
				<a href="diagnostictest" class="btn btn-danger">Kembali Ke Diagnostic Test</a>
				<p>&nbsp;
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<canvas id="myChart" width="400" height="400"></canvas>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Diagnostic Test</h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Bid. Studi</th>
									<th>nilai</th>
									<th>Rata-Rata Kelas</th>
									<th>Rank Bid. Studi</th>
									<th>Kategori</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($kategoridiagnostic as $diagnostic){
								?>
									<tr>
										<td>
											<?php echo $diagnostic->nama_kategori; ?>
										</td>
										<td>
											<?php
												
												echo $skor[$diagnostic->id_diagnostic];
											?>
										</td>
										<td>
											<?php echo $average[$diagnostic->id_diagnostic]; ?>
										</td>
										<td>
											N/A
										</td>
										<td>
											<?php
												
												echo $kategori[$diagnostic->id_diagnostic];
											?>
										</td>
									</tr>
								<?php
									}
								?>
								<tr>
									<td>Jumlah Nilai</td>
									<td><?php echo array_sum($skor); ?></td>
									<td style="text-align: center;" colspan="3">Peringkat</td>
								</tr>
								<tr>
									<td>Nilai Rata2</td>
									<td>
									<?php
										$jumlaharray = count($skor);
										echo array_sum($skor)/$jumlaharray;
									?>
									</td>
									<td style="text-align: center;" colspan="3">Ranking N/A dari N/A Siswa</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<p>&nbsp;
				<?php
					foreach($kategoridiagnostic as $diagnostic){
				?>
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: #DB5C5C; color: white;">
						<h4><?php echo $diagnostic->nama_kategori; ?></h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="75%" style="text-align: center;">INDIKATOR</th>
									<th colspan="2" width="25%" style="text-align: center;">KETUNTASAN</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($analisistopik as $analisis){
										if($analisis->id_diagnostic == $diagnostic->id_diagnostic){
								?>
									<tr>
										<td>
											<?php echo $analisis->topik; ?>
										</td>
										<td>
											<?php
												if($analisis->status == 1){
													echo "Tuntas";
												}else{
													echo "Belum Tuntas";
												}
											?>
										</td>
										<td style="text-align: center;">
											<?php
												if($analisis->status == 1){
													echo '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: green"></span>';
												}else{
													echo '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: red"></span>';
												}
											?>
										</td>
									</tr>
								<?php
										}
									}
								?>
								
							</tbody>
						</table>
						<table class="table table-bordered table-striped">
							<tr>
								<td style="background-color: #DB5C5C; color: white;" width="25%"><h4>Nilai</h4></td>
								<td width="25%">
								<h4><?php echo $skor[$diagnostic->id_diagnostic] ;?></h4>
								</td>
								<td style="background-color: #DB5C5C; color: white;" width="25%"><h4>Tuntas</h4></td>
								<td width="12.5%">
								<h4>
								<?php
									echo $soalbenar[$diagnostic->id_diagnostic];
								?> Soal
								</h4>
								</td>
								<td width="12.5%"><h4>
								<?php echo $skor[$diagnostic->id_diagnostic] ;?> %
								</h4></td>
							</tr>
							<tr>
								<td style="background-color: #DB5C5C; color: white;"><h4>Kategori</h4></td>
								<td>
								<h4><?php echo $kategori[$diagnostic->id_diagnostic];?></h4>
								</td>
								<td style="background-color: #DB5C5C; color: white;"><h4>Belum Tuntas</h4></td>
								<td><h4>
								<?php
									echo $soalsalah[$diagnostic->id_diagnostic];
								?> Soal
								</h4></td>
								
								<td><h4>
								<?php echo 100-$skor[$diagnostic->id_diagnostic] ;?> %
								</h4></td>
							</tr>
						</table>
					</div>
				</div>
				<?php
					}
				?>
			</div>
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
    type: 'bar',
    data: {
        labels: [
		<?php
		foreach($kategoridiagnostic as $diagnostic){
			echo '"'.$diagnostic->nama_kategori.'",';
		}
		?>
		],
        datasets: [{
            label: '# Nilai Mata Pelajaran',
            data: [
			<?php
			foreach($kategoridiagnostic as $diagnostic){
				echo $skor[$diagnostic->id_diagnostic].",";
			}
			?>
			],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
	
  </body>
</html>