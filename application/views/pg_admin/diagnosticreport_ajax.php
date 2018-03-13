
								<table class="table table-hover" style="margin-top:20px;">
									<thead>
										<tr>
											<th class="text-center">No.</th>
											<th class="text-center">Nama Profil Tes</th>
											<th class="text-center">Tanggal</th>
											<th class="text-center">Cabang / Kode Aktifasi</th>
											<th class="text-center">Sekolah / Kelas</th>
											<th class="text-center">Kode Profil</th>
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
												<td><?php echo $no++;?></td>
												<td>
													<?
													$table_kategori = $this->model_agcu->fetch_kategori($item->id_profil_master);
													if ($table_kategori != NULL){
													?>
													<a href="javascript:void(0);" onclick="$('.row<?=$item->id_profil?>').toggle();" title="Lihat Kategori" style="text-decoration:none;"><?php echo $item->nama_profil;?> <i class="fa fa-search"></i></a><br>
													<? } else { ?>
													<?php echo $item->nama_profil;?><br>
													<? } ?>
													<?php
														if($item->status == 0){
															echo 'Status : <span style="color:red;">Tidak Aktif</span>';
														}elseif($item->status == 1){
															echo 'Status : <span style="color:blue;">Aktif';
														}
													?>
												</td>
												<td class="text-center">
													<?php echo date('d-m-Y', strtotime($item->tgl_acara));?> <?php echo $item->jam_acara;?>
													<? if ($item->tgl_acara != $item->tgl_acara_akhir){ ?>
													<? if ($item->tgl_acara_akhir != ''){ ?>
													<br>s/d<br><?php echo date('d-m-Y', strtotime($item->tgl_acara_akhir));?> <?php echo $item->jam_acara_akhir;?>
													<? } ?>
													<? if ($item->tgl_acara == $item->tgl_acara_akhir && $item->jam_acara != $item->jam_acara_akhir){ ?>
													s/d <?php echo $item->jam_acara_akhir;?>
													<? } ?>
													<? } ?>
												</td>
												<td><?php echo $item->nama_cabang;?><br>(<?php echo $item->kode;?>)</td>
												<td><?= $item->nama_sekolah != '' ? $item->nama_sekolah.'<br>' : '' ?><?php echo $item->alias_kelas;?></td>
												<td class="text-center"><?= $item->id_profil_master > 0 ? $item->kode_profil : '-' ?></td>
												<td class="text-center">
													<? if($item->status == 1){ ?>
													<div class="button-group">
														<a href="<?php echo base_url("pg_admin/diagnosticreport/peserta/".$item->id_profil);?>" class="btn btn-primary btn-xs" title="Lihat Daftar Peserta"><i class="fa fa-users"></i> Lihat Peserta</a>
													</div>
													<? } ?>
												 </td>
											</tr>
											<!--EQ TEST-->
											<tr class="row<?=$item->id_profil?>" style="display:none;">
												<td></td>
												<td><i>Psychology Potential</i></td>
												<td colspan="5" class="text-center">
													<span class="label label-default">Waktu: 15 menit</span>&nbsp;
													<span class="label label-default">Jumlah Soal: <?= $jmleq ?></span>&nbsp;
												</td>
											</tr>
											<!--LS TEST-->
											<tr class="row<?=$item->id_profil?>" style="display:none;">
												<td></td>
												<td><i>Learning Style</i></td>
												<td colspan="5" class="text-center">
													<span class="label label-default">Waktu: 30 menit</span>&nbsp;
													<span class="label label-default">Jumlah Soal: <?= $jmlls ?></span>&nbsp;
												</td>
											</tr>
											<!--DG TEST-->
											<?php
												foreach($table_kategori as $kategori){
											?>
												<tr class="row<?=$item->id_profil?>" style="display:none;">
													<td></td>
													<td><i><?php echo $kategori->nama_kategori;?></i></td>
													<td colspan="5" class="text-center">
														<span class="label label-default">waktu: <?php echo $kategori->durasi;?> menit</span>&nbsp;
														<span class="label label-default">jumlah soal: <?php echo $kategori->jumlah_soal;?> </span>&nbsp;
														<span class="label label-default">ketuntasan: <?php echo $kategori->ketuntasan;?> </span>&nbsp;
													</td>
												</tr>
											<?php
												}
											?>
											<?php
											}
											?>
									</tbody>
								</table>
								<hr style="margin: 0px;">
								<?= $paginator; ?>
