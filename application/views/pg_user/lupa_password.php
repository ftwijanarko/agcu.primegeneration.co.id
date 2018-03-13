<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login | Prime Mobile - Cara belajar masa kini</title>
			
			<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Icon -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
		<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
		<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
		
		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom-2.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/edit.css">
	</head>
	<body>
		<div class="header">
			<!-- Navbar  -->
			<?php include('header_dynamic.php'); ?>
		<!-- /Header -->
		</div>
		<!-- Page Body -->
		<div class="page-body login">
			<div class="container">
				<div class="row row-centered">
					<div class="col-xs-12 col-sm-6 col-md-5 col-centered">
						<?php echo $this->session->flashdata('alert'); ?>

            <div class="panel panel-warning">
              <?php $key = (isset($_SESSION['recover']['key'])) ? $_SESSION['recover']['key'] : 'expired';?>
              <form action="<?php echo base_url('lupa_password?key=').$key; ?>" name="formRecoverPassword" id="formRecoverPassword" method="post" class="log-form">
                <div class="panel-heading bg-warning">
                  <h4 class="text-warning">
                    <span class="glyphicon glyphicon-cog"></span> Pengaturan Password
                  </h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                      <input type="password" class="form-control form-custom" placeholder="Password baru" required name="katasandi">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-custom" placeholder="Konfirmasi password baru" required name="konfirmasi">
                    </div>
                </div>
                <div class="panel-footer">
                    <input type="submit" name="submitButton" value="Simpan Password" class="btn btn-full-width">
                </div>  
              </form>
            </div>
						
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<?php include('footer.php');?>
		<!-- /Footer -->

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>

    <script type="text/javascript">
    //Validator untuk modal_lupa_password
      $(document).ready(function() {
       $('#formRecoverPassword')
       .formValidation({
          icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
            katasandi: {
              validators: {
                notEmpty: {
                  message: 'Password baru harus diisi'
                }
              }
            },
            konfirmasi: {
              validators: {
                notEmpty: {
                  message: 'Konfirmasi Password baru harus diisi'
                },
                identical: {
                  field: 'katasandi',
                  message: 'Konfirmasi Password harus sama dengan Password yang dimasukkan'
                }
              }
            }
          }
        })
       // .on('success.form.fv', function(e, data) {
       //    // Prevent form submission
       //    e.preventDefault();
       //    var email = $("input[name^='email_reset']").val();
       //    var $form = $(e.target),
       //        fv    = $form.data('formValidation');

       //    if (fv.getSubmitButton()) {
       //        $.ajax({
       //          url: $form.attr('action'),
       //          type: 'POST',
       //          data: {email:email},
       //          success: function(response){
       //            if(response === 'true') {
       //              $("#alertDangerLupaPassword").slideUp();
       //              $("#alertSuccessLupaPassword").slideDown().delay(4000).slideUp();
       //            } 
       //            else {
       //              $("#alertSuccessLupaPassword").slideUp();
       //              $("#alertDangerLupaPassword").slideDown().delay(4000).slideUp();
       //            }
       //          }
       //        });
       //      }
       //  })

      });
    </script>

	</body>
</html>