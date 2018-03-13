<!--



Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"

Tip 2: you can also add an image using data-image tag



-->

<style>

.nav > li > a {

    padding: 5px 15px;

}

.sidebar .nav {

    margin-top: 0px;

}

</style>

<?php

  //read uri segment to determine CSS active link

  $active = $this->uri->segment(2);

  $tambah = $this->uri->segment(4);

?>



<div class="sidebar" data-color="red" data-image="">

  <div class="sidebar-wrapper">

    <div class="logo">

      <a href="<?php echo base_url('pg_admin/dashboard'); ?>" class="simple-text">

          <img src="<?= ASSETS_IMAGE ?>/logo-white.png" style="height:45px; margin-bottom:-10px;">

      </a>

			<div style="font-size:14px;line-height:18px;margin-top:20px;">

			<b><?= strtoupper($this->session->userdata('nama')) ?></b><br>

			<? if ($this->session->userdata('idcabang') > 0 && $this->session->userdata('jabatan') == 'pimpinan'){ ?>

				<a href="<?php echo base_url("pg_admin/cabang/manajemen/ubah?id=".$this->session->userdata('idcabang'));?>" class="btn btn-info btn-xs" title="Update Profil Cabang" style="float:right;"><i class="fa fa-edit"></i></a>

			<? } ?>

			(<?= $this->session->userdata('idcabang') == 0 ? strtoupper($this->session->userdata('level')) : strtoupper($this->session->userdata('jabatan')) ?>)<br>

			<? if ($this->session->userdata('idcabang') > 0){ ?>

			<?= strtoupper($this->session->userdata('namacabang')) ?><br>

			ID Cabang : <?= $this->session->userdata('idcabang') ?>

			<? } ?>

			</div>

    </div>

		<div class="nav">

		</div>



    <ul class="nav">

        <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">

          <a href="<?php echo base_url('pg_admin/dashboard'); ?>">

              <i class="pe-7s-home"></i>

              <p>Dashboard</p>

          </a>

        </li>

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator") && ($this->session->userdata('jabatan') == "pusat")){

				?>

        <li class="sidebar-header"><span>Materi</span></li>

				<li class="<?php echo ($active=='kelas' ? 'active' : '')?>">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

							<i class="pe-7s-notebook"></i>

							<p>Kelas <b class="caret"></b></p>

					</a>

					<ul class="dropdown-menu sub-nav">

						<li>

							<a href="<?php echo site_url('pg_admin/kelas')?>">Semua Kelas</a>

						</li>

						<li>

							<a href="<?php echo site_url('pg_admin/kelas/manajemen/tambah')?>">Tambah Baru</a>

						</li>

					</ul>

				</li>

				<?php

					}

				?>



				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator") && ($this->session->userdata('jabatan') == "pusat")){

				?>

						<li class="<?php echo ($active=='mapel' ? 'active' : '')?>">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

									<i class="pe-7s-photo-gallery"></i>

									<p>Mata Pelajaran <b class="caret"></b></p>

							</a>

							<ul class="dropdown-menu sub-nav">

								<li>

									<a href="<?php echo site_url('pg_admin/mapel')?>">Semua Mata Pelajaran</a>

								</li>

								<li>

									<a href="<?php echo site_url('pg_admin/mapel/manajemen/tambah')?>">Tambah Baru</a>

								</li>

							</ul>

						</li>

				<?php

					}

				?>

		

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator" || $this->session->userdata('level') == "admin") && ($this->session->userdata('jabatan') == "pusat")){

				?>

				<li class="sidebar-header"><span>SOAL</span></li>

		

				<li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

						<i class="pe-7s-diskette"></i>

						<p>Bank Soal <b class="caret"></b></p>

					</a>

					<ul class="dropdown-menu sub-nav">

						<li class="<?php echo ($active=='kategoribanksoal' ? 'active' : '')?>">

							<a href="<?php echo site_url('pg_admin/banksoal/kategori') ?>">

								<p>Kategori Bank Soal</p>

							</a>

						</li>

						<li class="<?php echo ($active=='managebanksoal' ? 'active' : '')?>">

							<a href="<?php echo site_url('pg_admin/banksoal') ?>">

								<p>Manage Bank Soal</p>

							</a>

						</li>

					</ul>

				</li>

				<?php

					}

				?>



				<?php

					if($this->session->userdata('jabatan') != "konselor"){

				?>

        <li class="sidebar-header"><span>Siswa & Sekolah</span></li>

        <li class="<?php echo (($active=='siswa' && $tambah!='tambah') ? 'active' : '')?>">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

              <i class="pe-7s-id"></i>

              <p>Siswa<b class="caret"></b></p>

          </a>

          <ul class="dropdown-menu sub-nav">

            <li>

              <a href="<?php echo site_url('pg_admin/siswa/pendaftar')?>">Siswa Belum Aktif</a>

            </li>

            <li>

              <a href="<?php echo site_url('pg_admin/siswa/aktif')?>">Siswa Aktif</a>

            </li>

            <li>

              <a href="<?php echo site_url('pg_admin/siswa/manajemen/tambah')?>">Tambah Baru</a>

            </li>

            <li>

              <a href="<?php echo site_url('pg_admin/siswa/manajemen/import')?>">Import Data</a>

            </li>

          </ul>

        </li>

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator" || $this->session->userdata('level') == "admin")){

				?>

        <li class="<?php echo ($active=='sekolah' ? 'active' : '')?>">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

              <i class="pe-7s-study"></i>

              <p>Sekolah <b class="caret"></b></p>

          </a>

          <ul class="dropdown-menu sub-nav">

            <li>

              <a href="<?php echo site_url('pg_admin/sekolah')?>">Semua Sekolah</a>

            </li>

						<?php 

							if ($this->session->userdata('jabatan') == "pusat"){

						?>

            <li>

              <a href="<?php echo site_url('pg_admin/sekolah/manajemen/tambah')?>">Tambah Baru</a>

            </li>

            <li>

              <a href="<?php echo site_url('pg_admin/sekolah/manajemen/import')?>">Import Data</a>

            </li>

						<?php

							}

						?>

          </ul>

        </li>

				<?php

					}

				?>

				<?php

					}

				?>

		

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator" || $this->session->userdata('level') == "admin")){

				?>

        <!-- menu agcu test -->

        <li class="sidebar-header"><span>AGCU</span></li>

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator") && ($this->session->userdata('jabatan') == "pusat")){

				?>

				<li class="<?php echo ($active=='diagnosticmaster' ? 'active' : '')?>">

          <a href="<?php echo site_url('pg_admin/diagnosticmaster') ?>">

              <i class="pe-7s-note2"></i>

              <p>Profil AGCU Test</p>

          </a>

        </li>

				<?php

					}

				?>

				<li class="<?php echo ($active=='diagnostictest' ? 'active' : '')?>">

          <a href="<?php echo site_url('pg_admin/diagnostictest') ?>">

              <i class="pe-7s-note2"></i>

              <p>APPROVAL AGCU</p>

          </a>

        </li>

				<li class="<?php echo ($active=='diagnosticreport' ? 'active' : '')?>">

          <a href="<?php echo site_url('pg_admin/diagnosticreport') ?>">

              <i class="pe-7s-bookmarks"></i>

              <p>AGCU Report</p>

          </a>

        </li>

				<!-- end menu agcu test -->

				<?php

					}

				?>

		

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator" || $this->session->userdata('level') == "admin")){

				?>

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator")){

				?>

				<li class="sidebar-header"><span>Manajemen</span></li>

				<?php

					}

				?>

					<?php

						if(($this->session->userdata('level') == "superadmin") && ($this->session->userdata('jabatan') == "pusat")){

					?>

					<li class="<?php echo ($active=='cabang' ? 'active' : '')?>">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

								<i class="pe-7s-culture"></i>

								<p>Cabang <b class="caret"></b></p>

						</a>

						<ul class="dropdown-menu sub-nav">

							<li>

								<a href="<?php echo site_url('pg_admin/cabang')?>">Semua Cabang</a>

							</li>

							<li>

								<a href="<?php echo site_url('pg_admin/cabang/manajemen/tambah')?>">Tambah Baru</a>

							</li>

						</ul>

					</li>

					<?php

						}

					?>

					<?php

						if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator")){

					?>

					<li class="<?php echo ($active=='konselor' ? 'active' : '')?>">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

								<i class="pe-7s-user"></i>

								<p>Konselor <b class="caret"></b></p>

						</a>

						<ul class="dropdown-menu sub-nav">

							<li>

								<a href="<?php echo site_url('pg_admin/user/konselor')?>">Semua Konselor</a>

							</li>

							<li>

								<a href="<?php echo site_url('pg_admin/user/tambah1')?>">Tambah Baru</a>

							</li>

						</ul>

					</li>

					<?php

						}

					?>

					<?php

						if(($this->session->userdata('level') == "superadmin") && ($this->session->userdata('jabatan') == "pusat")){

					?>

					<li class="<?php echo ($active=='user' ? 'active' : '')?>">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

								<i class="pe-7s-user"></i>

								<p>User <b class="caret"></b></p>

						</a>

						<ul class="dropdown-menu sub-nav">

							<li>

								<a href="<?php echo site_url('pg_admin/user')?>">Semua User</a>

							</li>

							<li>

								<a href="<?php echo site_url('pg_admin/user/tambah')?>">Tambah Baru</a>

							</li>

						</ul>

					</li>

					<?php

						}

					?>

				<?php

					}

				?>

		

				<?php

					if(($this->session->userdata('level') == "superadmin" || $this->session->userdata('level') == "administrator" || $this->session->userdata('level') == "admin") && ($this->session->userdata('jabatan') == "pusat")){

				?>

				<li class="sidebar-header"><span>Quotes</span></li>

				<li class="<?php echo ($active=='quote' ? 'active' : '')?>">

          <a href="<?php echo site_url('pg_admin/quote') ?>">

              <i class="pe-7s-chat"></i>

              <p>Quotes</p>

          </a>

        </li>

				<?php

					}

				?>



    </ul>

  </div>

</div>

