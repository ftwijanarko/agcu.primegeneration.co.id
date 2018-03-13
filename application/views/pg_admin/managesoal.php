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
                <h4 class="title">Manage Soal</h4>
              </div>
              <div class="content">
				<form method="post" action="<?php echo $form_action?>">
					<table class="table table-stripped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Pertanyaan</th>
								<th>Pembahasan</th>
								<th>Pelajaran</th>
								<th>Topik</th>
								<th>Bobot</th>
								<th>Kunci</th>
								<th>Pilih</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($data_table as $item){
							?>
							<tr>
								<td><?php echo $no++ ;?></td>
								<td><?php echo $item->pertanyaan ;?></td>
								<td><?php echo $item->pembahasan_teks ;?></td>
								<td></td>
								<td><?php echo $item->topik ;?></td>
								<td><?php echo $item->bobot_soal ;?></td>
								<td><?php echo $item->kunci ;?></td>
								<td><input type="checkbox" name="pilih[]" value="<?php echo $item->id_banksoal ;?>"/></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td colspan="8"><input type="submit" class="btn btn-danger" name="form_submit" value="hapus"></input></td>
							</tr>
						</tbody>
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
