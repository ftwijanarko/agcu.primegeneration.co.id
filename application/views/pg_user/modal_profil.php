<div id="edit-profile" class="edit-profile-wrapper">
    <div class="edit-profile-container">
      <div class="header"><img src="<?php echo base_url('assets/dashboard/images/logo.png');?>"></div>
      <h4>Lengkapi Profil Anda</h4><a href="javascript:;" class="close"><span class="glyphicon glyphicon-remove"></span></a>
	  
	  
	  <!-- Nav tabs -->
	  <div>
	  <ul class="nav nav-tabs" role="tablist" style="margin: 0 75px 35px;">
		<li role="presentation" class="active"><a href="#tabprofil" aria-controls="profil" role="tab" data-toggle="tab">Data Pribadi</a></li>
		<li role="presentation"><a href="#tabsekolah" aria-controls="tabsekolah" role="tab" data-toggle="tab">Sekolah</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="tabprofil">
		  <form id="edit-profile-form" class="edit-profile-form" action="<?php echo base_url("user/proses_edit_profil");?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
			  <div class="label-style required">Nama</div>
			  <input class="input-style form-control" type="text" id="name" name="nama" value="<?php echo $infosiswa->nama_siswa; ?>">
			</div>
			<div class="form-group">
			  <div class="label-style">Nomor HP</div>
			  <input class="input-style form-control" type="text" id="phone" name="phone" value="<?php echo $infosiswa->telepon_siswa; ?>">
			</div>
			<div class="form-group">
			  <div class="label-style required">Email</div>
			  <input class="input-style form-control" type="text" id="email" name="email" value="<?php echo $infosiswa->email_siswa; ?>">
			</div>
			<div class="form-group">
			  <div class="label-style required">Jenis Kelamin</div>
			  <select class="form-control input-style" id="gender" name="gender">
				  <?php
					if($infosiswa->jenis_kelamin == 1){
				  ?>
					<option value="<?php echo $infosiswa->jenis_kelamin; ?>">Laki - laki</option>
					<option value="2">Perempuan</option>
				  <?php
					}elseif($infosiswa->jenis_kelamin == 2){
				  ?>
					<option value="<?php echo $infosiswa->jenis_kelamin; ?>">Perempuan</option>
					<option value="1">Laki - Laki</option>
				  <?php
					}else{
				  ?>
					<option value="1">Laki - laki</option>
					<option value="2">Perempuan</option>
				  <?php
					}
				  ?>
			  </select>
			</div>
			<div class="form-group">
			  <div class="label-style required">Alamat</div>
			  <input class="input-style form-control" type="text" id="name" name="alamat" value="<?php echo $infosiswa->alamat; ?>">
			</div>
			<div class="form-group">
			  <div class="label-style">Ganti Foto</div>
			  <input class="input-style" type="file" name="foto" id="exampleInputFile">
			</div>
			<div class="form-group">
			  <div class="label-style">&nbsp;</div>
			  <button name="csubmit" type="submit" class="btn btn-primary">Simpan</button>&nbsp;
			</div>
		  </form>
		</div>
		
		<div role="tabpanel" class="tab-pane" id="tabsekolah">
		<form action="<?php echo base_url("user/proses_edit_sekolah");?>" method="post" class="edit-profile-form">
			<div class="form-group">
			  <div class="label-style">Pilih Provinsi</div>
			  <select name="provinsi" class="form-control" id="pilihprovinsi">
				<option value="">Pilih Provinsi...</option>
				<?php
					foreach($select_provinsi as $provinsi){
				?>
				<option value="<?php echo $provinsi->id_provinsi; ?>"><?php echo $provinsi->nama_provinsi; ?></option>
				<?php
					}
				?>
			  </select>
			</div>
			
			<div class="form-group">
			  <div class="label-style">Pilih Kota/Kabupaten</div>
			  <select name="kota" class="form-control" id="pilihkota">
				<option value="" disabled selected>Pilih Kota/Kabupaten...</option>
			  </select>
			</div>
			
			<div class="form-group">
			  <div class="label-style">Nama Sekolah</div>
			  <!-- <input class="input-style form-control" type="text" id="remail2" name="remail2" placeholder="Nama Sekolah"> -->
			  <div class="form-group">
				&nbsp;
			  </div>
			  <div class="input-group" style="width: 100%;">
				<span class="input-group-btn">
				<button id="btnTambahSekolah" class="btn btn-default" title="Tambahkan sekolah baru" type="button" onclick="tambah_sekolah()" disabled>
				<i class="glyphicon glyphicon-plus"></i>
				</button>
				<button id="bataltambahsekolah" class="btn btn-default" title="Batal tambah sekolah" type="button" onclick="batal_sekolah()" style="display: none;">
				<i class="glyphicon glyphicon-remove"></i>
				</button>
				</span>
				<div id="sekolah">
					<select class="form-control chosen-select" tabindex="1" style="width: 100%;" name="sekolah" data-placeholder="Pilih Sekolah..." data-fv-field="sekolah" id="pilihsekolah" name="sekolah">
					<option selected="" disabled="" value="">Pilih Sekolah...</option>
					</select>
				</div>
				<div id="sekolahnew" style="display: none;">
					<input type="text" name="sekolahbaru" class="form-control" style="width: 100%;" placeholder="Masukkan Nama Sekolah Baru"/>
				</div>
			  </div>
			 </div>
			 <div class="form-group" style="display: none;" id="jenjang">
				<div class="label-style">Jenjang Sekolah</div>
				<select name="jenjang" id="jenjangbaru" class="form-control" style="width: 100%;">
					<option value="">Pilih Jenjang...</option>
					<option value="SD">SD</option>
					<option value="SMP">SMP</option>
					<option value="SMA">SMA</option>
				</select>
			 </div>
			 <div class="form-group">
				<div class="label-style">Kelas</div>
				<select name="kelas" id="kelassekolah" class="form-control" style="width: 100%;">
				</select>
			 </div>
			 <div class="form-group">
				<p>&nbsp;
				<p>&nbsp;
				<input type="submit" class="btn btn-primary" value="simpan" />
			 </div>
			 <input type="hidden" name="jenis" id="jenis" value="lama"/>
			</form>
		</div>
	  </div>
	  </div>
	  
      
    </div>
  </div>
  <script>
function tambah_sekolah(){
	//document.getElementById('sekolah').innerHTML = "<input type='text' name='sekolahbaru' class='form-control' />"
	var btnTambahSekolah = document.querySelector("#btnTambahSekolah");
	var bataltambahsekolah = document.querySelector("#bataltambahsekolah");
	var sekolah = document.querySelector("#sekolah");
	var jenjang = document.querySelector("#jenjang");
	var sekolahnew = document.querySelector("#sekolahnew");
	
	sekolah.style.display = "none";
	btnTambahSekolah.style.display = "none";
	bataltambahsekolah.style.display = "block";
	sekolahnew.style.display = "block";
	jenjang.style.display = "block";
	document.getElementById("jenis").value = "baru";
}
function batal_sekolah(){
	var btnTambahSekolah = document.querySelector("#btnTambahSekolah");
	var bataltambahsekolah = document.querySelector("#bataltambahsekolah");
	var sekolah = document.querySelector("#sekolah");
	var jenjang = document.querySelector("#jenjang");
	var sekolahnew = document.querySelector("#sekolahnew");
	
	sekolah.style.display = "block";
	btnTambahSekolah.style.display = "block";
	bataltambahsekolah.style.display = "none";
	sekolahnew.style.display = "none";
	jenjang.style.display = "none";
	jenjang.style.display = "none";
	document.getElementById("jenis").value = "lama";
}
</script>