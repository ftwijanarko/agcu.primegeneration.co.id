<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
	$(function(){
		$("#kelas").change(function(){
			$("#mapel").load("<?php echo base_url('pg_admin/diagnosticmaster/pilihmapel'); ?>/" + $("#kelas").val());
		});
		$("#mapel").change(function(){
			$("#soal").load("<?php echo base_url('pg_admin/diagnosticmaster/pilihsoal'); ?>/" + $("#mapel").val());
			$("#kategori").load("<?php echo base_url('pg_admin/banksoal/ajax_kategori'); ?>/" + $("#mapel").val());
		});
		$("#kategori").change(function(){
			$("#soal").load("<?php echo base_url('pg_admin/diagnosticmaster/ajax_soal_by_kategori'); ?>/" + $("#kategori").val());
		});
	});
</script>
<script>
$(function(){
	$( '#checkall' ).click( function () {
		$( '#soal input[type="checkbox"]' ).prop('checked', this.checked)
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
                <h4 class="title">Diagnostic Test</h4>
              </div>
              <div class="content">
			  <form action="<?= base_url('pg_admin/diagnosticmaster/prosesedit') ?>" method="post">
			  <input type="hidden" name="id" value="<?php echo $iddiagnostic;?>" />
				<table class="table" style="background-color: #EDEDED">
					<tr>
						<td class="text-center">Nama Test</td>
						<td class="text-center">Durasi Test (menit)</td>
						<td class="text-center">Ketuntasan</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="nama" class="form-control"  value="<?php echo $getdiagnostic->nama_kategori;?>"required />
						</td>
						<td>
							<input type="text" name="durasi" class="form-control" value="<?php echo $getdiagnostic->durasi;?>" required />
						</td>
						<td>
							<input type="text" name="ketuntasan" class="form-control" value="<?php echo $getdiagnostic->ketuntasan;?>" required />
						</td>
					</tr>
					<tr>
						<td class="text-center">Kelas</td>
						<td class="text-center">Mata Pelajaran</td>
						<td class="text-center">Kategori Bank Soal</td>
					</tr>
					<tr>
						<td>
							<select name="kelas" id="kelas" class="form-control">
								<?php
									foreach($kelas as $datakelas){
								?>
									<option value="<?php echo $datakelas->id_kelas; ?>" <?= $getdiagnostic->id_kelas == $datakelas->id_kelas ? 'selected' : '' ?>><?php echo $datakelas->alias_kelas;?></option>
								<?php
									}
								?>
							</select>
						</td>
						<td>
							<select name="mapel" id="mapel" class="form-control">
							<option value="<?php echo $getdiagnostic->id_mapel; ?>"><?php echo $getdiagnostic->nama_mapel; ?></option>
							</select>
						</td>
						<td>
							<select id="kategori" class="form-control">
							</select>
						</td>
					</tr>
				</table>
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Kelas / Mapel</th>
							<th>Soal</th>
							<th>Topik</th>
							<th>
								<input type="checkbox" id="checkall"/>
							</th>
						</tr>
					</thead>
					<tbody id="soal">
						<tr>
							<td colspan="4" style="text-center">Pilih kelas dan mata pelajaran untuk input soal baru</td>
						</tr>
					</tbody>
				</table>
				
				<input type="submit" value="Simpan Test" name="form_submit" class="btn btn-primary"/>
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


</html>
