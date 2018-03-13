
								<table class="table table-hover" style="margin-top:20px;">
									<thead>
										<tr>
											<th class="text-center">No.</th>
											<th class="text-center">Nama Profil Tes</th>
											<?php	if($this->session->userdata('idcabang') == 0){ ?>
											<th class="text-center">Kategori</th>
											<? } ?>
											<th class="text-center">Jenjang/Kelas</th>
											<?php	if($this->session->userdata('idcabang') == 0){ ?>
											<th class="text-center">Operasi</th>
											<? } else { ?>
											<th class="text-center">Status</th>
											<? } ?>
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
													<a href="javascript:void(0);" onclick="$('.row<?=$item->id_profil_master?>').toggle();" title="Lihat Kategori" style="text-decoration:none;"><?php echo $item->nama_profil;?> <i class="fa fa-search"></i></a><br>
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
												<?php	if($this->session->userdata('idcabang') == 0){ ?>
												<td class="text-center">
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/tambah/<?php echo $item->id_profil_master;?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-plus-sign"></i></a>
												</td>
												<? } ?>
												<td><?php echo $item->alias_kelas;?></td>
												<?php	if($this->session->userdata('idcabang') == 0){ ?>
												<td class="text-center">
													<div class="button-group">
														<a href="<?php echo base_url("pg_admin/diagnosticmaster/editprofil/".$item->id_profil_master);?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
														<?php if($item->status == 0){ ?>
														<a href="<?php echo base_url("pg_admin/diagnosticmaster/aktifkanprofil/".$item->id_profil_master);?>" class="btn btn-primary btn-xs" title="Aktifkan"><i class="glyphicon glyphicon-off"></i></a>
														<?php } else { ?>
														<a href="<?php echo base_url("pg_admin/diagnosticmaster/nonaktifkanprofil/".$item->id_profil_master);?>" class="btn btn-info btn-xs" title="Nonaktifkan"><i class="glyphicon glyphicon-off"></i></a>
														<?php } ?>														
														<?php
															if($this->session->userdata('level') == "superadmin"){
														?>
														<a href="<?php echo base_url('pg_admin/diagnosticmaster/hapus_profil/'.$item->id_profil_master);?>" class="btn btn-danger btn-xs" title="hapus" onclick="return confirm('Dengan menghapus profil <?php echo $item->nama_profil;?> semua data kategori, penilaian dan statistik siswa akan ikut terhapus dan tidak dapat diulang kembali. Lanjutkan?')"><i class="glyphicon glyphicon-remove"></i></a>
														<?php
														}
														?>
													</div>
												</td>
												<? } else { ?>
												<td class="text-center"><?= $item->status == 1 ? 'Aktif' : 'Menunggu Approval' ?></td>
												<? } ?>
											</tr>
											<!--EQ TEST-->
											<tr class="row<?=$item->id_profil_master?>" style="display:none;">
												<td></td>
												<td><i>Psychology Potential</i></td>
												<td colspan="2" align="center">
													<span class="label label-default">Waktu: 15 menit</span>&nbsp;
													<span class="label label-default">Jumlah Soal: <?= $jmleq ?></span>&nbsp;
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/daftar_soal_eq" title="Lihat Soal" target="_blank"><span class="label label-info">Lihat Soal</span></a>&nbsp;
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/cetak_soal_eq" title="Cetak Soal" target="_blank"><span class="label label-info">Cetak Soal</span></a>&nbsp;
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/cetak_kunci_eq" title="Cetak Kunci Jawaban" target="_blank"><span class="label label-info">Cetak Kunci Jawaban</span></a>&nbsp;
												</td>
												<?php	if($this->session->userdata('idcabang') == 0){ ?>
												<td>&nbsp;</td>
												<? } ?>
											</tr>
											<!--LS TEST-->
											<tr class="row<?=$item->id_profil_master?>" style="display:none;">
												<td></td>
												<td><i>Learning Style</i></td>
												<td colspan="2" align="center">
													<span class="label label-default">Waktu: 30 menit</span>&nbsp;
													<span class="label label-default">Jumlah Soal: <?= $jmlls ?></span>&nbsp;
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/daftar_soal_ls" title="Lihat Soal" target="_blank"><span class="label label-info">Lihat Soal</span></a>&nbsp;
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/cetak_soal_ls" title="Cetak Soal" target="_blank"><span class="label label-info">Cetak Soal</span></a>&nbsp;
													<a href="<?=base_url()?>pg_admin/diagnosticmaster/cetak_kunci_ls" title="Cetak Kunci Jawaban" target="_blank"><span class="label label-info">Cetak Kunci Jawaban</span></a>&nbsp;
												</td>
												<?php	if($this->session->userdata('idcabang') == 0){ ?>
												<td>&nbsp;</td>
												<? } ?>
											</tr>
											<!--DG TEST-->
											<?php
												foreach($table_kategori as $kategori){
											?>
												<tr class="row<?=$item->id_profil_master?>" style="display:none;">
													<td></td>
													<td><i><?php echo $kategori->nama_kategori;?></i></td>
													<td colspan="2" align="center">
														<span class="label label-default">Waktu: <?php echo $kategori->durasi;?> menit</span>&nbsp;
														<span class="label label-default">Jumlah soal: <?php echo $kategori->jumlah_soal;?> </span>&nbsp;
														<span class="label label-default">Ketuntasan: <?php echo $kategori->ketuntasan;?> </span>&nbsp;
														<a href="<?=base_url()?>pg_admin/diagnosticmaster/daftar_soal/<?php echo $kategori->id_diagnostic;?>" title="Lihat Soal" target="_blank"><span class="label label-info">Lihat Soal</span></a>&nbsp;
														<a href="<?=base_url()?>pg_admin/diagnosticmaster/cetak_soal/<?php echo $kategori->id_diagnostic;?>" title="Cetak Soal" target="_blank"><span class="label label-info">Cetak Soal</span></a>&nbsp;
														<a href="<?=base_url()?>pg_admin/diagnosticmaster/cetak_kunci/<?php echo $kategori->id_diagnostic;?>" title="Cetak Kunci Jawaban" target="_blank"><span class="label label-info">Cetak Kunci Jawaban</span></a>&nbsp;
														<?php	if($this->session->userdata('idcabang') == 0){ ?>
														<?php
															if($kategori->status == '0'){
																echo ' <a href="'.base_url().'pg_admin/diagnosticmaster/aktifkan/'.$kategori->id_diagnostic.'"><span class="label label-default">Non Aktif</span></a>';
															}else{
																echo ' <a href="'.base_url().'pg_admin/diagnosticmaster/nonaktif/'.$kategori->id_diagnostic.'"><span class="label label-primary">Aktif</span></a>';
															}
														?>
														<? } ?>
													</td>
													<?php	if($this->session->userdata('idcabang') == 0){ ?>
													<td class="text-center">
														<a href="<?=base_url()?>pg_admin/diagnosticmaster/edit/<?php echo $kategori->id_diagnostic;?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
														<?php	if($this->session->userdata('level') == "superadmin"){ ?>
														<a href="<?=base_url()?>pg_admin/diagnosticmaster/hapus/<?php echo $kategori->id_diagnostic;?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('apakah anda yakin untuk menghapus diagnostic test <?php echo $kategori->nama_kategori;?>?')"><i class="glyphicon glyphicon-remove"></i></a>
														<? } ?>
													</td>
													<? } ?>
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
