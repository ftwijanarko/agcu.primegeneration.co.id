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
                <h4 class="title">Diagnostic Test</h4>
              </div>
              <div class="content">
				<table>
					<tr>
						<td><a href="diagnostictest/tambah" class="btn btn-primary">Tambah Diagnostic Test</a></td>
						<td style="text-align: right; font-style: italic;">
						Halaman ini digunakan untuk mengatur soal yang akan
						dimasukkan/dihilangkan dari Diagnostic Test (AGCU).
						Untuk menambah, mengubah, dan menghapus Data Soal ada di menu Bank Soal.
						</td>
					</tr>
				</table>
				<p>&nbsp;
					<?php foreach($kelas as $datakelas){
					?>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4><?php echo $datakelas->alias_kelas ;?></h4>
					  </div>
					  <div class="panel-body">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>Nama Test</th>
									<th>Durasi</th>
									<th>Ketuntasan</th>
									<th>jumlah Soal</th>
									<th>Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($diagnostic as $datadiag){
										if($datadiag->id_kelas == $datakelas->id_kelas){
								?>
									<tr>
										<td><?php echo $datadiag->nama_kategori;?></td>
										<td><?php echo $datadiag->durasi;?></td>
										<td><?php echo $datadiag->ketuntasan;?></td>
										<td>
										<?php
											foreach($jumlah_soal as $jumlah){
												if($jumlah->id_diagnostic == $datadiag->id_diagnostic){
													echo $jumlah->jumlah;
												}
											}
										?>
										</td>
										<td>
										<div class="button-group">
										  <a href="diagnostictest/edit/<?php echo $datadiag->id_diagnostic;?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
										  <a href="diagnostictest/daftar_soal/<?php echo $datadiag->id_diagnostic;?>" class="btn btn-warning btn-xs" title="Ubah"><i class="fa fa-eye" aria-hidden="true"></i></a>
										  <?php
										  if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
										  ?>
										  <a href="diagnostictest/hapus/<?php echo $datadiag->id_diagnostic;?>" class="btn btn-danger btn-xs" title="Ubah" onclick="return confirm('apakah anda yakin untuk menghapus diagnostic test <?php echo $datadiag->nama_kategori;?>?')"><i class="glyphicon glyphicon-remove"></i></a>
										  <?php
										  }
										  ?>
										</div>
										</td>
									</tr>
								<?php
										}
									}
								?>
							</tbody>
						</table>
					  </div>
					</div>
					<?php
					}
					?>
					
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
