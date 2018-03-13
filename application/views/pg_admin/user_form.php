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

        <div class="card">
					<div class="row">
						<div class="col-md-12">
              <div class="header">
                
                <h4 class="title">Tambah User</h4>
              </div>
              <div class="content">
                <form action="<?php echo base_url("pg_admin/user/proses_tambah");?>" method="post">
									<div class="form-group col-md-6">
										<label>Nama<span class="text-danger">*</span></label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama..." required />
									</div>
									<div class="form-group col-md-6">
										<label>Username<span class="text-danger">*</span></label>
										<input type="text" name="username" class="form-control" placeholder="Masukkan Username..." required />
									</div>
									<div class="form-group col-md-6">
										<label>Password<span class="text-danger">*</span></label>
										<input type="Password" name="password" class="form-control" placeholder="Masukkan Password..." required />
									</div>
									<div class="form-group col-md-6">
										<label>Ulangi Password<span class="text-danger">*</span></label>
										<input type="Password" name="repassword" class="form-control" placeholder="Ulangi Password..." required />
									</div>
									<div class="form-group col-md-6">
										<label>Level<span class="text-danger">*</span></label>
										<select id="level" class="form-control chosen-select" name="level" required>
											<option value="">-- Pilih Level --</option>
											<option value="superadmin">Super Administrator</option>
											<option value="administrator">Administrator</option>
											<option value="admin">Admin</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Jabatan<span class="text-danger">*</span></label>
										<select id="jabatan" class="form-control chosen-select" name="jabatan" required>
											<option value="">-- Pilih Jabatan --</option>
											<option value="pusat">Pusat</option>
											<option value="pimpinan">Pimpinan Cabang</option>
											<option value="admin">Admin Cabang</option>
											<option value="konselor">Konselor</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Cabang<span class="text-danger">*</span></label>
										<select id="cabang" class="form-control chosen-select" name="cabang" required>
											<option value="">-- Pilih Cabang --</option>
											<option value="0">PUSAT</option>
											<? foreach($data_cabang as $data){ ?>
											<option value="<?php echo $data->id_cabang;?>"><?php echo $data->nama_cabang;?></option>
											<? } ?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Status<span class="text-danger">*</span></label>
										<select id="status" class="form-control chosen-select" name="status" required>
											<option value="">-- Pilih Status --</option>
											<option value="1">Aktif</option>
											<option value="0">Tidak Aktif</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>
									<input type="submit" class="btn btn-primary" value="Simpan Akun" />
									<div class="clearfix"></div>
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

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- PLUGINS FUNCTION -->
 <!-- Nestable plugin  -->
<script type="text/javascript">
$(document).ready(function()
{
    var parentTab = $('ul.nav.nav-tabs li:first-child ul.dropdown-menu li:first-child a');
    parentTab.click(function() {
      $('.nav-pills.nav-stacked li:first-child a').trigger('click');
    });
    parentTab.trigger('click');
  // console.log("opo:" + opo);

  //disable all update button
  $("button[name*='map-']").prop('disabled', true);

  $("button[name*='map-']").click(function(e){
      var target_name = e.target.name;
      var target_val = e.target.value;
      var id = parseInt(target_name.replace(/map-/g, ''))
      // console.log("TRGET_name= " + e.target.name);
      // console.log("TRGET_val = " + e.target.value);
      // console.log("parseInt= " + i);
      // console.log("isNan&= " + isNaN(target_name));
      if(id == target_val)
      { 
        sendAjaxPost(target_val, $('#nestable_' + id)); 
      }
      
      //disable update button        
      $("button[name='"+target_name+"']").prop('disabled', true);
  });

  var sendAjaxPost = function(id, e)
  {
    // var target_id = e.length ? e : e.target.id;
      var target_id = e;
      $.post("<?=base_url('pg_admin/dashboard/ajax_handler');?>",
      {
        id_mapel: id, 
        json: window.JSON.stringify(target_id.nestable('serialize'))
      },
      function(data, status){
          console.log("\nStatus: " + status + "\nData: " + data);
      });
  }

  var disableButton = function(target_id)
  {
      console.log("target_id :" + target_id);
      target_name = target_id.replace(/nestable_/g, 'map-');
      console.log("target_name :" + target_name);
      $('button[name='+target_name+']').prop('disabled', false);
  }

  var updateOutput = function(e)
  {
      var list   = e.length ? e : $(e.target),
          output = list.data('output'),
          target_id = e.length ? e : e.target.id;
      if (window.JSON) {
          console.log(target_id);
          disableButton(target_id);
          // output.val(target_id + ": \n" + window.JSON.stringify(list.nestable('serialize')));//, null, 2));
      } else {
          output.val('JSON browser support required for this demo.');
      }
  };

  // activate Nestable for list 1
  // $('#nestable').nestable({ group: 1, maxDepth: 2 }).on('change', updateOutput);
  
  // activate Nestable per id_mapel
  <?php foreach ($list_mapel as $init_mapel) {
    ?>
    $('<?php echo "#nestable_".$init_mapel->id_mapel;?>').nestable({ 
      group: 1, 
      maxDepth: 3,
      enableHMove: false 
    }).on('change', updateOutput);

    // updateOutput($('<?php echo "#nestable_".$init_mapel->id_mapel;?>').data('output', $('#nestable-output')));
    <?php
  }?>

  // output initial serialised data
  // updateOutput($('#nestable').data('output', $('#nestable-output')));

  $('.nestable-menu').on('click', function(e)
  {
      var target = $(e.target),
          action = target.data('action');
      if (action === 'expand-all') {
          $('.dd').nestable('expandAll');
      }
      if (action === 'collapse-all') {
          $('.dd').nestable('collapseAll');
      }
  });

  $("[id*='demo-']").on('click', function(e)
  {
    var e_id = $(this).attr('id');
    var element = $("[id^='"+e_id+"'");

    var ids = e_id.split('-');
    var id_sub = ids[1];

    console.log(id_sub);

    $.post("<?php echo base_url('pg_admin/dashboard/ajax_set_demo'); ?>",
      {
        id: id_sub, 
      },
      function(data, status) {
          console.log("\nStatus: " + status + "\nData: " + data);
          if(data == 1)
          {
            console.log(element);
            if(element.hasClass('btn-fill')) {
              element.removeClass('btn-fill');
            }
            else {
              element.addClass('btn-fill');
            }
          }
      })

  });

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
	
</html>
