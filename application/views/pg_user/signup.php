		<?php include('header_global.php');?>
		<?php include('navigation_global.php');?>
		<style>
		.form-horizontal .form-group {
				margin-left: 0px;
				margin-right: 0px;
		}
		</style>
		<script>
		$(function(){
			$("#pilihprovinsi").change(function(){
				$("#pilihkota").load("signup/kota/" + $("#pilihprovinsi").val());
			});

			$("#pilihkota").change(function(){
				$("#btnTambahSekolah").prop('disabled', false);
				$("#pilihsekolah").load("signup/sekolah/" + $("#pilihkota").val());
			});

			$("#simpansekolahbaru").click(function(){
				$("#pilihsekolah").html("<option value='sekolahbaru'>"+ $("#sekolahbaru").val()+ "</option>");
			});
		});
		</script>
    <section class="page" style="margin-top:70px;">
      <div class="container x_panel b-dot">

        <div class="row row-login">
          <div class="col-xs-12 col-sm-3 col-md-3"></div>
          <div class="form-login col-xs-12 col-sm-6 col-md-6">

            <center><h2 class="page-title center-title">Daftar Baru</h2></center>
						<hr>
            <form role="form" name="regform" id="profileForm" method="post" action="<?php echo base_url('signup/save');?>" enctype="multipart/form-data" class="form-horizontal">
              <!-- Data Pribadi -->
              <h2>Data Akun</h2>
              <section data-step="0">
                <div class="form-group">
				  
                <input type="hidden" class="form-control" id="fb_id" name="fb_id" placeholder="FB ID" style="display:none;">
                </div>
                <div class="form-group" style="text-align: left;">
									<label for="namalengkap">Nama Lengkap :</label>
                  <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Nama Lengkap" value="<?php echo set_value('namalengkap', '');?>">
                </div>
                <div class="form-group" style="text-align: left;">
									<label for="email">Email :</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email', '');?>">
                </div>
                <div class="form-group" style="text-align: left;">
									<label for="pengguna">Username :</label>
                  <input type="text" class="form-control" id="pengguna" name="pengguna" placeholder="Username" value="<?php echo set_value('pengguna', '');?>">
                </div>
                <div class="form-group" style="text-align: left;">
									<label for="katasandi">Password :</label>
                  <input type="password" class="form-control" id="katasandi" name="katasandi" placeholder="Password">
                </div>
                <div class="form-group" style="text-align: left;">
									<label for="konfirmasi">Ulangi Password :</label>
                  <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" placeholder="Konfirmasi Password">
                </div>
              </section>

              <!-- Data Sekolah -->
              <h2>Data Sekolah</h2>
              <section data-step="1"  style="text-align: left;">
                <div class="form-group">
									<label for="nohp">No HP :</label>
                  <input type="text" name="nohp" id="nohp" placeholder="Nomor Telepon Siswa" class="form-control" value="<?php echo set_value('nohp', '');?>">
                </div>
                <div class="form-group">
									<label for="nohp_ortu">No HP Orang Tua :</label>
                  <input type="text" name="nohp_ortu" id="nohp_ortu" placeholder="Nomor Telepon Orang Tua " class="form-control" value="<?php echo set_value('nohp_ortu', '');?>">
                </div>
                <div class="form-group pilih-data">
									<label for="provinsi">Provinsi :</label>
                  <select id="provinsi" placeholder="Pilih Provinsi..." name="provinsi" class="select2_single form-control" onchange="fetch_select_kota(this.value)" style="width: 100%;" tabindex="1" required="required">
                    <option value="" disabled selected>Pilih Provinsi...</option>
                    <?php 
                    foreach ($select_provinsi as $provinsi) 
                    { ?>
                    <option value="<?php echo $provinsi->id_provinsi?>"><?php echo $provinsi->nama_provinsi;?></option>
                    <?php
                    } ?>
                  </select>
                </div>
                <div class="form-group pilih-data">
									<label for="kota">Kota / Kabupaten :</label>
                  <select id="kota" data-placeholder="Pilih Kota/Kabupaten..." name="kota" class="form-control select2_single" onchange="fetch_select_sekolah(this.value)" style="width: 100%;" tabindex="1" required="required" disabled="disabled">
                    <option value="" disabled selected>Pilih Kota/Kabupaten...</option>
                    <?php 
                    foreach ($select_kota as $kota) 
                    { ?>
                    <option value="<?php echo $kota->id_kota?>"><?php echo $kota->nama_kota;?></option>
                    <?php
                    } ?>
                  </select>
                </div>
                
								<label for="sekolah" style="text-align: left;">Sekolah :</label>
								<div class="form-group pilih-data">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" id="btnTambahSekolah" class="btn btn-default" data-toggle="modal" data-target="#modalTambahSekolah" title="Tambahkan sekolah baru" disabled='disabled'>
                        <i class="glyphicon glyphicon-plus"></i>
                      </button>
                    </span>
                    <select id="sekolah" data-placeholder="Pilih Sekolah..." name="sekolah" class="form-control select2_single" onchange="fetch_select_kelas(this.value)" style="width: 100%;" tabindex="1" required="required" disabled="disabled">
                      <option value="" disabled selected>Pilih Sekolah...</option>
                      <?php 
                      foreach ($select_sekolah as $opt) { ?>
                        <option <?php echo set_select('sekolah', $opt->id_sekolah, (!isset($data_siswa->sekolah_id) ? FALSE : ($data_siswa->sekolah_id == $opt->id_sekolah ? TRUE : FALSE)) );?>
                          value="<?php echo $opt->id_sekolah ?>"> <?php echo $opt->nama_sekolah ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group pilih-data">
									<label for="kelas">Kelas :</label>
                  <select id="kelas" data-placeholder="Pilih Kelas..." name="kelas" id="kelas" class="form-control select2_single" style="width: 100%;" tabindex="1" required="required" disabled="disabled">
                    <option value="" disabled selected>Pilih Kelas...</option>
                    <?php 
                    foreach ($select_kelas as $item) { ?>
                      <option <?php echo set_select('kelas', $item->id_kelas, (!isset($data_siswa->id_kelas) ? FALSE : ($data_siswa->kelas == $item->id_kelas ? TRUE : FALSE)) );?>
                        value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </section>
            </form>

            <hr>
            <p class="hero-reg text-center">Sudah punya akun? klik <a href="<?php echo base_url('login') ?>" class="label label-info">disini</a> untuk masuk</p>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-3"></div>
        </div>
       
      </div>
    </section>

    <script type="text/javascript">
      function fetch_select_kota(val)
      {
        if($("#provinsi option:selected").val() != '') {
          $("#kota").attr('disabled', false);
          $("#btnTambahSekolah").attr('disabled', 'disabled'); 
          $.ajax({
            type: 'POST',
            url: "<?=base_url('signup/ajax_select_kota')?>",
            data: { id:val },
            success: function(response){
              document.getElementById('kota').innerHTML=response;              
              $("#kota").trigger("chosen:updated");
            }
          });
        }
        else {
          $("#kota").attr('disabled', 'disabled');
        }
      }

      function fetch_select_sekolah(val)
      {
        $('#hidden_id_kota').val(val);
        if($("#kota option:selected").val() != '') {
          $("#sekolah").attr('disabled', false);
          $("#btnTambahSekolah").attr('disabled', false); 
          $.ajax({
            type: 'POST',
            url: "<?=base_url('signup/ajax_select_sekolah')?>",
            data: { id:val },
            success: function(response){
              document.getElementById('sekolah').innerHTML=response;              
              $("#sekolah").trigger("chosen:updated");
            }
          });
        }
        else {
          $("#sekolah").attr('disabled', 'disabled');
          $("#btnTambahSekolah").attr('disabled', 'disabled');
        }
      }

      function fetch_select_kelas(val)
      {
        if($("#sekolah option:selected").val() != '') {
          $("#kelas").attr('disabled', false);  
          $.ajax({
            type: 'POST',
            url: "<?=base_url('signup/ajax_select_kelas')?>",
            data: { id:val },
            success: function(response){
              document.getElementById('kelas').innerHTML=response;
              
              $("#kelas").trigger("chosen:updated");
            }
          });
        }
        else {
          $("#kelas").attr('disabled', 'disabled');
        }
      }
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        var form = $('#formTambahSekolah');  
        form.submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: form.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: { 
              id_kota: $('#hidden_id_kota').val(),  
              jenjang: $('#select_jenjang').val(),  
              sekolah: $('#tambah_sekolah').val(),  
              email: $('#email_sekolah').val(),  
              telepon: $('#telepon_sekolah').val(),  
              alamat: $('#alamat_sekolah').val()  
            },
            success: function(response){
              if(response != 0) {
                fetch_select_sekolah( $('#hidden_id_kota').val() );
                //$("#alertDangerTambahSekolah").slideUp();
                //$("#alertSuccessTambahSekolah").slideDown().delay(5000).slideUp();
				$('#tutupmodal').click();
				$('#sekolah').load("signup/ajax_sekolah_baru/" + $("#kota").val() + "/" + response);
				
				$("#kelas").attr('disabled', false);  
				$('#kelas').load("signup/ajax_select_kelas_baru/" + response);
              }else {
                $("#alertSuccessTambahSekolah").slideUp();
                $("#alertDangerTambahSekolah").slideDown().delay(5000).slideUp();
              }
            }
          })

        });
      });
    </script>

    <!-- Validasi -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.steps.min.js');?>"></script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $("#btnLoginFb").on("click", function() {
          _login();
        });
      });
    </script>

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
          // _i();
          FB.api('/me?fields=name', function(response) {
            $("#labelLoginFb").text("Daftar sebagai " + response.name);
          });
        } else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
          // document.getElementById('status').innerHTML = 'Please log ' +
          //   'into this app.';
        }
      }  
      
      function _login() {
        FB.login(function(response) {
           // handle the response
           if(response.status==='connected') {
            _i();
           }
         }, {scope: 'email, public_profile'});
      }

      function _logout() {
          FB.logout(function(response) {
            // user is now logged out
          });
      }
     
     function _i(){
         FB.api('/me?fields=name, email', function(response) {
            // console.log(response);
            // $("#labelLoginFb").text("Masuk sebagai " + response.name);

            $.ajax({ 
              url: "<?php echo base_url('signup/cek_akun_fb')?>",
              type: 'post',
              data: { 'id': response.id },
              success: function(data, status) {
                // console.log("data: " + data);
                if(data == 'true') {
                  $("#fb_id").val(response.id);
                  $("#namalengkap").val(response.name);
                  $("#email").val(response.email);
                } 
                else if(data == 'false') {
                  // console.log("Hey it's false");
                  $("#fb_id").val("");
                  $("#alertLoginFb").fadeIn();
                }
              },
              error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
              }

             })
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
                    message: 'Username harus diisi'
                  },
                  stringLength: {
                    min: 6,
                    max: 30,
                    message: 'Username minimal 6 karakter dan maksimal 30 karakter'
                  },
                  regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'Username hanya terdiri dari alfabet, nomor, titik dan underscore'
                  },
                  remote: {
                    message: "Username telah terdaftar dalam database",
                    url: "<?php echo base_url('signup/ajax_cek_username'); ?>",
                    type: "post",
                    delay: 1000
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
                  },
                  remote: {
                    message: "E-mail telah terdaftar dalam database",
                    url: "<?php echo base_url('signup/ajax_cek_email'); ?>",
                    type: "post",
                    delay: 1000
                  }
                }
              },
              nohp: {
                message: 'Nomor telepon tidak valid',
                validators: {
                  notEmpty: {
                    message: 'Nomor telepon harus diisi'
                  },
                  numeric: {
                    message: 'Nomor telepon harus berbentuk angka'
                  }
                }
              },
              nohp_ortu: {
                message: 'Nomor telepon tidak valid',
                validators: {
                  notEmpty: {
                    message: 'Nomor telepon harus diisi'
                  },
                  numeric: {
                    message: 'Nomor telepon harus berbentuk angka'
                  }
                }
              },
              katasandi: {
                validators: {
                  notEmpty: {
                    message: 'Password harus diisi'
                  },
                  different: {
                    field: 'username',
                    message: 'Password tidak boleh sama dengan nama pengguna'
                  }
                }
              },
              konfirmasi: {
                validators: {
                  notEmpty: {
                    message: 'Konfirmasi Password harus diisi'
                  },
                  identical: {
                    field: 'katasandi',
                    message: 'Konfirmasi Password harus sama dengan Password yang dimasukkan'
                  }
                }
              }
            }
          });
      });
      </script>

    <?php include('modal_tambah_sekolah.php');?>
    <?php include('footer_global.php');?>

