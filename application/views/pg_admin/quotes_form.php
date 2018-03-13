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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Ubah Poin"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tokoh <span class="text-danger">*</span></label>
                        <input type="text" name="tokoh" id="tokoh" class="form-control" placeholder="Tokoh" value="<?php echo set_value('tokoh', isset($data) ? $data->tokoh : '');?>">
                        <?php echo form_error('tokoh', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Quote (Kalimat Bijak) <span class="text-danger">*</span></label>
                        <textarea name="quote" id="quote" class="form-control" rows="4" placeholder="Kalimat Bijak" required="required"><?php echo set_value('quote', isset($data) ? $data->quote : '');?></textarea>
                        <?php echo form_error('quote', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="javascript:history.back();"><i class="fa fa-times"></i> Cancel</button>
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

</html>
