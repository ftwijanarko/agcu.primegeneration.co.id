<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Kelas"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Jenjang<span class="text-danger">*</span></label>
                        <input type="text" name="jenjang" id="jenjang" class="form-control" onKeyUp="setAlias();" placeholder="Jenjang Pendidikan" value="<?php echo set_value('jenjang', isset($data) ? $data->jenjang : '');?>" required="required">
                        <?php echo form_error('jenjang', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tingkatan Kelas<span class="text-danger">*</span></label>
                        <input type="text" name="tingkatan_kelas" id="tingkatan_kelas" class="form-control" onKeyUp="setAlias();" placeholder="Tingkatan Kelas" value="<?php echo set_value('tingkatan_kelas', isset($data) ? $data->tingkatan_kelas : '');?>" required="required">
                        <?php echo form_error('tingkatan_kelas', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Alias Kelas<span class="text-danger">*</span></label>
                        <input type="text" name="alias_kelas" id="alias_kelas" class="form-control" placeholder="Alias Kelas" value="<?php echo set_value('alias_kelas', isset($data) ? $data->alias_kelas : '');?>" required="required">
                        <?php echo form_error('alias_kelas', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="return resetForm(this.form);"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>

                <div class="footer">
                  <hr>
                  <div class="stats">
                    <i class="fa fa-history"></i> Updated 3 minutes ago
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>
    
  </div>
</div> <!-- end .wrapper -->

</body>

  <!--   Core JS Files   -->
  <script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

  <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
 <script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- CUSTOM JS FUNCTION -->

<script type="text/javascript">
  function setAlias(){
    var jenjang = document.getElementById('jenjang').value;
    var tingkatan = document.getElementById('tingkatan_kelas').value;
    var alias = document.getElementById('alias_kelas');
    
    alias.value = jenjang + " kelas " + tingkatan;
  }
</script>

</html>
