
								<table class="table table-bordered table-hover" style="margin-top:20px;">
									<thead>
										<tr>
											<th class="text-center" width="5%">No.</th>
											<th class="text-center">Nama Siswa</th>
											<th class="text-center" width="15%">Psycological Test</th>
											<th class="text-center" width="15%">Learning Style Test</th>
											<th class="text-center" width="15%">Diagnostic Test</th>
											<th class="text-center">Operasi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no = $no; 
											foreach ($table_data as $item) 
											{
											?>
											<tr>
												<td align="right"><?php echo $no++;?></td>
												<td><?php echo $item->nama_siswa;?></td>
												<td class="text-center">
												<?
												if ($item->kelas > 5){
													$eq = $this->model_agcu->cek_eq($item->id_siswa, $item->id_profil_master);
													if ($eq > 0){
														$heq = 1;
														echo '<span class="badge"><i class="fa fa-check"></i></span>';
													} else {
														$heq = 0;
														echo '<span class="badge"><i class="fa fa-close"></i></span>';
													}													
												} else {
													echo '-';
												}
												?>
												</td>
												<td class="text-center">
												<?
												$ls = $this->model_agcu->cek_ls($item->id_siswa, $item->id_profil_master);
												if ($ls > 0){
													$hls = 1;
													echo '<span class="badge"><i class="fa fa-check"></i></span>';
												} else {
													$hls = 0;
													echo '<span class="badge"><i class="fa fa-close"></i></span>';
												}
												?>
												</td>
												<td class="text-center">
												<?
												$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($item->kelas,$item->id_profil_master);
												$j = 0;
												$k = 0;
												foreach($kategoridiagnostic as $diagnostic){
													$dg = $this->model_agcu->cek_diagnostic_siswa($item->id_siswa, $diagnostic->id_diagnostic);
													if ($dg > 0){
														$j = $j + 1;
													} else {
														$j = $j + 0;
													}
													$k = $k + 1;
												} 
												if ($k > 0 && $k == $j){
													$hdg = 1;
													echo '<span class="badge"><i class="fa fa-check"></i></span>';
												} else {
													$hdg = 0;
													echo '<span class="badge"><i class="fa fa-close"></i></span>';
												}
												?>
												</td>
												<td class="text-center">
													<div class="button-group">
													<? if (($hdg == 1 && $heq == 1 && $hls == 1 && $item->kelas > 5) || ($hdg == 1 && $hls == 1 && $item->kelas < 6)){ ?>
														<a href="<?php echo base_url("pg_admin/diagnosticreport/view/".$item->id_siswa."/".$item->id_profil."/screen");?>" class="btn btn-primary btn-xs" title="Lihat Report" target="_blank"><i class="fa fa-eye"></i></a>
														<a href="<?php echo base_url("pg_admin/diagnosticreport/view/".$item->id_siswa."/".$item->id_profil."/print");?>" class="btn btn-warning btn-xs" title="Cetak Report" target="_blank"><i class="fa fa-print"></i></a>
													<? } ?>
													</div>
												</td>
											</tr>
											<?
											}
											?>
									</tbody>
								</table>
								<hr style="margin: 0px;">
								<?= $paginator; ?>
