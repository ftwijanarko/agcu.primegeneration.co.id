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
								<? if ($this->session->userdata('idcabang') == 0){ ?>
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Cabang"?></h4>
								<? } else { ?>
                <h4 class="title">Update Profile Cabang</h4>
								<? } ?>
							</div>
              <div class="content">

                  <form method="post" action="<?php echo $form_action?>">
                  <div class="row">
									
										<div class="col-md-6">
											<div class="form-group">
												<label>Nomor Induk Cabang<span class="text-danger">*</span></label>
												<?php echo form_error('no_induk', '<div class="text-danger">', '</div>'); ?>
												<input type="text" name="no_induk" class="form-control" placeholder="Nomor Induk Cabang" value="<?php echo set_value('no_induk', isset($data->no_induk) ? $data->no_induk : '');?>" <?= $this->session->userdata('idcabang') > 0 ? 'readonly="readonly"' : '' ?> required="required" tabindex="1">
											</div>
											<div class="form-group">
												<label>Nama Cabang<span class="text-danger">*</span></label>
												<?php echo form_error('nama_cabang', '<div class="text-danger">', '</div>'); ?>
												<input type="text" name="nama_cabang" class="form-control" placeholder="Nama Cabang" value="<?php echo set_value('nama_cabang', isset($data->nama_cabang) ? $data->nama_cabang : '');?>" required="required" tabindex="2">
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo set_value('email', isset($data->email) ? $data->email : '');?>" tabindex="3">
												<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
											</div>
											<div class="form-group">
												<label>Telepon</label>
												<input type="text" name="telepon" id="telepon" class="form-control" placeholder="Nomor Telepon" value="<?php echo set_value('telepon', isset($data->telepon) ? $data->telepon : '');?>" tabindex="4">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label>Provinsi<span class="text-danger">*</span></label>
												<?php echo form_error('provinsi', '<div class="text-danger">', '</div>'); ?>
												<select data-placeholder="Pilih Provinsi..." name="provinsi" class="chosen-select" onchange="fetch_select_kota(this.value)" style="width: 100%;" tabindex="5" required="required">
													<option value=""></option>
													<?php 
													foreach ($select_provinsi as $item) { ?>
														<option <?php echo set_select('provinsi', $item->id_provinsi, (!isset($data->provinsi_id) ? FALSE : ($data->provinsi_id == $item->id_provinsi ? TRUE : FALSE)) );?> value="<?php echo $item->id_provinsi ?>" > <?php echo $item->nama_provinsi?> </option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label>Kota<span class="text-danger">*</span></label>
												<?php echo form_error('kota', '<div class="text-danger">', '</div>'); ?>
												<select data-placeholder="Pilih Kabupaten/Kota..." id="kota" name="kota" class="chosen-select" style="width: 100%;" tabindex="6" required="required">
													<option value=""></option>
													<?php 
													foreach ($select_kota as $item) { ?>
														<option <?php echo set_select('kota', $item->id_kota, (!isset($data->id_kota) ? FALSE : ($data->id_kota == $item->id_kota ? TRUE : FALSE)) );?> value="<?php echo $item->id_kota ?>" > <?php echo $item->nama_kota?> </option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label>Alamat</label>
												<textarea name="alamat" class="form-control" placeholder="Alamat Cabang" rows="4" tabindex="6"><?php echo set_value('alamat', isset($data->alamat_cabang) ? $data->alamat_cabang : '');?></textarea>
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
                  
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

  </div>
</div>

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

 <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
 <script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
  function resetForm(form){
    // clearing selects
    $('.chosen-select').val('').trigger('chosen:updated');
  }
</script>

<!-- PLUGINS FUNCTION -->
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
  <script type="text/javascript">
    function fetch_select_kota(val) {
      $.ajax({
        type: 'POST',
        url: "<?=base_url('pg_admin/Cabang/ajax_select_kota')?>",
        data: { id:val },
        success: function(response){
          document.getElementById('kota').innerHTML=response;
          
          $("#kota").trigger("chosen:updated");
        }
      });
    }
  </script>

 <!-- TinyMCE - WYSIWYG plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
  tinymce.init({
    selector: '#tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image media youtube | forecolor backcolor | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,

    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 500,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
  });
  </script>

  <!-- Manually open kcfinder -->
  <script type="text/javascript">
    function openKCFinder(field) {
      console.log("OPENKCFINDER" + field);
      window.KCFinder = {
        callBack: function(url) {
            // field.value = url; DEFAULT (Full URL)
            field.value = url.substr(url.lastIndexOf("/")+1); //(Get filename only)
            window.KCFinder = null;
        }
      };
      window.open("<?php echo base_url()?>assets/js/plugins/kcfinder/browse.php?type=images&dir=images", 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
      );
    }
  </script>
</html>
