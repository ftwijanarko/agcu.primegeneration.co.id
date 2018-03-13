		<?php include('header_global.php');?>
		<?php include('navigation_global_test.php');?>
    <div class="b-dot page-body latihan" style="margin-top:70px;min-height:280px;">
			<div>
			
				<h2>AGCU DIAGNOSTIC TEST RESULT</h2>

				<div class="deskripsi">

					<p>Skor Kamu:</p>

					<p class="score"><?php echo $skor ? $skor : 0?></p>
					
					<?php
						if($tuntas == 1){
					?>
					<p>Bagus! Skor kamu sudah di atas ketuntasan. Kamu dapat mencoba lagi, atau mengulang materi untuk meningkatkan pemahaman kamu.</p>
					<?php
						}else{
					?>
					<p>Skor kamu masih dibawah ketuntasan. Kamu dapat mencoba lagi, atau mengulang materi untuk meningkatkan pemahaman kamu.</p>
					<?php
						}
					?>

					<div class="buttons" style="margin-top:20px;">
						<a href="<?php echo base_url().'agcutest'; ?>" class="btn btn-success btn-lg">Kembali Belajar!</a>
					</div>
				</div>
		
			</div>
		</div>
		<!-- /Page Body -->

		<!-- Footer -->

		<?php include('footer_global.php'); ?>

		<!-- /Footer -->

		

