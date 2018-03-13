<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<style>
	.header-red {
			background: #f5f5f5 !important;
			color: #000000 !important;
			padding: 5px !important;
			border-bottom: solid 3px #dc1826;
			margin-bottom: 0px !important;
	}
	.header-dpurple {
			background: #5b8d94 !important;
			color: #ffffff !important;
			padding: 5px !important;
			border-bottom: solid 3px #33cc33;
			margin-bottom: 0px !important;
	}	
</style>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
					<div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title" style="float:left;">Input Hasil AGCU Offline</h4>
								<a href="<?php echo base_url("pg_admin/diagnosticreport/peserta/".$profildata->id_profil);?>" class="btn btn-primary btn-xs pull-right" title="Kembali ke Tabel Hasil" style="text-decoration:none;padding:5px;"><i class="fa fa-book"></i> Kembali ke Tabel Hasil</a>
								<div class="clearfix" style="margin-top:20px;"></div>
              </div>
              <div class="content">

								<div class="col-md-12 col-lg-12 well" style="line-height:28px; padding: 10px 19px;margin-bottom:0px;">
									<div class="row">
										<div class="col-md-2">Nama Profil Tes</div>
										<div class="col-md-4">:&nbsp;&nbsp;&nbsp;<?= $profildata->nama_profil ?></div>
										<div class="col-md-2">Tanggal & Jam</div>
										<div class="col-md-4">:&nbsp;&nbsp;&nbsp;<?= date('d-m-Y', strtotime($profildata->tgl_acara)) ?> <?= date('H:i', strtotime($profildata->jam_acara)) ?></div>
									</div>
									<div class="row">
										<div class="col-md-2">Penyelenggara</div>
										<div class="col-md-4">:&nbsp;&nbsp;&nbsp;<?= $profildata->nama_cabang ?></div>
										<div class="col-md-2">Sekolah/Kelas</div>
										<div class="col-md-4">:&nbsp;&nbsp;&nbsp;<?= $profildata->nama_sekolah ?> (Kelas <?= $profildata->tingkatan_kelas ?>)</div>
									</div>
								</div>
								<div class="clearfix" style="margin-top:0px;"></div>
								<div id="containerajax">
								
									<!--Diagnostic Test-->
									<h5 class="header-dpurple">Diagnostic Test</h5>
									<?
									$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($profildata->id_kelas,$profildata->id_profil_master);
									foreach($kategoridiagnostic as $diagnostic){
									?>
									<form method="post" action="<?= base_url('pg_admin/diagnosticreport/simpan_dg_offline') ?>" enctype="multipart/form-data">
										<input type="hidden" name="kelas_dg" value="<?= $profildata->id_kelas ?>">
										<input type="hidden" name="profil_dg" value="<?= $profildata->id_profil_master ?>">
										<input type="hidden" name="profil_id" value="<?= $profildata->id_profil ?>">
										<input type="hidden" name="kategori_dg" value="<?= $diagnostic->id_diagnostic ?>">
										<div class="table-responsive" style="overflow:scroll;min-height:300px;margin-top:10px;">
											<h5 class="header-red" style="margin-top:0px;"><?= $diagnostic->nama_kategori; ?></h5>
											<table class="table table-bordered table-hover" style="margin-top:10px;">
												<thead>
													<tr>
														<th class="text-center" width="5%" rowspan="2">No.</th>
														<th class="text-center" rowspan="2" width="15%" style="white-space: nowrap;">Nama Siswa</th>
														<th colspan="<?= $diagnostic->jumlah_soal ?>">Jawaban No.</th>
													</tr>
													<tr>
														<? for($i=1;$i<=$diagnostic->jumlah_soal;$i++){ ?>
														<th class="text-center"><?= $i ?></th>
														<? } ?>
													</tr>
												</thead>
												<tbody>
													<?php
														$no = 1; 
														foreach ($table_data as $item) {
														?>
														<tr>
															<td align="right"><?php echo $no++;?></td>
															<td style="width:100px;white-space: nowrap;"><?php echo $item->nama_siswa;?></td>
															<input type="hidden" name="idsiswa_<?= $item->id_siswa ?>" value="<?= $item->id_siswa ?>">
															<? 
																$sdg = $this->model_agcu->fetch_soal_by_diagnostic($diagnostic->id_diagnostic);
																$hjdg = $this->model_agcu->cek_jawaban_dg($item->id_siswa, $diagnostic->id_diagnostic);
																$jd = '';
																foreach ($sdg as $sd) { 
																	if ($hjdg != NULL){
																		foreach ($hjdg as $h) {
																			if ($h->id_soal == $sd->id_banksoal){
																				$jd = $h->jawaban;
																			}
																		}
																	} else {
																		$jd = '';
																	}
															?>
															<td class="text-center">
																<div style="width: 36px;display: inline-block;">
																	<input type="hidden" name="soaldg_<?= $item->id_siswa ?>_<?= $diagnostic->id_diagnostic ?>_<?= $sd->id_banksoal ?>" value="<?= $sd->id_banksoal ?>">
																	<select name="jawabdg_<?= $item->id_siswa?>_<?= $diagnostic->id_diagnostic ?>_<?= $sd->id_banksoal ?>" style="width: 100%;">
																		<option value="">-</option>
																		<option value="1" <?= $jd == 1 ? 'selected' : '' ?>>A</option>
																		<option value="2" <?= $jd == 2 ? 'selected' : '' ?>>B</option>
																		<option value="3" <?= $jd == 3 ? 'selected' : '' ?>>C</option>
																		<option value="4" <?= $jd == 4 ? 'selected' : '' ?>>D</option>
																		<option value="5" <?= $jd == 5 ? 'selected' : '' ?>>E</option>
																	</select>
																</div>
															</td>
															<?
																} 
															?>
														</tr>
														<?
														}
														?>
												</tbody>
											</table>
										</div>
										<div class="clearfix" style="margin-top:10px;"></div>
										<button type="submit" class="btn btn-success">Simpan Test Diagnostic <?= $diagnostic->nama_kategori; ?></button>
										<div class="clearfix"></div>
									</form>
									<?
									} 
									?>
									<hr style="margin: 10px 0px;">
									<!--Diagnostic Test-->

									<? if ($profildata->id_kelas > 5){ ?>
									<!--Psycology Potential Test-->
									<h5 class="header-dpurple">Psycology Potential Test</h5>
									<form method="post" action="<?= base_url('pg_admin/diagnosticreport/simpan_eq_offline') ?>" enctype="multipart/form-data">
										<input type="hidden" name="kelas_eq" value="<?= $profildata->id_kelas ?>">
										<input type="hidden" name="profil_eq" value="<?= $profildata->id_profil_master ?>">
										<input type="hidden" name="profil_id" value="<?= $profildata->id_profil ?>">
										<div class="table-responsive mb20" style="overflow:scroll;min-height:300px;margin-top:10px;">
											<table class="table table-bordered table-hover">
												<thead>
													<? $jeq = $this->model_agcu->count_eq(); ?>
													<tr>
														<th class="text-center" width="5%" rowspan="2">No.</th>
														<th class="text-center" rowspan="2" width="15%" style="white-space: nowrap;">Nama Siswa</th>
														<th colspan="<?= $jeq ?>">Jawaban No.</th>
													</tr>
													<tr>
														<? for($i=1;$i<=$jeq;$i++){ ?>
														<th class="text-center"><?= $i ?></th>
														<? } ?>
													</tr>
												</thead>
												<tbody>
													<?php
														$no = 1; 
														foreach ($table_data as $item) {
															$hjeq = $this->model_eqtest->cek_jawaban_eq($item->id_siswa, $item->id_profil_master);
														?>
														<tr>
															<td align="right"><?php echo $no++;?></td>
															<td style="white-space: nowrap;"><?php echo $item->nama_siswa;?></td>
															<? for($i=1;$i<=$jeq;$i++){ ?>
															<td class="text-center">
																<div style="width: 36px;display: inline-block;">
																	<? 
																	if ($hjeq != NULL){
																		foreach ($hjeq as $h) {
																			if ($h->no == $i){
																				$je = $h->jawaban;
																			}
																		}
																	} else {
																		$je = '';
																	}
																	?>
																	<input type="hidden" name="idsiswa_<?= $item->id_siswa ?>" value="<?= $item->id_siswa ?>">
																	<select name="eq_<?= $item->id_siswa;?>_<?= $i ?>" style="width: 100%;padding:3px;">
																		<option value="">-</option>
																		<option value="1" <?= $je == 1 ? 'selected' : '' ?>>A</option>
																		<option value="2" <?= $je == 2 ? 'selected' : '' ?>>B</option>
																		<option value="3" <?= $je == 3 ? 'selected' : '' ?>>C</option>
																		<option value="4" <?= $je == 4 ? 'selected' : '' ?>>D</option>
																	</select>
																</div>
															</td>
															<? } ?>
														</tr>
														<?
														}
														?>
												</tbody>
											</table>
										</div>
										<div class="clearfix" style="margin-top:10px;"></div>
										<button type="submit" class="btn btn-success">Simpan Psycology Potential Test</button>
										<div class="clearfix"></div>
									</form>
									<hr style="margin: 10px 0px;">
									<!--Psycology Potential Test-->
									<? } ?>

									<!--Learning Style Test-->
									<h5 class="header-dpurple">Learning Style Test</h5>
									<form method="post" action="<?= base_url('pg_admin/diagnosticreport/simpan_ls_offline') ?>" enctype="multipart/form-data">
										<input type="hidden" name="kelas_ls" value="<?= $profildata->id_kelas ?>">
										<input type="hidden" name="profil_ls" value="<?= $profildata->id_profil_master ?>">
										<input type="hidden" name="profil_id" value="<?= $profildata->id_profil ?>">
										<div class="table-responsive" style="overflow:scroll;min-height:300px;margin-top:10px;">
											<table class="table table-bordered table-hover">
												<thead>
													<? $jls = $this->model_agcu->count_ls(); ?>
													<tr>
														<th class="text-center" width="5%" rowspan="2">No.</th>
														<th class="text-center" rowspan="2" width="15%" style="white-space: nowrap;">Nama Siswa</th>
														<th colspan="<?= $jls ?>">Jawaban No.</th>
													</tr>
													<tr>
														<? for($i=1;$i<=$jls;$i++){ ?>
														<th class="text-center"><?= $i ?></th>
														<? } ?>
													</tr>
												</thead>
												<tbody>
													<?php
														$no = 1; 
														foreach ($table_data as $item) {
														?>
														<tr>
															<input type="hidden" name="idsiswa_<?= $item->id_siswa ?>" value="<?= $item->id_siswa ?>">
															<td align="right"><?php echo $no++;?></td>
															<td style="width:100px;white-space: nowrap;"><?php echo $item->nama_siswa;?></td>
															<? 
															$datasoalls = $this->model_lstest->get_lstest();
															$l = 1;
															$hjls = $this->model_lstest->cek_jawaban_ls($item->id_siswa, $item->id_profil_master);
															foreach ($datasoalls as $s) { 
																if ($hjls != NULL){
																	foreach ($hjls as $h) {
																		if ($h->no == $l){
																			$jl = $h->skor;
																		}
																	}
																} else {
																	$jl = '';
																}
															?>
															<td class="text-center">
																<div style="width: 36px;display: inline-block;">
																	<select name="jawabls_<?= $item->id_siswa;?>_<?= $l ?>" style="width: 100%;">
																		<option value="">-</option>
																		<option value="<?= $s->skor_a ?>" <?= $jl == $s->skor_a ? 'selected' : '' ?>>A</option>
																		<option value="<?= $s->skor_b ?>" <?= $jl == $s->skor_b ? 'selected' : '' ?>>B</option>
																		<? if ($l < 41){ ?>
																		<option value="<?= $s->skor_c ?>" <?= $jl == $s->skor_c && $s->skor_c != '' ? 'selected' : '' ?>>C</option>
																		<? } ?>
																	</select>
																</div>
															</td>
															<?
																$l++;
															}
															?>
														</tr>
														<?
														}
														?>
												</tbody>
											</table>
										</div>
										<div class="clearfix" style="margin-top:10px;"></div>
										<button type="submit" class="btn btn-success">Simpan Lerning Style Test</button>
										<div class="clearfix"></div>
									</form>
									<hr style="margin: 10px 0px;">
									<!--Learning Style Test-->

								</div>
								
              </div>
            </div>
          </div>
			
        </div>
      </div>
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>

