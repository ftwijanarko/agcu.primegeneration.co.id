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
                <h4 class="title">Tambah Profil</h4>
              </div>
              <div class="content">
			  <form method="post" action="<?php echo base_url("pg_admin/tryout/proses_edit");?>" enctype="multipart/form-data">
			  <input type="hidden" name="idprofil" value="<?php echo $profil->id_tryout;?>" />
					<div class="row">
						<div class="col-lg-12">
						<div class="col-md-4 col-lg-4" style="padding-left: 6px;">
							Nama Test
							<input type="text" class="form-control" name="nama" value="<?php echo $profil->nama_profil;?>" required/>
						</div>
						<div class="col-md-4 col-lg-4">
							Penyelenggara
							<input type="text" class="form-control" name="penyelenggara" value="<?php echo $profil->penyelenggara;?>" required/>
						</div>
						<div class="col-md-4 col-lg-4">
							Biaya Test
							<input type="text" class="form-control" name="biaya" value="<?php echo $profil->biaya;?>" required/>
						</div>
						<div class="col-md-4 col-lg-4">
							Tanggal Acara
							<input type="text" class="form-control" name="tanggal" id="datepicker" value="<?php echo $profil->tgl_acara;?>" required/>
						</div>
						<div class="col-md-4 col-lg-4">
							Jam Acara
							<input type="text" class="form-control" name="jam" value="<?php echo $profil->jam_acara;?>" required/>
						</div>
						<div class="col-md-4 col-lg-4">
							Jenjang Kelas
							<select data-placeholder="Pilih Kelas..." name="kelas" class="form-control" style="width: 100%;" tabindex="2" required="required">
							  <option value="<?php echo $profil->id_kelas;?>"><?php echo $profil->alias_kelas;?></option>
							  <?php 
							  foreach ($select_options as $item) { ?>
								<option <?php echo set_select('kelas', $item->id_kelas, (!isset($data->id_kelas) ? FALSE : ($data->kelas == $item->id_kelas ? TRUE : FALSE)) );?>
									value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
								</option>
							  <?php } ?>
							</select>
						</div>
						</div>
						
						
						<div class="col-md-6 col-lg-6">
							<div class="col-lg-12">
							Tipe Profil
							<select name="tipe" class="form-control" required>
								<?php
									if($profil->tipe == "0"){
										echo '<option value="0">Try Out Reguler</option>';
									}elseif($profil->tipe == "1"){
										echo '<option value="1">CBT Contest</option>';
									}elseif($profil->tipe == "2"){
										echo '<option value="2">PSEP Sekolah</option>';
									}elseif($profil->tipe == "3"){
										echo '<option value="3">Diagnostic AGCU</option>';
									}
								?>
								<option value="0">Try Out Reguler</option>
								<option value="1">CBT Contest</option>
								<option value="2">PSEP Sekolah</option>
								<option value="3">Diagnostic AGCU</option>
							</select>
							</div>
							
							<div class="col-lg-12">
							Banner Test
							<input type="file" name="banner" />
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							Keterangan
							<textarea name="keterangan" class="form-control" required></textarea>
						</div>
						<div class="col-md-4 col-lg-4" style="display: none;">
							
						</div>
						<div class="col-md-4" style="display: none;">
						  <div class="form-group">
							<label>Tanggal Post <span class="text-danger">*</span></label>
							<?php echo form_error('tanggal_post', '<div class="text-danger">', '</div>'); ?>
							<input class="form-control" type="date" id="tanggal_post" name="tanggal_post" value="<?php echo set_value('tanggal_post', (!isset($data) ? date('Y-m-d') : (($data->tanggal!=0) ? $data->tanggal : date('Y-m-d'))) );?>" required="required">
						  </div>
						</div>
						<div class="col-md-4" style="display: none;">
						  <div class="form-group">
							<label>Waktu Post <span class="text-danger">*</span></label>
							<?php echo form_error('waktu_post', '<div class="text-danger">', '</div>'); ?> 
							<input class="form-control" type="time" id="waktu_post" name="waktu_post" value="<?php echo set_value('waktu_post', (!isset($data) ? date('H:i') : (($data->waktu!=0) ? $data->waktu : date('H:i'))) );?>" required="required">
						  </div>
						</div>
					</div>
					<input type="submit" value="Simpan Profil" name="form_submit" class="btn btn-primary"/>
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
});
</script>

</html>
