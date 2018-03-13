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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah paket"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tipe</label>
                        <!-- <input type="text" name="alias_paket" id="alias_paket" class="form-control" placeholder="Alias paket" value="<?php //echo set_value('alias_paket', isset($data) ? $data->alias_paket : '');?>"> -->
                        <?php $tipe = isset($data->tipe) ? $data->tipe : 0; ?>
                        <select name="tipe" id="tipe" class="form-control">
                          <option value="0" <?php echo ($tipe == 0) ? 'selected' : ''?> >Reguler</option>
                          <option value="1" <?php echo ($tipe == 1) ? 'selected' : ''?> >Premium</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Durasi <span class="text-danger">(bulan)</span></label>
                        <?php echo form_error('durasi', '<div class="text-danger">', '</div>'); ?>
                       <!--  <input type="text" name="jenjang" id="jenjang" class="form-control" onKeyUp="setAlias();" placeholder="Jenjang Pendidikan" value="<?php //echo set_value('jenjang', isset($data) ? $data->jenjang : '');?>" required="required"> -->
                       <select name="durasi" id="durasi" class="form-control">
                        <?php 
                        $durasi = isset($data->durasi) ? $data->durasi : 0; 
                        for($no=1; $no<=12; $no++)
                        { ?>
                          <option value="<?php echo $no;?>" <?php echo ($durasi == $no) ? 'selected' : ''?> ><?php echo $no;?></option>
                        <?php
                        } ?> 
                       </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Harga<span class="text-danger">*</span></label>
                        <?php echo form_error('harga', '<div class="text-danger">', '</div>'); ?>
                        <input type="number" name="harga" id="harga" class="form-control" placeholder="Tingkatan paket" value="<?php echo set_value('harga', isset($data) ? $data->harga : '');?>" required="required">
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Paket<span class="text-danger">*</span></label>
                        <?php echo form_error('kode_paket', '<div class="text-danger">', '</div>'); ?>
                        <input type="text" name="kode_paket" id="kode_paket" class="form-control" placeholder="Kode Paket" value="<?php echo set_value('kode_paket', isset($data) ? $data->kode_paket : '');?>" required="required">
                      </div>
                    </div>
                  </div> -->
                  
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="return resetForm(this.form);"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>

                <div class="footer">
                  <hr>
                 <!--  <div class="stats">
                    <i class="fa fa-history"></i> Updated 3 minutes ago
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end .content -->

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
<!-- Reset Form -->


</html>
