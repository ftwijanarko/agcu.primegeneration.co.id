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
            <h2 class="mapel-title">Hasil Test Learning Style</h2>
        </div>
    </header>

	<?php
		$total = $totalv + $totala + $totalk;
		
		$persenv = ($totalv / $total) * 100;
		$persena = ($totala / $total) * 100;
		$persenk = ($totalk / $total) * 100;
	?>
	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>LEARNING STYLE</h4>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-stripped">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th style="background-color: #B8400D; color: white; text-align: center;">SKOR</th>
								<th style="background-color: #B8400D; color: white; text-align: center;">DOMINASI</th>
								<th style="background-color: #B8400D; color: white; text-align: center;"><?php echo $dominasi; ?></th>
								<th style="background-color: #B8400D; color: white; text-align: center;">
								<?php
									if($dominasi == "V"){
										echo "VISUAL";
									}elseif($dominasi == "A"){
										echo "AUDITORI";
									}elseif($dominasi == "K"){
										echo "KINESTETIK";
									}elseif($dominasi == "VA"){
										echo "VISUAL - AUDITORI";
									}elseif($dominasi == "VK"){
										echo "VISUAL - KINESTETIK";
									}elseif($dominasi == "AK"){
										echo "AUDITORI - KINESTETIK";
									}
								?>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td><h4>VISUAL</h4></td>
								<td style="text-align: center"><h4><?php echo $totalv; ?></h4></td>
								<td colspan="3" valign="middle">
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenv; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenv; ?>%;">
										<?php echo $persenv; ?>%
									  </div>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><h4>AUDITORI</h4></td>
								<td style="text-align: center"><h4><?php echo $totala; ?></h4></td>
								<td colspan="3" valign="middle">
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persena; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persena; ?>%;">
										<?php echo $persena; ?>%
									  </div>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><h4>KINESTETIK</h4></td>
								<td style="text-align: center"><h4><?php echo $totalk; ?></h4></td>
								<td colspan="3" valign="middle">
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenk; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenk; ?>%;">
										<?php echo $persenk; ?>%
									  </div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>HASIL ANALISA LEARNING STYLE</h4>
				</div>
				<div class="panel-body">
					<h4>
					Berdasarkan data Modalitas Belajar di atas, maka yang menonjol adalah Kemampuan
					<?php
					if($dominasi == "V"){
						echo "VISUAL";
					}elseif($dominasi == "A"){
						echo "AUDITORI";
					}elseif($dominasi == "K"){
						echo "KINESTETIK";
					}elseif($dominasi == "VA"){
						echo "VISUAL - AUDITORI";
					}elseif($dominasi == "VK"){
						echo "VISUAL - KINESTETIK";
					}elseif($dominasi == "AK"){
						echo "AUDITORI - KINESTETIK";
					}
					?>. Putra-Putri Bapak/Ibu adalah Pelajar dengan tipe <?php
					if($dominasi == "V"){
						echo "VISUAL";
					}elseif($dominasi == "A"){
						echo "AUDITORI";
					}elseif($dominasi == "K"){
						echo "KINESTETIK";
					}elseif($dominasi == "VA"){
						echo "VISUAL - AUDITORI";
					}elseif($dominasi == "VK"){
						echo "VISUAL - KINESTETIK";
					}elseif($dominasi == "AK"){
						echo "AUDITORI - KINESTETIK";
					}
					?>. Dengan karakteristik umum dan pola belajar serta metode belajar yang  tepat, sebagai berikut: 
					</h4>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>KARAKTERISTIK</h4>
				</div>
				<div class="panel-body">
					<?php echo $karakteristik; ?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>SARAN STRATEGI BELAJAR</h4>
				</div>
				<div class="panel-body">
					<?php echo $saran; ?>
				</div>
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
    type: 'doughnut',
    data: {
        labels: [
        "Soal Selesai",
        "Sisa Soal"
    ],
    datasets: [
        {
            data: [50, 300],
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
	
  </body>
</html>