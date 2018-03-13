<!-- Modal -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <b class="modal-title" id="myModalLabel">
          <i class="glyphicon glyphicon-plus-sign"></i> Tambah Kategori Baru
        </b>
      </div>
      <form action="<?=base_url('pg_admin/bonus/ajax_tambah_kategori');?>" method="post" id="formTambahKategori">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" id="tambah_kategori" name="tambah_kategori" class="form-control awesomplete" list="mylist" placeholder="Kategori" style="width:100%" required="required">
            <datalist id="mylist">
              <?php 
              foreach ($select_options as $kategori) 
              { ?>
              <option value="<?php echo $kategori->kategori_bonus?>"><?php echo $kategori->kategori_bonus;?></option>
              <?php
              } ?>
            </datalist>
          </div>
          <br>
          <div class="alert alert-danger" style="display:none;" id="alertDangerTambahKategori">
            <i class="glyphicon glyphicon-alert"></i> Kategori Bonus gagal ditambahkan
          </div>
          <div class="alert alert-success" style="display:none;" id="alertSuccessTambahKategori">
            <i class="glyphicon glyphicon-thumbs-up"></i> Kategori Bonus berhasil ditambahkan
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submitButton" id="submitTambahKategori" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>