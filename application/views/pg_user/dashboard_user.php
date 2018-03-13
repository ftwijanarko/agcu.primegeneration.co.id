		<?php include('header_global.php');?>
		<?php include('navigation_global.php');?>
    <div class="b-dot" style="margin-top:70px;">
			<div class="x_panel">
				<div class="well" style="margin-bottom:0px;">
					<div class="col-xs-12 col-sm-6 col-md-6" style="margin-bottom:10px;text-align:justify;">
						<h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
						<p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar anda dengan mengikuti Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, anda akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
						<form method="post" action="<?= base_url('agcutest/events/') ?>">
							<? if ($this->session->flashdata('pesan') != ''){ ?>
							<label class="label label-danger" style="padding:10px;display:block;width:100%;"><i><?= $this->session->flashdata('pesan') ?></i></label>
							<? } ?>
							<? if ($this->session->userdata('profilagcu') == NULL){ ?>
              <input type="text" name="kode" class="form-control" placeholder="Kode Aktivasi" value="" required="required" tabindex="1">
							<div class="clearfix" style="margin-top:10px;"></div>
							<button type="submit" class="btn btn-primary">Mulai AGCU</button>
							<? } else { ?>
							<a href="<?= base_url('agcutest/events/') ?>" class="btn btn-primary">Mulai AGCU</a>
							<? } ?>
						</form>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-2"></div>
					<div class="col-xs-12 col-sm-4 col-md-4" style="margin-bottom:0px;padding:20px;">
						<img class="img-responsive" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>">
					</div>
					<div class="clearfix"></div>
				</div>
				
				<br>
				
				<div class="well" style="margin-bottom:10px;">
					<p class="text-center">"<?php echo $quote->quote?>"</p>
					<p class="text-center"><i>-<?php echo $quote->tokoh?></i></p>
				</div>
				
			</div>
		</div>
		<?php include('footer_global.php'); ?>
