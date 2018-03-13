<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

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
                <h4 class="title">Update AGCU Test</h4>
              </div>
              <div class="content">
								<form method="post" action="<?php echo base_url("pg_admin/diagnostictest/proses_edit");?>" enctype="multipart/form-data">
									<input type="hidden" name="idprofil" value="<?php echo $profil->id_profil;?>" />
									<div class="row">
										<div class="col-lg-12">
											<div class="col-md-6 col-lg-6" style="padding-left: 6px;">
												Nama Test
												<input type="text" class="form-control" name="nama" value="<?php echo $profil->nama_profil;?>" required/>
											</div>
											<div class="col-md-6 col-lg-6">
												Penyelenggara
												<select data-placeholder="Pilih Cabang Penyelenggara" name="penyelenggara" class="form-control chosen-select" style="width: 100%;" tabindex="2" required="required">
													<option value=""></option>
													<?php 
													foreach ($select_cabang as $item) { 
														if ($this->session->userdata('idcabang') > 0){
															if ($this->session->userdata('idcabang') == $item->id_cabang){

													?>
													<option <?php echo set_select('penyelenggara', $item->id_cabang, (!isset($profil->penyelenggara) ? FALSE : ($profil->penyelenggara == $item->id_cabang ? TRUE : FALSE)) );?>
														value="<?php echo $item->id_cabang ?>" > <?php echo $item->nama_cabang ?>
													</option>
													<?php 
															}
														} else{
													?>
													<option <?php echo set_select('penyelenggara', $item->id_cabang, (!isset($profil->penyelenggara) ? FALSE : ($profil->penyelenggara == $item->id_cabang ? TRUE : FALSE)) );?>
														value="<?php echo $item->id_cabang ?>" > <?php echo $item->nama_cabang ?>
													</option>
													<?php
														}
													} 
													?>
												</select>
											</div>
											<div class="col-md-4 col-lg-4">
												Tanggal Awal
												<div class="input-group">
													<input type="text" class="form-control" name="tanggal" id="datepicker" value="<?php echo $profil->tgl_acara;?>" placeholder="YYYY-MM-DD" required/>
													<a href="javascript:void(0);" class="input-group-addon"><i class="fa fa-calendar"></i></a>
												</div>
											</div>
											<div class="col-md-2 col-lg-2">
												Jam Awal
												<div class="input-group">
													<input type="text" class="form-control" name="jam" value="<?php echo $profil->jam_acara;?>" placeholder="HH:MM" required/>
													<a href="javascript:void(0);" class="input-group-addon"><i class="fa fa-clock-o"></i></a>
												</div>
											</div>
											<div class="col-md-4 col-lg-4">
												Tanggal Akhir
												<div class="input-group">
													<input type="text" class="form-control" name="tanggal1" id="datepicker1" value="<?php echo $profil->tgl_acara_akhir;?>" placeholder="YYYY-MM-DD" required/>
													<a href="javascript:void(0);" class="input-group-addon"><i class="fa fa-calendar"></i></a>
												</div>
											</div>
											<div class="col-md-2 col-lg-2">
												Jam Akhir
												<div class="input-group">
													<input type="text" class="form-control" name="jam1" value="<?php echo $profil->jam_acara_akhir;?>" placeholder="HH:MM" required/>
													<a href="javascript:void(0);" class="input-group-addon"><i class="fa fa-clock-o"></i></a>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												Sekolah
												<select data-placeholder="Pilih Sekolah" name="sekolah" class="form-control chosen-select" style="width: 100%;" tabindex="2" required>
													<?php 
													foreach ($select_sekolah as $item) { ?>
													<option <?php echo set_select('sekolah', $item->id_sekolah, (!isset($profil->sekolah) ? FALSE : ($profil->sekolah == $item->id_sekolah ? TRUE : FALSE)) );?>
														value="<?php echo $item->id_sekolah ?>" > <?php echo $item->nama_sekolah ?>
													</option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-6 col-lg-6">
												Kelas
												<select data-placeholder="Pilih Kelas" id="kelas" name="kelas" class="form-control chosen-select" style="width: 100%;" tabindex="2" required="required">
													<?php 
													foreach ($select_options as $item) { ?>
													<option <?php echo set_select('kelas', $item->id_kelas, (!isset($profil->id_kelas) ? FALSE : ($profil->id_kelas == $item->id_kelas ? TRUE : FALSE)) );?>
														value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
													</option>
													<?php } ?>
												</select>
											</div>
											<?php
												if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator" || $this->session->userdata('level') == "admin")){
											?>
											<div class="col-md-6 col-lg-6">
												Profil AGCU Test
												<select data-placeholder="Pilih Profil AGCU Test" id="profil" name="profil" class="form-control chosen-select" style="width: 100%;" tabindex="2">
													<option value="0">Pilih Profil AGCU Test</option>
													<?php 
													foreach ($select_profil as $item) { ?>
													<option <?php echo set_select('profil', $item->id_profil_master, (!isset($profil->id_profil_master) ? FALSE : ($profil->id_profil_master == $item->id_profil_master ? TRUE : FALSE)) );?>
														value="<?php echo $item->id_profil_master ?>" > <?php echo $item->nama_profil ?> (<?php echo $item->kode ?>)
													</option>
													<?php } ?>
												</select>
											</div>
											<? 
												} 
											?>
											<div class="col-md-6 col-lg-6">
												Biaya
												<input type="text" class="form-control" name="biaya" value="<?php echo $profil->biaya;?>"/>
											</div>
											<div class="col-md-6 col-lg-6">
												Keterangan
												<input type="text" class="form-control" name="keterangan" value=""/>
											</div>						
											<div class="col-md-6 col-lg-6">
												<input type="hidden" class="form-control" name="tipe" value="3"/>
												<div class="col-lg-12">
												Banner
												<input type="file" name="banner" />
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<hr>
												<input type="submit" value="Update Profil" name="form_submit" class="btn btn-primary"/>
												<a href="javascript:history.go(-1);" type="button" class="btn btn-default pull-right">Batal</a>
											</div>
										</div>
									</div>
								</form>
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


<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker1").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
});
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

<script>
	$(document).ready(function() {	
	
			$('#kelas').change(function() {
					var urlLink = "<?php echo base_url().'pg_admin/diagnostictest/pilihprofil/'; ?>" + $('#kelas').val();
					$.ajax({
						url:urlLink,
						success:function(data) { 
							$("#profil").html(data);
							$('#profil').val('').trigger('chosen:updated');
						}
					});															
			});
			
	});
</script>				

</html>
