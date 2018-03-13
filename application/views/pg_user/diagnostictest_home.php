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
            <h2 class="mapel-title">Academic General Check Up</h2>
        </div>
    </header>
	
<!-- MULAI KONTEN HOME AGCU -->
<div class="container" style="margin-top: 50px;">
	<div class="row">
		<div class="col-lg-12">
			<a href="hasil_diagnostic" class="btn btn-danger">Lihat Statistik Nilai</a>
			<p>&nbsp;
		</div>
		<?php foreach($kategoridiagnostic as $diagnostic){
		?>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="panel panel-default">
				  <div class="panel-heading">
				  </div>
				  <div class="panel-body" >
					<?php echo $diagnostic->alias_kelas; ?>
					<h3><?php echo $diagnostic->nama_kategori; ?></h3>
					<p>Durasi : <?php echo $diagnostic->durasi ;?> Menit
					
					<p>Jumlah : 
					<?php
						foreach($datasoal as $soal){
							if($soal->id_diagnostic == $diagnostic->id_diagnostic){
								echo $soal->jumlah;
							}
						}
					?> Soal
					
					<p>Ketuntasan : <?php echo $diagnostic->ketuntasan ;?>%
					
				  </div>
				  <div class="panel-footer" style="text-align: center;"><a href="mulaidiagnostic/<?php echo $diagnostic->id_diagnostic;?>" class="btn btn-danger">Mulai Test</a></div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
<!-- END KONTEN HOME AGCU -->
    
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