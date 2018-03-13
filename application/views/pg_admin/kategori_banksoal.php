<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("../pilihmapel/" + $("#kelas").val());
	});
	
	$("#mapel").change(function(){
		$("#topik").load("../pilihtopik/" + $("#mapel").val());
		
		$("#soal").load("../pilihsoalbymapel/" + $("#mapel").val());
	});
	
	$("#topik").change(function(){
		$("#soal").load("../pilihsoalbytopik/" + $("#mapel").val() + encodeURIComponent($("#topik").val()));
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
					<div class="col-md-12">
            <div class="card">
              <div class="header">
								<a class="btn btn-success btn-fill pull-right" href="<?= base_url('pg_admin/banksoal/tambahkategori') ?>"><i class="fa fa-plus"></i> Tambah Kategori</a>
                <h4 class="title">Kategori Bank Soal</h4>
                <p class="category">Daftar Kategori Bank Soal</p>
              </div>
              <div class="content">
								<div class="row" style="margin-bottom:20px;">
								</div>
								<div class="clearfix"></div>
								<table id="my_datatable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<td>Kelas</td>
											<td>Mata Pelajaran</td>
											<td>Nama Kategori</td>
											<td>Operasi</td>
										</tr>
									</thead>
									
									<tbody>
										<?php
											foreach($kategoribanksoal as $kategori){
										?>
											<tr>
												<td><?php echo $kategori->alias_kelas; ?></td>
												<td><?php echo $kategori->nama_mapel; ?></td>
												<td><?php echo $kategori->nama_kategori; ?></td>
												<td align="center">
												<a href="editkategori/<?php echo $kategori->id_kategori_bank_soal;?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a> 
												
												<?php	if($this->session->userdata('level') == "superadmin"){ ?>
												<a onclick="return confirm('Apakah anda yakin inign menghapus kategori <?php echo $kategori->nama_kategori; ?>?')" href="hapuskategori/<?php echo $kategori->id_kategori_bank_soal;?>" class="btn btn-danger btn-xs" title="Hapus"><i class="glyphicon glyphicon-remove"></i></a>
												<? } ?>
												</td>
											</tr>
										<?php
											}
										?>
									</tbody>
								</table>

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
