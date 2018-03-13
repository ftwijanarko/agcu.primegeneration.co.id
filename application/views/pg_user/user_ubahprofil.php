		<?php include('header_global.php'); ?>
		<?php include('navigation_global.php');?>

    <div class="b-dot" style="margin-top:70px;">
			<div class="col-lg-12">

        <div class="row row-login">

          <div class="col-sm-12">
            <div id="ubah_data_pribadi" class="tab-pane fade in active">
              <div class="form-login col-xs-12 col-sm-12 col-md-8">
                <?php echo $this->session->flashdata('alert'); ?>
                
									<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#tabprofil" aria-controls="profil" role="tab" data-toggle="tab">Data Pribadi</a></li>
									<li role="presentation"><a href="#tabsekolah" aria-controls="tabsekolah" role="tab" data-toggle="tab">Sekolah</a></li>
									<li role="presentation"><a href="#tabpassword" aria-controls="tabsekolah" role="tab" data-toggle="tab">Ganti Password</a></li>
									</ul>
					
									<div class="tab-content" style="text-align: left;">
										<div role="tabpanel" class="tab-pane active" id="tabprofil">
											<form id="edit-profile-form" class="edit-profile-form" action="<?php echo base_url("user/proses_edit_profil");?>" method="post" enctype="multipart/form-data" style="padding:10px 0px;">
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
													<select class="form-control input-style select2_single" id="gender" name="gender">
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
													<hr>
													<input type="submit" class="btn btn-primary" value="Update Profile" />
												</div>
												</form>
										</div>
										<div role="tabpanel" class="tab-pane" id="tabsekolah">
											<form action="<?php echo base_url("user/proses_edit_sekolah");?>" method="post" class="edit-profile-form" style="padding:10px 0px;">
												<div class="form-group">
													<div class="label-style" style="width: auto;">Pilih Provinsi</div>
													<select name="provinsi" class="form-control select2_single" style="width:100%" id="pilihprovinsi">
													<option value="">Pilih Provinsi...</option>
													<?php
														foreach($select_provinsi as $provinsi){
													?>
													<option value="<?php echo $provinsi->id_provinsi; ?>" <?= $provsiswa == $provinsi->id_provinsi ? 'selected' : '' ?>><?php echo $provinsi->nama_provinsi; ?></option>
													<?php
														}
													?>
													</select>
												</div>
												
												<div class="form-group">
													<div class="label-style" style="width: auto;">Pilih Kota/Kabupaten</div>
													<select name="kota" class="form-control select2_single" style="width:100%" id="pilihkota">
													<option value="" disabled selected>Pilih Kota/Kabupaten...</option>
													<?php
														foreach($select_kabupaten as $kab){
													?>
													<option value="<?php echo $kab->id_kota; ?>" <?= $kotasiswa == $kab->id_kota ? 'selected' : '' ?>><?php echo $kab->nama_kota; ?></option>
													<?php
														}
													?>
													</select>
												</div>
												
												<div class="form-group">
													<div class="label-style" style="width: auto;">Nama Sekolah<?= $infosiswa->sekolah_id ?></div>
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
														<select class="form-control select2_single" tabindex="1" style="width: 100%;" name="sekolah" data-placeholder="Pilih Sekolah..." data-fv-field="sekolah" id="pilihsekolah" name="sekolah">
														<option selected="" disabled="" value="">Pilih Sekolah...</option>
														<?php
															foreach($select_sekolah as $skl){
														?>
														<option value="<?php echo $skl->id_sekolah; ?>" <?= $infosiswa->sekolah_id == $skl->id_sekolah ? 'selected' : '' ?>><?php echo $skl->nama_sekolah; ?></option>
														<?php
															}
														?>
														</select>
													</div>
													<div id="sekolahnew" style="display: none;">
														<input type="text" name="sekolahbaru" class="form-control" style="width: 100%;" placeholder="Masukkan Nama Sekolah Baru"/>
													</div>
													</div>
												 </div>
												 <div class="form-group" style="display: none;" id="jenjang">
													<div class="label-style" style="width: auto;">Jenjang Sekolah</div>
													<select name="jenjang" id="jenjangbaru" class="form-control select2_single" style="width: 100%;">
														<option value="">Pilih Jenjang</option>
														<option value="SD">SD</option>
														<option value="SMP">SMP</option>
														<option value="SMA">SMA</option>
													</select>
												 </div>
												 <div class="form-group">
													<div class="label-style" style="width: auto;">Kelas</div>
													<select name="kelas" id="kelassekolah" class="form-control select2_single" style="width: 100%;">
														<option value="">Pilih Kelas</option>
														<?php
															foreach($select_kelas as $kls){
														?>
														<option value="<?php echo $kls->id_kelas; ?>" <?= $infosiswa->kelas == $kls->id_kelas ? 'selected' : '' ?>><?php echo $kls->alias_kelas; ?></option>
														<?php
															}
														?>
													</select>
												 </div>
												 <div class="form-group">
													<hr>
													<input type="submit" class="btn btn-primary" value="Update Profile" />
												 </div>
												 <input type="hidden" name="jenis" id="jenis" value="lama"/>
												</form>
										</div>
										<div role="tabpanel" class="tab-pane" id="tabpassword">
											<form action="<?php echo base_url("user/ganti_password");?>" method="post" class="edit-profile" style="padding:10px 0px;">
												<div class="form-group">
													<div class="label-style" style="width: auto;">Password Lama</div>
													<input type="password" class="form-control" name="oldpassword" required/>
												</div>
												
												<div class="form-group">
													<div class="label-style" style="width: auto;">Password Baru</div>
													<input type="password" class="form-control" name="newpassword" required/>
												</div>
												
												<div class="form-group">
													<div class="label-style" style="width: auto;">Ulangi Password Baru</div>
													<input type="password" class="form-control" name="renewpassword" required/>
												</div>
												
												<div class="form-group">
													<hr>
													<input type="submit" class="btn btn-primary" value="Update Password" />
												 </div>
											</form>
										</div>
									</div>
									
									
								</div>
							</div>

						<div class="clearfix"></div>
          </div> <!-- /tab-content -->
        </div>
      </div>        
			<div class="clearfix"></div>
    </div>
		<script>
		$(function(){
			$("#kelas").change(function(){
				$("#profil").load("profil/" + $("#kelas").val());
			});
			$("#profil").change(function(){
				$("#tryout").load("tryout/" + $("#profil").val());
			});
			$("#pilihkelas").change(function(){
				$("#pilihmapel").load("pilihmapel/" + $("#pilihkelas").val());
			});
			$("#pilihmapel").change(function(){
				$("#materi").load("materi/" + $("#pilihmapel").val());
			});
			
			$("#dropkelas li").click(function() {
				$("#dropmapel").load("pilihmapel/" + $(this).attr('id'));
			});
			
			$("#dropkelastryout li").click(function() {
				$("#dropprofil").load("profil/" + $(this).attr('id'));
			});

			$('#cari').keypress(function (e) {
				if (e.which == 13) {
				$("#materi").load("carimateri/" + encodeURIComponent($(this).val()));
				}
			});
			
			$("#pilihprovinsi").change(function(){
				$("#pilihkota").load("../signup/kota/" + $("#pilihprovinsi").val());
			});
			
			$("#pilihkota").change(function(){
				$("#btnTambahSekolah").prop('disabled', false);
				$("#pilihsekolah").load("../signup/sekolah/" + $("#pilihkota").val());
			});
			
			$("#pilihsekolah").change(function(){
				$("#kelassekolah").load("kelasbysekolah/" + $("#pilihsekolah").val());
			});
			$("#jenjangbaru").change(function(){
				$("#kelassekolah").load("kelasbyjenjang/" + $("#jenjangbaru").val());
			});
			
			
			$("#simpansekolahbaru").click(function(){
				$("#pilihsekolah").html("<option value='sekolahbaru'>"+ $("#sekolahbaru").val()+ "</option>");
			});
		});
		</script>
		
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
    <!-- Pilih Data -->
