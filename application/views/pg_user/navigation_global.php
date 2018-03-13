		<nav class="navbar navbar-default navbar-prime navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?= base_url('home') ?>" class="navbar-brand"><img src="<?= ASSETS_IMAGE ?>/logo.png" style="height:45px; margin-top:-8px;"></a>
				</div>

				<? if (!empty($this->session->userdata('id_siswa'))){ ?>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
						<li><a href="<?php echo base_url('user/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown akun-name">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $infosiswa->foto == "" ? '<span class="glyphicon glyphicon-user icon"></span>' : '<div style="float:left;"><img class="img-circle" style="height:30px;margin-top:-4px;" src="'.base_url('assets/uploads/foto_siswa/'.$infosiswa->foto).'"></div>' ?> <span class="lbl-nama" style="margin-left:35px;"><?php echo $infosiswa->nama_siswa; ?> <span class="caret"></span></span></a>
              <ul id="drop-akun" class="dropdown-menu">
                <li><a href="<?php echo base_url('user');?>"><i class="fa fa-edit"></i> Profilku</a></li>
								<li><a href="<?php echo base_url('user/logout');?>"><i class="fa fa-lock"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
				</div><!-- /.navbar-collapse -->
				<? } ?>
			</div><!-- /.container-fluid -->
		</nav>

    <div class="container body">

        <div class="main_container">
