<?php include('header_global.php');?>

	<div class="container body" style="padding:20px;">
			<div class="b-dot stat-wrapper">
					<img src="<?= ASSETS_IMAGE ?>/logo.png" style="width:200px;">
					<h2 class="header-red">DATA TEST</h2>
					<div class="row infotgl">
						<div class="col-md-2">Nama Test</div>
						<div class="col-md-3">: <span style="margin-left:20px;">Learning Style Test</span></div>
						<div class="col-md-2"></div>
						<div class="clearfix" style="margin-top:15px;"></div>
						<div class="col-md-2">Lama Pengerjaan</div>
						<div class="col-md-3">: <span style="margin-left:20px;">30 Menit</span></div>
						<div class="col-md-2"></div>
						<div class="col-md-2">Jumlah Soal</div>
						<div class="col-md-3">: <span style="margin-left:20px;"><?= $jmlls ?> Soal</span></div>
					</div>
					<div class="clearfix" style="margin-top:20px;"></div>
					<h2 class="header-red" style="text-align:left;">Jawablah Pertanyaan dibawah ini!</h2>
					<div class="clearfix" style="margin-top:20px;"></div>
					<?php
						$x = 1;
						foreach($datasoal as $soal){
					?>
							<table style="font-size:16px;">
								<tr>
									<td style="vertical-align:top;padding:5px 10px;"><?= $x ?>.</td>
									<td style="vertical-align:top;padding:5px 10px 5px 10px;"><?= $soal->soal ?></td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_a ? '<span style="float:left;margin-right:5px;font-size:16px;">A.</span>'.$soal->jawab_a : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_b ? '<span style="float:left;margin-right:5px;font-size:16px;">B.</span>'.$soal->jawab_b : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_c ? '<span style="float:left;margin-right:5px;font-size:16px;">C.</span>'.$soal->jawab_c : ''?>
									</td>
								</tr>
							</table>							
							<div class="clearfix" style="margin-top:10px;"></div>
					<?php
							$x++;
						}
					?>
			</div>
	</div>

</body>
</html>