<!--        <script type="text/javascript" src="<?php //echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>"></script>-->
    <script type="text/javascript">
//            var config = {
//                '.chosen-select'           : {},
//                '.chosen-select-deselect'  : {allow_single_deselect:true},
//                '.chosen-select-no-single' : {disable_search_threshold:10},
//                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//                '.chosen-select-width'     : {width:"100%"}
//            }
//            for (var selector in config) {
//                $(selector).chosen(config[selector]);
//            }
    </script>

    <script type="text/javascript">
      function fetch_select_kelas(val)
      {
        // console.log("val -> "+val);
        $.ajax({
          type: 'POST',
          url: "<?=base_url('user/ajax_select_kelas')?>",
          data: { id:val },
          success: function(response){
            document.getElementById('kelas').innerHTML=response;
            
            $("#kelas").trigger("chosen:updated");
          }
        });
      }
    </script>
    
    <!-- Validasi -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.steps.min.js');?>"></script>
    
    <!-- Facebook Login -->
    <script>
      // Load the SDK asynchronously
     
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
        
      window.fbAsyncInit = function() {
      FB.init({
        appId      : '674931862665310', //Your APP ID
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.7' // use version 2.1
      });

      // These three cases are handled in the callback function.
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });

      };
        
      // This is called with the results from from FB.getLoginStatus().
      function statusChangeCallback(response) {
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
        } 
        else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
          // document.getElementById('status').innerHTML = 'Please log ' +
          //   'into this app.';
        }
      }  

      function _login() {
        FB.login(function(response) {
           // handle the response
           if(response.status==='connected') {
            _link();
           }
         }, {scope: 'email, public_profile'});
      }

      function _logout() {
        FB.login(function(response) {
           // handle the response
           if(response.status==='connected') {
            _unlink();
           }
         }, {scope: 'email, public_profile'});
      }

      function _link(){
        FB.api('/me?fields=name, email', function(response) {
          // console.log(response);
          $.ajax({
            url: "<?php echo base_url('user/link_akun_fb');?>",
            type: "post",
            data: { 'id': response.id },
            success: function(data, status) {
              // console.log('Link Status: ' + data);
              if(data == 'true') {
                $("#linkFbAccount").hide();
                $("#unlinkFbAccount").show();
              }
            },
            error: function(xhr, desc, err) {
              console.log(xhr);
              console.log("Details: " + desc + "\nError:" + err);
            }
          });
        });
      }

      function _unlink(){
         FB.api('/me?fields=name, email', function(response) {
            $.ajax({
            url: "<?php echo base_url('user/unlink_akun_fb');?>",
            type: "post",
            data: { 'id': response.id },
            success: function(data, status) {
              // console.log('Unlink Status: ' + data);
              if(data == 'true') {
                $("#unlinkFbAccount").hide();
                $("#linkFbAccount").show();
              }
            },
            error: function(xhr, desc, err) {
              console.log(xhr);
              console.log("Details: " + desc + "\nError:" + err);
            }
          });
        });
      }
    </script>


    <!-- Data Pribadi -->
    <script type="text/javascript">
      $(document).ready(function() {
        function adjustIframeHeight() {
          var $body   = $('body'),
            $iframe = $body.data('iframe.fv');
          if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
          }
        }

        // IMPORTANT: You must call .steps() before calling .formValidation()
        $('#profileForm')
          .steps({
            headerTag: 'h2',
            bodyTag: 'section',
            onStepChanged: function(e, currentIndex, priorIndex) {
              // You don't need to care about it
              // It is for the specific demo
              adjustIframeHeight();
            },
            // Triggered when clicking the Previous/Next buttons
            onStepChanging: function(e, currentIndex, newIndex) {
              var fv         = $('#profileForm').data('formValidation'), // FormValidation instance
                // The current step container
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

              // Validate the container
              fv.validateContainer($container);

              var isValidStep = fv.isValidContainer($container);
              if (isValidStep === false || isValidStep === null) {
                // Do not jump to the next step
                return false;
              }

              return true;
            },
            // Triggered when clicking the Finish button
            onFinishing: function(e, currentIndex) {
              var fv         = $('#profileForm').data('formValidation'),
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

              // Validate the last step container
              fv.validateContainer($container);

              var isValidStep = fv.isValidContainer($container);
              if (isValidStep === false || isValidStep === null) {
                return false;
              }

              return true;
            },
            onFinished: function(e, currentIndex) {
              // Uncomment the following line to submit the form using the defaultSubmit() method
              $('#profileForm').formValidation('defaultSubmit');

              // For testing purpose
              // $('#welcomeModal').modal();
            }
          })
          .formValidation({
            icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
          
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: ':disabled',
            fields: {
              namalengkap: {
                validators: {
                  notEmpty: {
                    message: 'Nama Lengkap harus diisi'
                  }
                }
              },
              pengguna: {
                validators: {
                  notEmpty: {
                    message: 'Nama pengguna harus diisi'
                  },
                  stringLength: {
                    min: 6,
                    max: 30,
                    message: 'Nama pengguna minimal 6 karakter dan maksimal 30 karakter'
                  },
                  regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'Nama pengguna hanya terdiri dari alfabet, nomor, titik dan underscore'
                  }
                }
              },
              email: {
                validators: {
                  notEmpty: {
                    message: 'E-Mail harus diisi'
                  },
                  emailAddress: {
                    message: 'E-Mail tidak valid'
                  }
                }
              },
              nohp: {
                message: 'Nomor handphone tidak valid',
                validators: {
                  numeric: {
                    message: 'Nomor handphone harus berbentuk angka'
                  }
                }
              },
              nohp_ortu: {
                message: 'Nomor handphone tidak valid',
                validators: {
                  numeric: {
                    message: 'Nomor handphone harus berbentuk angka'
                  }
                }
              },
              foto: {
                message: 'Foto profil tidak valid',
                validators: {
                  file: {
                    extension: 'jpeg,jpg,gif,png,bmp',
                    type: 'image/jpeg,image/gif,image/png,image/x-ms-bmp',
                    maxSize: 2097152,
                    message: 'File harus bertipe JPEG/JPG/GIF/PNG/BMP dan kurang dari 2 MB'
                  }
                }
              },
              katasandi: {
                validators: {
                  // notEmpty: {
                  //   message: 'Kata sandi harus diisi'
                  // },
                  different: {
                    field: 'username',
                    message: 'Kata sandi tidak boleh sama dengan nama pengguna'
                  }
                }
              },
              konfirmasi: {
                validators: {
                  // notEmpty: {
                  //   message: 'Konfirmasi Kata sandi harus diisi'
                  // },
                  identical: {
                    field: 'katasandi',
                    message: 'Konfirmasi kata sandi harus sama dengan kata sandi yang dimasukkan'
                  }
                }
              }
            }
          });
      });
      </script>
    
    <?php include('footer_global.php');?>
    
