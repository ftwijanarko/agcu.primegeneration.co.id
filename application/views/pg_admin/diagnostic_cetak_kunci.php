<?php include('header_global.php');?>

	<div class="container body" style="padding:20px;">
			<div class="b-dot stat-wrapper">
					<img src="<?= ASSETS_IMAGE ?>/logo.png" style="width:200px;">
					<h2 class="header-red">DATA TEST</h2>
					<div class="row infotgl">
						<div class="col-md-2">Mata Pelajaran</div>
						<div class="col-md-4">: <span style="margin-left:20px;"><?= $datatest->nama_mapel ?></span></div>
						<div class="col-md-1"></div>
						<div class="col-md-2">Kelas</div>
						<div class="col-md-3">: <span style="margin-left:20px;"><?= $datatest->alias_kelas ?></span></div>
						<div class="clearfix" style="margin-top:15px;"></div>
						<div class="col-md-2">Lama Pengerjaan</div>
						<div class="col-md-4">: <span style="margin-left:20px;"><?= $datatest->durasi ?> Menit</span></div>
						<div class="col-md-1"></div>
						<div class="col-md-2">Jumlah Soal</div>
						<div class="col-md-3">: <span style="margin-left:20px;"><?= $datatest->jumlah_soal ?> Soal</span></div>
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
									<th style="text-align:center;">Kunci Jawaban</th>
								</tr>
								<?php
									$x = 1;
									foreach($datasoal as $soal){
								?>
											<tr>
												<td align="center"><?= $x ?></td>
												<td align="center"><?= $soal->kunci == 1 ? 'A' : ($soal->kunci == 2 ? 'B' : ($soal->kunci == 3 ? 'C' : ($soal->kunci == 4 ? 'D' : 'E'))) ;?></td>
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