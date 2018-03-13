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
					<h2 class="header-red" style="text-align:left;">Jawablah Pertanyaan dibawah ini!</h2>
					<div class="clearfix" style="margin-top:20px;"></div>
					<?php
						$x = 1;
						foreach($datasoal as $soal){
					?>
							<table style="font-size:16px;">
								<tr>
									<td style="vertical-align:middle;padding:5px 10px;"><p><?= $x ?>.</p></td>
									<td style="vertical-align:middle;padding:7px 10px 5px 10px;"><?= $soal->pertanyaan ?></td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_1 ? '<span style="float:left;margin-right:5px;font-size:16px;">A.</span>'.$soal->jawab_1 : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_2 ? '<span style="float:left;margin-right:5px;font-size:16px;">B.</span>'.$soal->jawab_2 : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_3 ? '<span style="float:left;margin-right:5px;font-size:16px;">C.</span>'.$soal->jawab_3 : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_4 ? '<span style="float:left;margin-right:5px;font-size:16px;">D.</span>'.$soal->jawab_4 : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										<?= $soal->jawab_5 ? '<span style="float:left;margin-right:5px;font-size:16px;">E.</span>'.$soal->jawab_5 : ''?>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:middle;padding:2px 10px;">
										Kunci Jawaban : <?= $soal->kunci == 1 ? 'A' : ($soal->kunci == 2 ? 'B' : ($soal->kunci == 3 ? 'C' : ($soal->kunci == 4 ? 'D' : 'E'))) ;?>
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