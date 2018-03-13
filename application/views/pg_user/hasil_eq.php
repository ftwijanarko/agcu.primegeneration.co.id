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
            <h2 class="mapel-title">Hasil Test Emotional Quotient</h2>
        </div>
    </header>

	<div class="container" style="margin-top: 50px;">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Emotional Quotient</h4>
				</div>
				<div class="panel-body">
					<table class="table table-stripped table-bordered">
						<thead>
							<tr>
								<th colspan="2" style="background-color: #B8400D; color: white; text-align: center;">Test</th>
								<th style="background-color: #B8400D; color: white; text-align: center;">Skor</th>
								<th style="background-color: #B8400D; color: white; text-align: center;">Kategori</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="min-width: 10px; text-align: center;"><span class="glyphicon glyphicon-road" aria-hidden="true" style="font-size: 30px; color: #B8400D;"></span></td>
								<td><h4>AQ [Adversity Quotient] (Daya Juang)</h4></td>
								<td style="text-align: center;"><h4><?php echo $data_eq->skor_aq; ?></h4></td>
								<td>
								<?php
								if($data_eq->skor_aq < 7){
									echo "<h4>Rendah</h4>";
								}elseif($data_eq->skor_aq <= 11){
									echo "<h4>Rata-Rata Bawah</h4>";
								}elseif($data_eq->skor_aq <= 21){
									echo "<h4>Rata-Rata</h4>";
								}elseif($data_eq->skor_aq <= 26){
									echo "<h4>Rata-Rata Atas</h4>";
								}elseif($data_eq->skor_aq <= 32){
									echo "<h4>Tinggi</h4>";
								}
								?>
								</td>
							</tr>
							<tr>
								<td style="min-width: 10px; text-align: center;"><span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: 30px; color: #B8400D;"></span></td>
								<td><h4>EQ [Emotional Quotient] (Kecerdasan Emosi)</h4></td>
								<td style="text-align: center;"><h4><?php echo $data_eq->skor_eq; ?></h4></td>
								<td>
								<?php
								if($data_eq->skor_eq < 7){
									echo "<h4>Rendah</h4>";
								}elseif($data_eq->skor_eq <= 11){
									echo "<h4>Rata-Rata Bawah</h4>";
								}elseif($data_eq->skor_eq <= 21){
									echo "<h4>Rata-Rata</h4>";
								}elseif($data_eq->skor_eq <= 26){
									echo "<h4>Rata-Rata Atas</h4>";
								}elseif($data_eq->skor_eq <= 32){
									echo "<h4>Tinggi</h4>";
								}
								?>
								</td>
							</tr>
							<tr>
								<td style="min-width: 10px; text-align: center;"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true" style="font-size: 30px; color: #B8400D;"></span></td>
								<td><h4>AM [Achievement Motivation] (Motivasi Berprestasi)</h4></td>
								<td style="text-align: center;"><h4><?php echo $data_eq->skor_am; ?></h4></td>
								<td>
								<?php
								if($data_eq->skor_am < 7){
									echo "<h4>Rendah</h4>";
								}elseif($data_eq->skor_am <= 11){
									echo "<h4>Rata-Rata Bawah</h4>";
								}elseif($data_eq->skor_am <= 21){
									echo "<h4>Rata-Rata</h4>";
								}elseif($data_eq->skor_am <= 26){
									echo "<h4>Rata-Rata Atas</h4>";
								}elseif($data_eq->skor_am <= 32){
									echo "<h4>Tinggi</h4>";
								}
								?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Hasil Analisis Test Emotional Quotient</h4></div>
				<div class="panel-body">
					<table class="table table-bordered table-stripped">
						<tr>
							<td style="text-align: center;"><h4>Adversity Quotient (Daya Juang)</h4></td>
							<td style="text-align: center; background-color: #B8400D; color: white;">
								<?php
								if($data_eq->skor_aq < 7){
									echo "<h4>Rendah</h4>";
								}elseif($data_eq->skor_aq <= 11){
									echo "<h4>Rata-Rata Bawah</h4>";
								}elseif($data_eq->skor_aq <= 21){
									echo "<h4>Rata-Rata</h4>";
								}elseif($data_eq->skor_aq <= 26){
									echo "<h4>Rata-Rata Atas</h4>";
								}elseif($data_eq->skor_aq <= 32){
									echo "<h4>Tinggi</h4>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $analisis_aq;?></td>
						</tr>
						<tr>
							<td style="text-align: center;"><h4>Emotional Quotient (Kecerdasan Emosi)</h4></td>
							<td style="text-align: center; background-color: #B8400D; color: white;">
								<?php
								if($data_eq->skor_eq < 7){
									echo "<h4>Rendah</h4>";
								}elseif($data_eq->skor_eq <= 11){
									echo "<h4>Rata-Rata Bawah</h4>";
								}elseif($data_eq->skor_eq <= 21){
									echo "<h4>Rata-Rata</h4>";
								}elseif($data_eq->skor_eq <= 26){
									echo "<h4>Rata-Rata Atas</h4>";
								}elseif($data_eq->skor_eq <= 32){
									echo "<h4>Tinggi</h4>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $analisis_eq;?></td>
						</tr>
						<tr>
							<td style="text-align: center;"><h4>Achievement Motivation (Motivasi Berprestasi)</h4></td>
							<td style="text-align: center; background-color: #B8400D; color: white;">
								<?php
								if($data_eq->skor_am < 7){
									echo "<h4>Rendah</h4>";
								}elseif($data_eq->skor_am <= 11){
									echo "<h4>Rata-Rata Bawah</h4>";
								}elseif($data_eq->skor_am <= 21){
									echo "<h4>Rata-Rata</h4>";
								}elseif($data_eq->skor_am <= 26){
									echo "<h4>Rata-Rata Atas</h4>";
								}elseif($data_eq->skor_am <= 32){
									echo "<h4>Tinggi</h4>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $analisis_am;?></td>
						</tr>
					</table>
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