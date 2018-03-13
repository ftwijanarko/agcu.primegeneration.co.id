<!-- =========================== Delete Transaksi Confirmation Modal =========================== -->
<div id="unlockBonus_modal" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <h4 class="modal-title" id="unlockBonus_label"><i class="glyphicon glyphicon-lock text-info"></i> Konfirmasi Unlock</h4>
      </div>
      <div class="modal-footer well">
        <div class="container-fluid">
          <form id="unlockBonus_form" name="unlockBonus_form" action="<?php echo base_url().'user/ajax_update_bonus_unlock';?>" method="post">
            <div class="form-horizontal">
              <div class="form-group">
                <div class="form-inline">
                  <input type='hidden' name="hidden_row_id" id="hidden_row_id"/>
                </div>
                <p class='text-center'> Apakah kamu ingin membuka bonus <b><span class="judul_bonus"><span></b>?</p>
               </div>
            </div>
            <button type="submit" name="unlockBonus_submit" value="submit" class="btn btn-info"><i class="glyphicon glyphicon-check"></i> Ya</button>
            <a class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-share-alt"></i> Tidak</a>
          </form>
        </div>
        <br>
        <div class="alert alert-danger text-center" style="display:none;" id="alertDangerUnlockBonus">
          <i class="glyphicon glyphicon-alert"></i> <span id="msgDangerUnlockBonus">Bonus gagal dibuka</span>
        </div>
        <div class="alert alert-success text-center" style="display:none;" id="alertSuccessUnlockBonus">
          <i class="glyphicon glyphicon-thumbs-up"></i> <span id="msgSuccessUnlockBonus">Bonus berhasil dibuka</span>
        </div>
      </div>
    </div>
  </div>
</div>