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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Siswa"?></h4>
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Nama Lengkap<span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama', (isset($data_siswa->nama_siswa) ? $data_siswa->nama_siswa : ''));?>" required="required">
                        <?php echo form_error('nama', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat"><?php echo set_value('alamat', (isset($data_siswa->alamat) ? $data_siswa->alamat : ''));?></textarea>
                        <?php echo form_error('alamat', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo set_value('email', (isset($data_siswa->email) ? $data_siswa->email : ''));?>">
                        <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Nomor Telepon" value="<?php echo set_value('telepon', (isset($data_siswa->telepon) ? $data_siswa->telepon : ''));?>">
                        <?php echo form_error('telepon', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Telepon Orang Tua</label>
                        <input type="text" name="telepon_ortu" id="telepon_ortu" class="form-control" placeholder="Nomor Telepon" value="<?php echo set_value('telepon_ortu', (isset($data_siswa->telepon_ortu) ? $data_siswa->telepon_ortu : ''));?>">
                        <?php echo form_error('telepon_ortu', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
          
                    <div class="col-md-offset-1 col-md-5">
                      <div class="form-group">
                        <label>Asal Sekolah<span class="text-danger">*</span></label>
                        <div class="input-group">
                        <select data-placeholder="Pilih Sekolah..." id="sekolah" name="sekolah" class="chosen-select" onchange="fetch_select_kelas(this.value)" style="width: 100%;" tab-index="6" required>
                          <option value=""></option>
                          <?php 
                          foreach ($select_sekolah as $opt) { ?>
                            <option <?php echo set_select('sekolah', $opt->id_sekolah, (!isset($data_siswa->sekolah_id) ? FALSE : ($data_siswa->sekolah_id == $opt->id_sekolah ? TRUE : FALSE)) );?>
                              value="<?php echo $opt->id_sekolah ?>"> <?php echo $opt->nama_sekolah ?>
                            </option>
                          <?php } ?>
                        </select>
                        <div class="input-group-btn">
                          <span id="btnTambahSekolah" class="btn btn-default" title="Tambah sekolah baru" data-toggle="modal" data-target="#modalTambahSekolah">
                            <i class="glyphicon glyphicon-plus"></i>
                          </span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Kelas<span class="text-danger">*</span></label>
                        <select data-placeholder="Pilih Kelas..." name="kelas" id="kelas" class="chosen-select" style="width: 100%;" tab-index="8" required>
                          <option value=""></option>
                          <?php 
                          foreach ($select_options as $item) { ?>
                            <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data_siswa->id_kelas) ? FALSE : ($data_siswa->kelas == $item->id_kelas ? TRUE : FALSE)) );?>
                              value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
                            </option>
                          <?php } ?>
                        </select>
                        <?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Cabang<span class="text-danger">*</span></label>
                        <select data-placeholder="Pilih Cabang..." id="cabang" name="cabang" class="chosen-select" style="width: 100%;" tab-index="9" required>
                          <option value=""></option>
                          <?php 
                          foreach ($data_cabang as $opt) { ?>
                            <option <?php echo set_select('cabang', $opt->id_cabang, (!isset($data_siswa->cabang_id) ? FALSE : ($data_siswa->cabang_id == $opt->id_cabang ? TRUE : FALSE)) );?>
                              value="<?php echo $opt->id_cabang ?>"> <?php echo $opt->nama_cabang ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kode Aktivasi<span class="text-danger">*</span></label>
                        <input type="text" name="aktivasi" id="aktivasi" class="form-control" placeholder="Kode Aktivasi" value="<?php echo set_value('aktivasi', (isset($data_siswa->aktivasi) ? $data_siswa->aktivasi : ''));?>">
                        <?php echo form_error('aktivasi', '<div class="text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Kode Konselor<span class="text-danger">*</span></label>
                        <input type="text" name="konselor" id="konselor" class="form-control" placeholder="Kode Konselor" value="<?php echo set_value('konselor', (isset($data_siswa->kode_konselor) ? $data_siswa->kode_konselor : ''));?>">
                        <?php echo form_error('konselor', '<div class="text-danger">', '</div>'); ?>
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
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>
    
  </div>
</div> <!-- end .wrapper -->

  <?php include "modal_tambah_sekolah.php"; ?>
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
  
  <!-- Awesomeplate -->
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/awesomplete.js');?>" async></script>

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
  $('#modalTambahSekolah').on('shown.bs.modal', function () {
    $('.modal-chosen-select', this).chosen('destroy').chosen();
  });
</script>
<script type="text/javascript">
  function fetch_select_sekolah(val)
  {
    $.ajax({
      type: 'POST',
      url: "<?=base_url('pg_admin/siswa/ajax_select_sekolah')?>",
      data: { id:val },
      success: function(response){
        document.getElementById('sekolah').innerHTML=response;              
        $("#sekolah").trigger("chosen:updated");
      }
    });
  }

  function fetch_select_kelas(val)
  {
    console.log("val -> "+val);
    $.ajax({
      type: 'POST',
      url: "<?=base_url('pg_admin/siswa/ajax_select_kelas')?>",
      data: { id:val },
      success: function(response){
        document.getElementById('kelas').innerHTML=response;
        
        $("#kelas").trigger("chosen:updated");
      }
    });
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var form = $('#formTambahSekolah');  
    form.submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: { 
          id_kota: $('#select_kota').val(),  
          jenjang: $('#select_jenjang').val(),  
          sekolah: $('#tambah_sekolah').val(),  
          email: $('#email_sekolah').val(),  
          telepon: $('#telepon_sekolah').val(),  
          alamat: $('#alamat_sekolah').val()  
        },
        success: function(response){
          if(response != 0) {
            fetch_select_sekolah( "" );
            $("#alertDangerTambahSekolah").slideUp();
            $("#alertSuccessTambahSekolah").slideDown().delay(5000).slideUp();
          } 
          else {
            $("#alertSuccessTambahSekolah").slideUp();
            $("#alertDangerTambahSekolah").slideDown().delay(5000).slideUp();
          }
        }
      })

    });
  });
</script>

</html>
