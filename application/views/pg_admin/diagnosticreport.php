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
                <h4 class="title">AGCU Test Report</h4>
              </div>
              <div class="content">
								<div id="containerajax">
								
									<?php include "diagnosticreport_ajax.php"; ?>

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


</html>