</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<script type="text/javascript">
	function ajaxPage(urlLink)
	{  
		$.ajax({
			url:urlLink,
			beforeSend: function() {
				NProgress.start();
			},
			success:function(data) {
				NProgress.done(); 
				$("#containerajax").html(data)
			}
		});
		return false;
	}
</script>

<script>
	$(document).ready(function() {	
	
			$('#cari').keyup(function() {
				if ($(this).val().length > 2){
					var cari = $("#cari").val();
					var formData = {
							'cari' : cari,
					};

					var urlSearch = "<?= base_url('pg_admin/diagnostictest/tabel_ajax/') ?>";

					$.ajax({
						type:'POST',
						url:urlSearch,
						data:formData,
						beforeSend: function() {
							NProgress.start();
						},
						success:function(data) { 
							NProgress.done();
							$("#containerajax").html(data);
						}
					});
				} else {
					var cari = 0;
					var formData = {
							'cari' : cari,
					};

					var urlSearch = "<?= base_url('pg_admin/diagnostictest/tabel_ajax/') ?>";

					$.ajax({
						type:'POST',
						url:urlSearch,
						data:formData,
						beforeSend: function() {
							NProgress.start();
						},
						success:function(data) { 
							NProgress.done();
							$("#containerajax").html(data);
						}
					});
				}
			});
			
	});											
</script>				

<!-- JS Function for this Modal -->
<script type="text/javascript">
  $('#deleteRow_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var rownumber = button.data('number') // Extract info from data-* attributes
    var id = button.attr('value')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.number').text("#" + rownumber + "?")
    modal.find('input[name=hidden_row_id]').val(id)
  })
</script>

<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
</script>

</html>
