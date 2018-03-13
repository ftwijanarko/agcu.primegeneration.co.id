<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#list-soal").load("banksoal/ajax_soal/" + $("#kelas").val() + "/" + $("#mapel").val());
		$("#list_modal").load("banksoal/ajax_soal_modal/" + $("#kelas").val() + "/" + $("#mapel").val());
		$("#kategori").load("banksoal/ajax_kategori/" + $("#mapel").val());
	});
	$("#kategori").change(function(){
		$("#list-soal").load("banksoal/ajax_soal_by_kategori/" + $("#kategori").val());
		$("#list_modal").load("banksoal/ajax_soal_modal_by_kategori/" + $("#kategori").val());
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
								<a class="btn btn-success btn-fill pull-right" href="<?= base_url('pg_admin/banksoal/tambah') ?>"><i class="fa fa-plus"></i> Tambah Bank Soal</a>
                <h4 class="title">Bank Soal</h4>
                <p class="category">Daftar Bank Soal</p>
              </div>
              <div class="content">
								<div class="clearfix"></div>
                <!-- TABLE UNTUK BANK SOAL -->
								<div style="margin-top:10px;">
								<table class="table table-stripped">
									<tr>
									<td>
										<select id="kelas" class="form-control">
											<option value="">Pilih Kelas...</option>
												<?php 
												foreach ($select_options_kelas as $item) { 
												?>
												<option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
												<?php } ?>
										</select>
									</td>
									<td>
										<select id="mapel" class="form-control">
											<option value="">Pilih Mata Pelajaran...</option>
										</select>
									</td>
									<td>
										<select id="kategori" class="form-control">
											<option value="">Pilih Kategori...</option>
										</select>
									</td>
									</tr>
								</table>
								</div>
								<div class="table-responsive">
									<table id="my_datatable" class="table table-striped table-hover">
										<thead>
											<tr>
												<th style="width: 10px;">No.</th>
												<th style="width: 30%;">Topik</th>
												<th>Pembahasan</th>
												<th style="width: 15%;">Pelajaran</th>
												<th style="width: 10%;">Bobot Soal</th>
												<th style="width: 10%;">Kunci Jawaban</th>
												<th style="width: 10%;">Operasi</th>
											</tr>
										</thead>
										<tbody id="list-soal">
										
										</tbody>
									</table>
								</div>
								<!-- END TABLE BANK SOAL -->

                <div class="footer">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

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

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>
<div id="list_modal">
<?php
$no=1;
foreach($data_soal as $data){
?>
<div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
	<div class="modal-content" id="modalsoal">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  </div>
	  <div class="modal-body">
		<p><?php echo $data->pertanyaan; ?></p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
$no++;
}
?>
</div>
</html>
