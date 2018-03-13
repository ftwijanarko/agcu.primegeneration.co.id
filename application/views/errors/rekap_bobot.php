<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	
	$(document).ajaxStart(function() {
	  $('#modal-loader').modal('show');
	});
	$("#kelas").change(function(){
		$("#mapel").load("../banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#bab").load("../kurikulum/ajax_materi_pokok_drop/" + $("#mapel").val() + "/" + $("#mapel").val());
	});
	$("#bab").change(function(){
		$("#data-materi").load("ajax_sub_bab/" + $("#bab").val());
	});
	$(document).ajaxStop(function() {
		$('#modal-loader').modal('hide');
	})
});
</script>
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
                <h4 class="title">Rekapitulasi Pembobotan</h4>
              </div>
              <div class="content">
				<div class="table-responsive">
					<table class="table table-stripped">
						<tr>
							<td>
								<select id="kelas" class="form-control">
									<option value="">Pilih Kelas...</option>
									  <?php 
									  foreach ($datakelas as $item) { 
									  ?>
									  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
									  <?php } ?>
								</select>
							</td>
							<td>
								<select id="mapel" class="form-control" name="idmapel" required>
									<option value="">Pilih Mata Pelajaran...</option>
								</select>
							</td>
							<td>
								<select id="bab" class="form-control" name="idmapok" required>
									<option value="">Pilih Bab...</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div class="table-responsive" id="data-materi">
					
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p> Loading Data
      </div>
    </div>
  </div>
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
 
<script>
$(document).ready(function() {
    //$('table.display').DataTable();
	
	$(".lihat-soal").click(function(e){
		var soal = e.target.id;
		var idsoal = soal.split("-");
		$("#isi-soal").load("quality/ajax_lihat_soal/" + idsoal[1]);
	})
	
	$("#ajax_overview").load("quality/ajax_overview/" + $("#bab").val());
	
	$("#list-eval").load("quality/ajax_list_eval/");
	
	$(document).ready(function() {
		$('table.display').DataTable();
	} );
});
 </script>
 
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

</html>
