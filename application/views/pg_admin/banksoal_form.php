<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("pilihmapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#kategori").load("pilihkategori/" + $("#mapel").val());
		$("#topik").load("pilihtopik/" + $("#mapel").val());
	});
	$("#topik").change(function(){
		$("#topikbaru").load("tambahtopik/" + $("#topik").val());
	});
});
</script>

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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Bank Soal"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="prosesbanksoal">
				
				  <!-- pilih mata pelajaran -->
                  <div class="form-group">
                    <?php echo form_error('nama_mapel', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-md-3">
						<label>Kelas <span class="text-danger">*</span></label>
                        <select data-placeholder="Pilih Kelas..." class="form-control" id="kelas" style="width: 100%;" tabindex="2" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options_mapel as $item) { 
                          ?>
                          <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
                          <?php } ?>
                        </select>
                      </div>
					  <div class="col-md-3">
							<label>Mata Pelajaran <span class="text-danger">*</span></label>
							<select class="form-control" id="mapel" name="nama_mapel" style="width: 100%;" data-placeholder="Pilih Mata Pelajaran..." required>
								<option value=""></option>
							</select>
					  </div>
					  <div class="col-md-3">
						<label>Kategori <span class="text-danger">*</span></label>
						<select class="form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori..." required>
							<option value="0">Uncategorized</option>
						</select>
					  </div>
					  <div class="col-md-3">
						<label>Tipe Soal <span class="text-danger">*</span></label>
						<select class="form-control" id="mapel" name="tipe" style="width: 100%;" data-placeholder="Pilih Kategori..." required>
							<option value="main">Main Class</option>
							<option value="open">Open Class</option>
						</select>
					  </div>
                    </div>
                  </div>
				  <!-- end pilih mata pelajaran -->
				  
				  <!-- Topik Soal -->
				   <div class="form-group">
					<label>Topik Soal<span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-md-6">
							<select name="topik" class="form-control" id="topik">
								
							</select>
						</div>
						<div class="col-md-6" id="topikbaru">
							
						</div>
					</div>
				  </div>
				  <!-- end Topik soal -->
				  
				  <!-- Isi Soal -->
				  <div class="form-group">
					<label>Soal<span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-md-12">
							<textarea class="tinymce_textarea" name="soal">
							</textarea>
						</div>
					</div>
				  </div>
				  <!-- end isi soal -->
				  
				  <!-- Bobot Soal -->
				   <div class="form-group">
					<label>Bobot Soal<span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-md-12">
							<input type="text" name="bobot" class="form-control" />
						</div>
					</div>
				  </div>
				  <!-- end bobot soal -->
				  
				  <!-- pilihan jawaban benar -->
				  <div class="form-group">
					<label>Pilihan Jawaban Benar<span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-md-6">
							<select name="jawabbenar" class="form-control">
								<option value="1">Jawaban A</option>
								<option value="2">Jawaban B</option>
								<option value="3">Jawaban C</option>
								<option value="4">Jawaban D</option>
								<option value="5">Jawaban E</option>
							</select>
						</div>
					</div>
				  </div>
				  <!-- end pilihan jawaban benar -->
				  
				  <!-- pilihan jawaban -->
				  <div class="row">
					<div class="col-md-12">
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#1" aria-controls="home" role="tab" data-toggle="tab">Jawaban A</a></li>
							<li role="presentation"><a href="#2" aria-controls="profile" role="tab" data-toggle="tab">Jawaban B</a></li>
							<li role="presentation"><a href="#3" aria-controls="messages" role="tab" data-toggle="tab">Jawaban C</a></li>
							<li role="presentation"><a href="#4" aria-controls="settings" role="tab" data-toggle="tab">Jawaban D</a></li>
							<li role="presentation"><a href="#5" aria-controls="settings" role="tab" data-toggle="tab">Jawaban E</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="1">
								<textarea class="tinymce_textarea" name="jawab1">
								</textarea>
							</div>
							<div role="tabpanel" class="tab-pane" id="2">
								<textarea class="tinymce_textarea" name="jawab2">
								</textarea>
							</div>
							<div role="tabpanel" class="tab-pane" id="3">
								<textarea class="tinymce_textarea" name="jawab3">
								</textarea>
							</div>
							<div role="tabpanel" class="tab-pane" id="4">
								<textarea class="tinymce_textarea" name="jawab4">
								</textarea>
							</div>
							<div role="tabpanel" class="tab-pane" id="5">
								<textarea class="tinymce_textarea" name="jawab5">
								</textarea>
							</div>
						  </div>
						</div>
					</div>
					<!-- end pilihan jawaban -->
					
					<!-- pembahasan -->
					<div class="row">
						<div class="col-md-12">
						<label>Pembahasan</label>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#teks" aria-controls="home" role="tab" data-toggle="tab">Pembahasan Teks</a></li>
							<li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">Pembahasan Video</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="teks">
								<textarea class="tinymce_textarea" name="bahasteks">
								</textarea>
							</div>
							<div role="tabpanel" class="tab-pane" id="video">
								<input type="text" name="bahasvideo" class="form-control" />
							</div>
						  </div>
						</div>
					</div>
					<!-- end pembahasan -->
					<input type="submit" class="btn btn-primary" value="simpan"></input>
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
    </div>

		<form method="post" enctype='multipart/form-data' id="frmupload">
			<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
		</form>
	
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

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->


<script type="text/javascript">
  // Used to get the video preview. But get discontinued
  // function fetch_preview_konten_video(url)
  // {
  //   console.log(url)
  //   $.ajax({
  //     type: 'POST',
  //     url: "<?=base_url('pg_admin/materi/ajax_konten_video')?>",
  //     data: { data:url },
  //     success: function(response){
  //       document.getElementById('video_preview').innerHTML=response;
  //     }
  //   });
  // }
</script>

<!-- PLUGINS FUNCTION -->
 <!-- Chosen - select box plugin  -->
 

 <!-- TinyMCE - WYSIWYG plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
		max_height : 300,
    plugins: [
        "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor",
        "code fullscreen youtube autoresize tiny_mce_wiris"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry tiny_mce_wiris_CAS | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image media youtube | forecolor backcolor | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,

		file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#filegambar').trigger('click');
        $('#filegambar').on('change', function() {
		  
					var path = "<?php echo base_url('assets/uploads/materi') ?>/";
					var fileInput = document.getElementById('filegambar');   
					var filename = fileInput.files[0].name;
					filename = filename.replace(/ /g, "_");
					fullpath = path + filename;

					var url = "<?php echo base_url('pg_admin/upload_gambar') ?>";

					$.ajax({
						type: "POST",
						url: url,
						data: new FormData($('#frmupload')[0]),
						cache: false,
						contentType: false,
						processData: false,
						beforeSend: function() {
							NProgress.start();
						},
						success: function(data){
							NProgress.done(); 
							callback(data);
						}
					});

        });
      }
    },

		/*
		//Filemanager
		external_filemanager_path: "<?php echo base_url();?>assets/js/plugins/filemanager/",
		filemanager_title: "Data Filemanager" ,
		external_plugins: { "filemanager" : "<?php echo base_url();?>assets/js/plugins/filemanager/plugin.min.js" },
	 
    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 250,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
		*/
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
