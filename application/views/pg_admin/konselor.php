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
                <a href="<?php echo site_url('pg_admin/user/tambah1') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah User</a>
                <h4 class="title">Semua Konselor</h4>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id="my_datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tpt, Tgl Lahir</th>
                        <th>Username</th>
                        <th>Cabang</th>
                        <th>Status</th>
                        <th class="text-center" style="width:10%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
											$no = 1;
											foreach($data_table as $data){
											?>
												<tr>
													<td><?php echo $no;?></td>
													<td><?php echo $data->kode;?></td>
													<td><?php echo $data->nama;?></td>
													<td><? $data->tpt_lahir ? $data->tpt_lahir.',' :  '' ?><? $data->tgl_lahir ? $data->tgl_lahir :  '-' ?></td>
													<td><?php echo $data->username;?></td>
													<td><?= $data->cabang_id == 0 ? 'PUSAT' : $data->nama_cabang ?></td>
													<td><?= $data->status == '1' ? 'Aktif' : 'Tidak Aktif' ?></td>
													<td class="text-center">
														<a href="<?php echo base_url('pg_admin/user/edit1/'.$data->id_adm);?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a> 
														<?php	if($this->session->userdata('level') == "superadmin"){ ?>
														<a href="<?php echo base_url('pg_admin/user/hapus/'.$data->id_adm.'/konselor');?>" onclick="return confirm('Apakah anda yakin untuk menghapus user <?php echo $data->username;?> ?');" class="btn btn-danger btn-xs" title="Hapus"><i class="glyphicon glyphicon-remove"></i></a>
														<? } ?>
													</td>
												</tr>
											<?php
												$no++;
											}
											?>
                    </tbody>
                  </table>
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

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

</html>
