<!-- =========================== Delete Transaksi Confirmation Modal =========================== -->
<div id="deleteRow_modal" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <h4 class="modal-title" id="deleteRow_label"><i class="glyphicon glyphicon-warning-sign text-danger"></i> Konfirmasi Hapus</h4>
      </div>
      <div class="modal-footer well">
        <div class="container-fluid">
          <form action="<?php echo $form_action . 'proses_hapus';?>" method="post">
            <div class="form-horizontal">
              <div class="form-group">
                <div class="form-inline">
                  <input type='hidden' name="hidden_row_id" id="hidden_row_id"/>
                </div>
                <p class='text-center'> Apakah anda ingin menghapus data <span class="number"><span></p>
               </div>
            </div>
            <button type="submit" name="deleteRow_submit" value="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ya</button>
            <a class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-share-alt"></i> Tidak</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>