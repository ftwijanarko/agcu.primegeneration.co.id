<?php include('header_global.php');?>

	<div class="container body" style="padding:20px;">
			<div class="b-dot stat-wrapper">
					<img src="<?= ASSETS_IMAGE ?>/logo.png" style="width:200px;">
					<h2 class="header-red">DATA TEST</h2>
					<div class="row infotgl">
						<div class="col-md-2">Nama Test</div>
						<div class="col-md-3">: <span style="margin-left:20px;">Psychology Potential Test</span></div>
						<div class="col-md-2"></div>
						<div class="clearfix" style="margin-top:15px;"></div>
						<div class="col-md-2">Lama Pengerjaan</div>
						<div class="col-md-3">: <span style="margin-left:20px;">15 Menit</span></div>
						<div class="col-md-2"></div>
						<div class="col-md-2">Jumlah Soal</div>
						<div class="col-md-3">: <span style="margin-left:20px;"><?= $jmleq ?> Soal</span></div>
					</div>
					<div class="clearfix" style="margin-top:20px;"></div>
					<h2 class="header-red">Kunci Jawaban</h2>
					<div class="clearfix" style="margin-top:20px;"></div>
					<div class="row infotgl">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<table class="table table-bordered" style="font-size:16px;">
								<tr>
									<th style="text-align:center;">Soal No.</th>
									<th style="text-align:center;">Skor Jawaban A</th>
									<th style="text-align:center;">Skor Jawaban B</th>
									<th style="text-align:center;">Skor Jawaban C</th>
									<th style="text-align:center;">Skor Jawaban D</th>
								</tr>
								<?php
									$x = 1;
									foreach($datasoal as $soal){
								?>
											<tr>
												<td align="center"><?= $x ?></td>
												<td align="center"><?= $soal->skor_a != '' ? $soal->skor_a : '' ?></td>
												<td align="center"><?= $soal->skor_b != '' ? $soal->skor_b : '' ?></td>
												<td align="center"><?= $soal->skor_c != '' ? $soal->skor_c : '' ?></td>
												<td align="center"><?= $soal->skor_d != '' ? $soal->skor_d : '' ?></td>
											</tr>
								<?php
										$x++;
									}
								?>
							</table>	
						</div>
						<div class="col-md-2"></div>
					</div>
			</div>
	</div>

</body>
</html>