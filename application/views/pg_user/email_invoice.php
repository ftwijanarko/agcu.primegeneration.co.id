<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
  <title>Voucher And Activation Code</title>
</head>
<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>

      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="background-color: #FFFFFF; padding: 20px;">
        <tr>
          <td class="container-padding header" align="left">
            <img src="http://primemobile.co.id/assets/dashboard/images/logo-red.png" alt="Logo Prime Mobile">
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left">
            <br>

							<h2>INVOICE PRIME MOBILE</h2>
							<br>

							<div class="body-text">
								
								<table border="0" width="100%" height="100%" cellpadding="5" cellspacing="0">
								  <tr>
									<td>Nomor Tagihan</td>
									<td>: #<?php echo $buy->no_tagihan?></td>
								  </tr>
								  <tr>
									<td>Tanggal/Waktu</td>
									<td>: <?php echo date('d/m/Y, H:i:s', strtotime($buy->timestamp));?></td>
								  </tr>
								  <tr>
									<td>Pemesan</td>
									<td>: <?php if ($buy->siswa_id > 0){ echo $buy->nama_siswa; } ?> <?php echo $buy->email ? "($buy->email)" : '';?></td>
								  </tr>
								  <tr>
									<td>Status</td>
									<td>: 
									  <?php
										if($buy->status == 0) { ?>  
										  <label style="color:red">Belum Lunas</label>
										<?php }
										elseif($buy->status == 1) { ?> 
										  <label style="color:orange">Menunggu Konfirmasi</label>
										<?php }
										elseif($buy->status == 2){ ?> 
										  <label style="color:green">Lunas</label>
										<?php }
										elseif($buy->status == 3){ ?> 
										  <label style="color:red">Dibatalkan</label>
										<?php } ?>
									</td>
								  </tr>
								  <tr>
									<td>Metode Bayar</td>
									<td>: <?php echo ($buy->metode_pembayaran == 1) ? 'Transfer' : 'Indomaret';?></td>
								  </tr>
								  <tr>
									<td>Batas Waktu Pembayaran</td>
									<td>: <label style="color:blue"><?php echo date('d/m/Y, H:i:s', strtotime($buy->expired_on));?></label></td>
								  </tr>
								</table><br><br>
								
								<table border="1" width="100%" height="100%" cellpadding="5" cellspacing="0">
								   <tr>
									 <th>ID Produk</th>
									 <th>Deskripsi Produk</th>
									 <th>Harga Satuan</th>
									 <th>Jumlah</th>
									 <th>Total</th>
								   </tr>
								  <?php 
								  foreach ($detail_pembelian as $item) 
								  { ?>
								  <tr>
									<td><?php echo $item->kode_paket;?></td>
									<td>Paket <?php echo ($item->tipe == 0) ? 'Reguler' : 'Premium'?> <?php echo $item->durasi;?> Bulan</td>
									<td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($item->harga_satuan);?>-</span></td>
									<td class="text-right"><?php echo $item->jumlah;?></td>
									<td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($item->jumlah * $item->harga_satuan);?>-</span></td>
								  </tr>
								  <?php
								  }?>
								  <tr>
									<td colspan="4" class="text-right"><strong>Grand Total</strong></td>
									<td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($buy->total_harga);?>-</span></td>
								  </tr>
								</table><br><br>

								
								<center><h4>Daftar Nomor Rekening untuk Transfer Pembayaran Voucher</h4></center>
								<table border="0" width="100%" height="100%" cellpadding="5" cellspacing="0">
								   <tr>
									 <td align="center">
										<img src="http://primemobile.co.id/assets/pg_user/images/icon/bank/bca.png" height="30%">
										<p>
										BANK BCA<br>
										A.n. Prime Generation<br>
										No. Rekening : 918-213-999-1
										</p>									 
									 </td>
									 <td align="center">
										<img src="http://primemobile.co.id/assets/pg_user/images/icon/bank/bri.png" height="30%">
										<p>
										BANK BRI<br>
										A.n. Prime Generation<br>
										No. Rekening : 0389-01-0002-20309
										</p>									 
									 </td>
								   </tr>
								   <tr>
									 <td align="center">
										<img src="http://primemobile.co.id/assets/pg_user/images/icon/bank/bni.png" height="30%">
										<p>
										BANK BNI<br>
										A.n. Prime Generation<br>
										No. Rekening : 14-0897-6000-00
										</p>									 
									 </td>
									 <td align="center">
										<img src="http://primemobile.co.id/assets/pg_user/images/icon/bank/mandiri.png" height="30%">
										<p>
										BANK MANDIRI<br>
										A.n. Prime Generation<br>
										No. Rekening : 1020-00-3078-265
										</p>									 
									 </td>
								   </tr>
								</table>
								
							</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left">
            <br><br>
            &copy; 2016 Prime Generation.
            <br><br>

            <a href="http://www.primemobile.co.id">www.primemobile.co.id</a><br>

            <br><br>

          </td>
        </tr>
      </table><!--/600px container -->

      <br><br>

    </td>
  </tr>
</table><!--/100% background wrapper-->

</body>
</html>
