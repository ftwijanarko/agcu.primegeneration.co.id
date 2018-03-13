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
                <h4 class="title">Edit Kategori</h4>
              </div>
              <div class="content">
				<form method="post" action="<?php echo $form_action?>">
					<table class="table table-stripped">
						<?php
						foreach($data_table as $item){
						?>
						<tr>
							<td>
								Nama Kategori :
								<br><input type="text" name="nama" class="form-control" value="<?php echo $item->nama_kategori; ?>"></input>
							</td>
							<td>
								Tanggal Test :
								<br><input type="text" name="tanggal" class="form-control" value="<?php echo $item->tanggal; ?>"></input>
							</td>
							<td>
								Waktu Test :
								<br><input type="text" name="jam" class="form-control" value="<?php echo $item->jam; ?>"></input>
							</td>
						</tr>
						<tr>
							<td>
								Waktu Pengerjaan (Dalam Menit) :
								<br><input type="text" name="durasi" class="form-control" value="<?php echo $item->durasi; ?>"></input>
							</td>
							<td>
								Ketuntasan (Dalam %) :
								<br><input type="text" name="ketuntasan" class="form-control" value="<?php echo $item->ketuntasan; ?>"></input>
							</td>
							<td>
								Tampilan Soal :
								<br>
								<?php
									if($item->random == '0'){
										echo '<input type="checkbox" name="random" value="1"></input>';
									}else{
										echo '<input type="checkbox" checked name="random" value="1"></input>';
									}
								?> Random
							</td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="3">
								<input type="submit" name="form_submit" value="Simpan Perubahan" class="btn btn-primary"/>
							</td>
						</tr>
					</table>
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
