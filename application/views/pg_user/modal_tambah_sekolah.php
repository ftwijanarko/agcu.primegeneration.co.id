<!-- Modal -->
<div class="modal fade" id="modalTambahSekolah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-info" id="myModalLabel">
          <i class="glyphicon glyphicon-question-sign"></i> Tidak menemukan sekolahmu?
        </h4>
      </div>
      <form action="<?php echo base_url('signup/ajax_tambah_sekolah');?>" method="post" id="formTambahSekolah">
        <div class="modal-body text-center">
          <p>Kamu bisa menambahkan sekolahmu dengan mengisi <br>form data sekolahmu di bawah ini: </p>
            <div class="form-inline">
              <div class="form-group">
                <input type="hidden" id="hidden_id_kota" name="hidden_id_kota" placeholder="kota">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6">
                <select id="select_jenjang" name="select_jenjang" class="form-control chosen-select">
                  <option value="" selected disabled>Pilih jenjang...</option>
                  <?php 
                  foreach ($select_jenjang as $jenjang) 
                  { ?>
                  <option value="<?php echo $jenjang->jenjang?>"><?php echo $jenjang->jenjang;?></option>
                  <?php
                  } ?>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <input type="text" id="tambah_sekolah" name="tambah_sekolah" class="form-control awesomplete" list="mylist" placeholder="Nama Sekolah">
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
                <input type="email" id="email_sekolah" name="email_sekolah" class="form-control" placeholder="Email Sekolah">
              </div>
              <div class="form-group col-sm-6">
                <input type="number" id="telepon_sekolah" name="telepon_sekolah" class="form-control" placeholder="Telepon Sekolah">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <textarea id="alamat_sekolah" name="alamat_sekolah" class="form-control" placeholder="Alamat Sekolah" rows="4"></textarea>
              </div>
            </div>
            <!-- <small class="help-block"><em><b>Contoh:</b> SD Negeri 1 Malang</em></small> -->
            <br>
            <div class="alert alert-danger" style="display:none;" id="alertDangerTambahSekolah">
              <i class="glyphicon glyphicon-alert"></i> Sekolah gagal ditambahkan
            </div>
            <div class="alert alert-success" style="display:none;" id="alertSuccessTambahSekolah">
              <i class="glyphicon glyphicon-thumbs-up"></i> Sekolah berhasil ditambahkan
            </div>
        </div>
        <div class="modal-footer bg-info">
          <button type="button" id="tutupmodal" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submitButton" id="submitTambahSekolah" class="btn btn-primary" value="Tambahkan"></input>
        </div>
      </form>
    </div>
  </div>
</div>