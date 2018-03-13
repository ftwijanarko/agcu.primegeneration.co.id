    <?php include('header_global.php'); ?>
    
		<?php include('navigation_global.php'); ?>
		
		<!-- Page Body -->
		<div class="page-body login" style="margin-top: 80px;margin-bottom: 10px;min-height:310px;">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3"></div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<?php echo $this->session->flashdata('alert'); ?>
						
            <div class="x_panel b-dot">
  						<form action="<?php echo base_url() ?>login/do_login" method="post" class="log-form">
								<center><h3><i class="fa fa-lock"></i> LOGIN</h3></center>
								<hr>
  							<div class="form-group col-xs-12 col-sm-12 col-md-12">
  								<input type="text" class="form-control form-custom" placeholder="Username/E-mail" required name="username">
  							</div>
  							<div class="form-group col-xs-12 col-sm-12 col-md-12">
  								<input type="password" class="form-control form-custom" placeholder="Password" required name="password">
  							</div>
                <input type="hidden" class="form-control" id="akses" name="akses" value="siswa">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit" name="login" value="Login" class="btn btn-block btn-success">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<hr>
									<center>
									<!--<a href="#" id="" data-toggle="modal" data-target="#modalLupaPassword">Lupa Password?</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;-->
									<a href="<?php echo base_url('signup') ?>" class="btn btn-block btn-primary">Daftar Baru</a>
									</center>
								</div>
								<div class="clearfix"></div>
  						</form>
  						<!-- Ibnu -->

            </div>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3"></div>
				</div>
			</div>
		</div>

		<?php include('footer_global.php');?>
