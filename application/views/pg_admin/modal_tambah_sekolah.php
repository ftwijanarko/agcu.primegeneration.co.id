<!-- Modal -->
<div class="modal fade" id="modalTambahSekolah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <b class="modal-title" id="myModalLabel">
          <i class="glyphicon glyphicon-plus-sign"></i> Tambah Sekolah Baru
        </b>
      </div>
      <form action="<?=base_url('pg_admin/siswa/ajax_tambah_sekolah');?>" method="post" id="formTambahSekolah">
        <div class="modal-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <select data-placeholder="Pilih Kabupaten/Kota..." id="select_kota" name="select_kota" class="form-control modal-chosen-select" style="width:100%;" tabindex="1" required="required">
                  <option value=""></option>
                  <?php 
                  foreach ($select_kota as $item) { ?>
                    <option value="<?php echo $item->id_kota ?>" > <?php echo $item->nama_kota?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>  
            <div class="row">
              <div class="form-group col-sm-5">
                <select id="select_jenjang" data-placeholder="Pilih Jenjang..." name="select_jenjang" class="form-control modal-chosen-select" style="width:100%;" tabindex="2" required="required">
                  <option value=""></option>
                  <?php 
                  foreach ($select_jenjang as $jenjang) 
                  { ?>
                  <option value="<?php echo $jenjang->jenjang?>"><?php echo $jenjang->jenjang;?></option>
                  <?php
                  } ?>
                </select>
              </div>
              <div class="form-group col-sm-7">
                <input type="text" id="tambah_sekolah" name="tambah_sekolah" class="form-control awesomplete" list="mylist" placeholder="Nama Sekolah" style="width:100%">
                <datalist id="mylist">
                  <?php 
                  foreach ($select_sekolah as $sekolah) 
                  { ?>
                  <option value="<?php echo $sekolah->nama_sekolah?>"><?php echo $sekolah->nama_sekolah;?></option>
                  <?php
                  } ?>
                </datalist>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6">
                <input type="email" name="email_sekolah" id="email_sekolah" class="form-control" placeholder="Email Sekolah" tabindex="3">
              </div>
              <div class="form-group col-sm-6">
                <input type="text" name="telepon_sekolah" id="telepon_sekolah" class="form-control" placeholder="Nomor Telepon" tabindex="4">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <textarea id="alamat_sekolah" name="alamat_sekolah" class="form-control" placeholder="Alamat Sekolah" rows="4" tabindex="6"></textarea>
              </div>
            </div>
            <br>
            <div class="alert alert-danger" style="display:none;" id="alertDangerTambahSekolah">
              <i class="glyphicon glyphicon-alert"></i> Sekolah gagal ditambahkan
            </div>
            <div class="alert alert-success" style="display:none;" id="alertSuccessTambahSekolah">
              <i class="glyphicon glyphicon-thumbs-up"></i> Sekolah berhasil ditambahkan
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="closeTambahSekolah">Close</button>
          <button type="submit" name="submitButton" id="submitTambahSekolah" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>