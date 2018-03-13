<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Semua Pembayaran</h4>
                <p class="category">Daftar transaksi siswa</p>
								<a class="btn btn-default pull-right" href="<?php echo base_url('pg_admin/pembayaran/beli_paket'); ?>" style="margin-top:-45px;"><i class="glyphicon glyphicon-plus"></i> Tambah Pembelian</a>
              </div>
              <div class="content">
								<?php if ($this->session->flashdata('sukses') != ''){ ?>
								<div style="margin-bottom:15px;"><div class="label label-success"><?php echo $this->session->flashdata('sukses'); ?></div></div>
								<?php } ?>
                <div class="table-responsive">
                <form action="pembayaran/confirmall" method="post">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <!--<th><input type="checkbox" onClick="toggle(this)" /></th>-->
                        <th>No. Invoice</th>
                        <th>Nama</th>
                        <th>Total Harga (Rp)</th>
                        <th>Metode Pembayaran</th>
                        <th>Expired On</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">File Bukti</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1; 
                        foreach ($table_data as $item) 
                        {
                      ?>
                        <tr>
							<td><?php echo $no;?></td>
							<!--
							<td>
								<input type="checkbox" name="check[]" value="<?php echo $item->id_pembelian; ?>"></input>
							</td>
							-->
							<td><?php echo $item->no_tagihan?></td>
							<td>
							<?php 
							  if ($item->siswa_id != 0 && $item->metode_pembayaran < 3){
								  echo $item->nama_siswa;
							  } else if ($item->siswa_id == 0 && $item->metode_pembayaran < 3){
								  echo ($item->email != '' ? $item->email.'<br>' : '').'(Umum)';
							  } else if ($item->siswa_id != 0 && $item->metode_pembayaran == 3){
								  echo ($item->nama_siswa != '' ? $item->nama_siswa.'<br>' : '').'(Indihome)';
							  } else if ($item->siswa_id == 0 && $item->metode_pembayaran == 4){
								  echo ($item->email != '' ? $item->email.'<br>' : '').'(Sekolah)';
							  } else {
								  echo 'Unknown';
							  }
							?>
							</td>
							<td class="text-right"><?php echo number_format($item->total_harga, null, null, ".");?></td>
							<td class="text-center">
							  <?php
							  if ($item->metode_pembayaran == 1){ 
								echo 'Transfer';
							  } else if ($item->metode_pembayaran == 2){
								echo 'Indomaret';
							  } else if ($item->metode_pembayaran == 3){
								echo 'Indihome';
							  } else if ($item->metode_pembayaran == 4){
								echo 'Sekolah';
							  }
							  ?>
							</td>
							<td><?php echo date('d M Y, H:i:s', strtotime($item->expired_on));?></td>
							<td class='text-center'>
							<?php echo $item->status?>
							</td>
							<td class='text-center'>
							<?php
                            if(strpos($item->status, 'Menunggu Konfirmasi')!==FALSE || (strpos($item->status, 'Confirmed')!==false && $item->siswa_id > 0 && $item->metode_pembayaran < 3)){
                            ?>
                              <a type="button" class="btn btn-info btn-fill" title="Lihat Bukti Pembayaran" data-number="<?php echo $no?>" href="<?php echo base_url()."assets/uploads/verifikasi/".$item->file_bukti; ?>" target="_BLANK"><i class="glyphicon glyphicon-picture"></i></a>
                            <?php
                            }
                            else{
                              echo "-";
                            }
							?>
							</td>
							<td class="text-center">
							<?php
                            if(($item->siswa_id == 0 && $item->angka_status == 1 && $item->metode_pembayaran == 1) || ($item->siswa_id > 0 && $item->angka_status == 1 && $item->metode_pembayaran == 1)){
                            ?>
								<a type="button" class="btn btn-success btn-fill" title="Terima Pembayaran" href='<?php echo base_url()."pg_admin/pembayaran/terima/".$item->id_pembelian; ?>'><i class="glyphicon glyphicon-ok"></i></a>                            
							<?php
                            }elseif($item->metode_pembayaran == 3 && $item->angka_status < 2){
								echo "-";
							} 
							else {
                              echo "-";
                            }
							?>
							</td>
                        </tr>
                      <?php
                        $no++;
                        }
                      ?>
                    </tbody>
                  </table>
									<!--
									<input type="submit" class="btn btn-success btn-fill" name="confirm" value="Konfirmasi Pembayaran & Kirim Kode Voucher"/>
									<input type="submit" class="btn btn-danger btn-fill" name="delete" value="Hapus Data Pembayaran"/>
									-->
								 </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

  </div> <!-- end .main-panel -->
</div>

<?php include "alert_file_bukti.php"; ?>

<?php include "alert_email_modal.php"; ?>

</body>

  <!--   Core JS Files   -->
 <script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
 <script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

 <!-- JS Function for this Modal -->
<script type="text/javascript">
  $('#file_bukti_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var rownumber = button.data('number') // Extract info from data-* attributes
    var gambar = button.attr('value')
    $("#gambar").attr("src", gambar);
  })
  $('#insert_email_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var rownumber = button.data('number') // Extract info from data-* attributes
    var id = button.attr('value')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.number').text("#" + rownumber + "?")
    modal.find('input[name=hidden_row_id]').val(id)
  })
</script>

<script>
function toggle(source) {
  checkboxes = document.getElementsByName('check[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

</html>
