<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
  <title>Prime Mobile Activation Code</title>
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

							<h2>Prime Mobile Activation Code</h2>
							<br>

							<div class="body-text">
								Berikut tercantum dibawah ini Kode Aktivasi Anda,
								<br><br>

								
								<?php	foreach($table_data as $data){ ?>
									<table border="0" width="100%" height="100%" cellpadding="5" cellspacing="0">
										<tr style="background-color: #F0F0F0;">
											<td><i>Tipe Voucher</i></td>
										</tr>
										<tr>
											<td><?= $data->tipe == "0" ? $data->durasi.' Bulan Pemakaian' : $data->durasi.' Bulan Pemakaian (Premium)' ?></td>
										</tr>
										<tr style="background-color: #F0F0F0;">
											<td><i>Kode Aktivasi</i></td>
										</tr>
										<tr>
											<td><b><?=substr($data->no_aktivasi,0,4).''.substr($data->no_aktivasi,4,4).''.substr($data->no_aktivasi,8,4).''.substr($data->no_aktivasi,12,4)?></b></td>
										</tr>
									</table><br><br>
								<? } ?>
								
								<br>
								<h4><u>Keterangan:</u></h4>
								1. Pemakaian untuk <?php echo $data->durasi ?> bulan sejak dilakukan aktivasi<br>
								2. Jika anda masih memiliki masa berlaku pemakaian maka proses aktivasi akan menambah masa berlaku pemakaian anda
								<br><br>
								
								<h4><u>Petunjuk Cara Aktivasi</u></h4>
								1. Login ke Halaman user <a href="http://primemobile.co.id/login">www.primemobile.co.id</a><br>
								2. Pilik Menu <a href="http://primemobile.co.id/user/aktivasi">Aktivasi</a><br>
								3. Masukkan Kode Aktivasi<br>
								4. Pilih Kelas<br>
								5. Klik Submit<br>
								
							</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left">
            <br><br>
            &copy; 2017 Prime Mobile.
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
