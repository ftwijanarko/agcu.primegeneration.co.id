<!-- Modal -->
<div class="modal fade" id="modalLupaPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-info" id="myModalLabel">
                    <i class="glyphicon glyphicon-question-sign"></i> Kamu Lupa Password?
                </h4>
            </div>
            <form action="<?=base_url('lupa_password/ajax_cek_email');?>" method="post" id="formLupaPassword">
                <div class="modal-body text-center">
                    <br>
                    <p>Masukkan alamat Emailmu di bawah ini, kemudian akan kami kirimkan email instruksi untuk mengatur ulang Passwordmu.</p>
                        <div class="form-group">
                            <input type="email" name="email_reset" class="form-control" placeholder="Alamat Email">
                        </div>
                        <div class="alert alert-danger" style="display:none;" id="alertDangerLupaPassword">
                            <i class="glyphicon glyphicon-alert"></i> Maaf, tidak ditemukan akun dengan alamat email ini
                        </div>
                        <div class="alert alert-success" style="display:none;" id="alertSuccessLupaPassword">
                            <i class="glyphicon glyphicon-ok-sign"></i> Email instruksi telah dikirim. Silahkan cek inbox emailmu 
                            <br> 
                            <span id="helpBlock" class="help-block">
                                <small style="font-style:italic">Jika kamu tidak menemukan email kami di Inboxmu, cobalah periksa di Spam</small>
                            </span>
                        </div>
                </div>
                <div class="modal-footer bg-info">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submitButton" id="submitLupaPassword" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Kirimkan Instruksi</button>
                </div>
            </form>
        </div>
    </div>
</div>