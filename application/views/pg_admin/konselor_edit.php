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
                
                <h4 class="title">Edit Konselor</h4>
              </div>
              <div class="content">
                <form action="<?php echo base_url("pg_admin/user/proses_edit1");?>" method="post">
									<input type="hidden" name="iduser" value="<?php echo $user->id_adm;?>" />
									<div class="form-group col-md-6">
										<label>Kode Konselor<span class="text-danger">*</span></label>
										<input type="text" name="kode" class="form-control" placeholder="Masukkan Kode Konselor..." value="<?php echo $user->kode;?>" required />
									</div>
									<div class="form-group col-md-6">
										<label>Nama<span class="text-danger">*</span></label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama..." value="<?php echo $user->nama;?>" required />
										<input type="hidden" name="level" class="form-control" value="<?php echo $user->level;?>"/>
										<input type="hidden" name="jabatan" class="form-control" value="<?php echo $user->jabatan;?>"/>
									</div>
									<div class="form-group col-md-6">
										<label>Username<span class="text-danger">*</span></label>
										<input type="text" name="username" class="form-control" placeholder="Masukkan Username..." value="<?php echo $user->username;?>" required />
									</div>
									<div class="form-group col-md-6">
										<label>Tempat Lahir</label>
										<input type="text" name="tpt_lahir" class="form-control" placeholder="Masukkan Tempat Lahir..." value="<?php echo $user->tpt_lahir;?>" />
									</div>
									<div class="form-group col-md-6">
										<label>Tanggal Lahir</label>
										<div class="input-group">
											<input type="text" name="tgl_lahir" id="datepicker" class="form-control" placeholder="YY-MM-DD..." value="<?php echo $user->tgl_lahir;?>" />
											<a href="javascript:void(0);" class="input-group-addon"><i class="fa fa-calendar"></i></a>
										</div>
									</div>
									<div class="form-group col-md-6">
										<label>Cabang<span class="text-danger">*</span></label>
										<select id="cabang" class="form-control chosen-select" name="cabang" required>
											<option value="">-- Pilih Cabang --</option>
											<option value="0" <? $user->cabang_id == 0 ? 'selected' : '' ?>>PUSAT</option>
											<? foreach($data_cabang as $data){ ?>
											<option value="<?php echo $data->id_cabang;?>" <?= $user->cabang_id == $data->id_cabang ? 'selected' : '' ?>><?php echo $data->nama_cabang;?></option>
											<? } ?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Status<span class="text-danger">*</span></label>
										<select id="status" class="form-control chosen-select" name="status" required>
											<option value="">-- Pilih Status --</option>
											<option value="1" <?= $user->status == '1' ? 'selected' : '' ?>>Aktif</option>
											<option value="0" <?= $user->status == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
										</select>
									</div>
									<div class="clearfix"></div>
									<hr>
									<input type="submit" class="btn btn-primary" value="Simpan Akun" />
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
	
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker1").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

</html>
