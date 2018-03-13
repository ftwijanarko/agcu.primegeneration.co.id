<?php

class Banksoal extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_banksoal');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

function index(){
	$data = array(
		'navbar_title'	=> 'Data Bank Soal',
		'data_soal' 	=> $this->model_banksoal->fetch_banksoal(),
		'select_options_kelas'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view('pg_admin/banksoal', $data);
}

function tambah(){
	$data = array(
		'navbar_title' 			=> "Tambah Bank Soal",
		'form_action'			=> current_url(),
		'select_options_mapel'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view('pg_admin/banksoal_form', $data);
}

function prosesbanksoal(){
	$params 		= $this->input->post(null, true);
	$mapel			= $params['nama_mapel'];
	
	if(isset($params['topikbaru'])){
		$topik		= $params['topikbaru'];
	}else{
		$topik			= $params['topik'];
	}
	$soal			= str_replace("\\\\", "\\", $params['soal']);
	$bobot			= $params['bobot'];
	$jawabbenar		= $params['jawabbenar'];
	$jawab1			= str_replace("\\\\", "\\", $params['jawab1']);
	$jawab2			= str_replace("\\\\", "\\", $params['jawab2']);
	$jawab3			= str_replace("\\\\", "\\", $params['jawab3']);
	$jawab4			= str_replace("\\\\", "\\", $params['jawab4']);
	$jawab5			= str_replace("\\\\", "\\", $params['jawab5']);
	$bahasteks		= str_replace("\\\\", "\\", $params['bahasteks']);
	$bahasvideo		= $params['bahasvideo'];
	$kategori		= $params['kategori'];
	$tipe			= $params['tipe'];
	
	$result = $this->model_banksoal->tambah_banksoal($mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe);
	redirect('pg_admin/banksoal');
}

function kategori(){
	$data = array(
		'navbar_title' 			=> "Tambah Kategori Bank Soal",
		'kategoribanksoal'	=> $this->model_banksoal->fetch_kategori_bank_soal()
	);
	$this->load->view('pg_admin/kategori_banksoal', $data);
}

function tambahkategori(){
	$data = array(
		'navbar_title' 			=> "Tambah Kategori Bank Soal",
		'datakelas'				=> $this->model_banksoal->get_kelas()
	);
	
	$this->load->view('pg_admin/kategori_banksoal_form', $data);
}

function pilihmapel($idkelas){
	$carimapel = $this->model_banksoal->get_mapel_by_kelas($idkelas);
	
	echo "<option value=''>-- pilih mata pelajaran --</option>";
	foreach($carimapel as $mapel){
	?>
		<option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
	<?php
	}
}

function pilihkategori($idmapel){
	$carikategori = $this->model_banksoal->get_kategori_by_mapel($idmapel);
	
	echo "<option value='0'>Uncategorized</option>";
	foreach($carikategori as $kategori){
	?>
		<option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>
	<?php
	}
}

function pilihtopik($idmapel){
	$caritopik = $this->model_banksoal->get_topik_by_mapel($idmapel);
	
	echo "<option value=''>Pilih Topik</option>";
	foreach($caritopik as $topik){
	?>
		<option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>
	<?php
	}
	echo "<option value='tambah'>Tambah Topik...</option>";
}

function tambahtopik($topik){
	if($topik = "tambah"){
		echo "<input type='text' class='form-control' name='topikbaru' placeholder='masukkan topik baru...'/>";
	}
}

function proseskategori(){
	$params = $this->input->post(null, true);
	$idmapel = $params['mapel'];
	$namakategori = $params['nama_kastegori'];
	
	$result = $this->model_banksoal->tambah_kategori($idmapel, $namakategori);
	
	redirect('pg_admin/banksoal/kategori');
}

function editkategori($idkategori){
	$data = array(
		'navbar_title' 			=> "Edit Kategori Bank Soal",
		'datakategori'			=> $this->model_banksoal->cari_kategori($idkategori),
		'datakelas'				=> $this->model_banksoal->get_kelas()
	);
	
	$this->load->view('pg_admin/kategori_banksoal_edit', $data);
}

function proseseditkategori(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['mapel'];
	$namakategori 	= $params['nama_kastegori'];
	$idkategori 	= $params['id_kategori'];
	
	$result = $this->model_banksoal->edit_kategori($idkategori, $idmapel, $namakategori);
	
	redirect('pg_admin/banksoal/kategori');
}

function hapuskategori($idkategori){
	$hapus = $this->model_banksoal->hapus_kategori($idkategori);
	
	redirect('pg_admin/banksoal/kategori');
}

function edit($idbanksoal){
	$datasoal = $this->model_banksoal->cari_bank_soal_by_id($idbanksoal);

	$data = array(
		'navbar_title' 			=> "Edit Bank Soal",
		'datasoal'				=> $this->model_banksoal->cari_bank_soal_by_id($idbanksoal),
		'datakelas'				=> $this->model_banksoal->get_kelas(),
		'select_options_mapel'	=> $this->model_banksoal->get_kelas(),
		'datatopik' 			=> $this->model_banksoal->get_topik_by_mapel($datasoal->id_mapel)
	);
	$this->load->view('pg_admin/banksoal_edit', $data);
}

function proseseditbanksoal(){
	$params = $this->input->post(null, true);
	
	$idbanksoal = $params['idbanksoal'];
	$mapel			= $params['nama_mapel'];
	if(isset($params['topikbaru'])){
		$topik		= $params['topikbaru'];
	}else{
		$topik			= $params['topik'];
	}
	$soal			= str_replace("\\\\", "\\", $params['soal']);
	$bobot			= $params['bobot'];
	$jawabbenar		= $params['jawabbenar'];
	$jawab1			= str_replace("\\\\", "\\", $params['jawab1']);
	$jawab2			= str_replace("\\\\", "\\", $params['jawab2']);
	$jawab3			= str_replace("\\\\", "\\", $params['jawab3']);
	$jawab4			= str_replace("\\\\", "\\", $params['jawab4']);
	$jawab5			= str_replace("\\\\", "\\", $params['jawab5']);
	$bahasteks		= str_replace("\\\\", "\\", $params['bahasteks']);
	$bahasvideo		= $params['bahasvideo'];
	$kategori		= $params['kategori'];
	$tipe			= $params['tipe'];
	
	$result = $this->model_banksoal->edit_banksoal($idbanksoal, $mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe);
	redirect('pg_admin/banksoal');
}

function hapus($idbanksoal){
	$hapus = $this->model_banksoal->hapus($idbanksoal);
	redirect('pg_admin/banksoal');
}

function ajax_mapel($kelas){
	$carimapel = $this->model_banksoal->get_mapel_by_kelas($kelas);
	
	echo "<option value=''>-- pilih mata pelajaran --</option>";
	foreach($carimapel as $mapel){
	?>
		<option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
	<?php
	}
}

function ajax_soal($kelas, $mapel){
	$carisoal = $this->model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
	$x=1;
	foreach($carisoal as $data){
	?>
		<tr>
			<td><?php echo $x;?></td>
			<td><?php echo $data->topik; ?> ...</td>
			<td>
				<?php
					if($data->pembahasan_teks !== "" AND $data->pembahasan_video !== ""){
				?>
				<a href=""><span class="label label-success">Pembahasan Teks</span></a>
				<a href=""><span class="label label-warning">Pembahasan Video</span></a>
				<?php
					}elseif($data->pembahasan_teks == "" AND $data->pembahasan_video !== ""){
				?>
				<a href=""><span class="label label-warning">Pembahasan Video</span></a>
				<?php
					}elseif($data->pembahasan_teks !== "" AND $data->pembahasan_video == ""){
				?>
				<a href=""><span class="label label-success">Pembahasan Teks</span></a>
				<?php
					}elseif($data->pembahasan_teks == "" AND $data->pembahasan_video == ""){
						
					}
				?>
				
			</td>
			<td>
				<?php
					echo $data->nama_mapel . " - " . $data->alias_kelas;
				?>
			</td>
			<td>
				<?php
					echo $data->bobot_soal;
				?>
			</td>
			<td>
				<?php
					echo $data->kunci;
				?>
			</td>
			<td class="text-center">
				<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data->id_banksoal; ?>">
				<span class="glyphicon glyphicon-eye-open"></span> 
				</a>
				<a href="banksoal/edit/<?php echo $data->id_banksoal;?>">
				<span class="glyphicon glyphicon-pencil"></span> 
				</a>
				
				<?php
				if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
				?>
				<a href="banksoal/hapus/<?php echo $data->id_banksoal;?>" onclick="return confirm('Apakah anda yakin untuk menghapus');">
				<span class="glyphicon glyphicon-trash"></span>
				</a>
				<?php
				}
				?>
			</td>
		</tr>
	<?php
		$x++;
	}
}

function ajax_soal_modal($kelas, $mapel){
	$carisoal = $this->model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
	$no=1;
	foreach($carisoal as $data){
	?>
	<div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
		<div class="modal-content" id="modalsoal">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  </div>
		  <div class="modal-body">
			<p><?php echo $data->pertanyaan; ?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php	
	}
}

function ajax_kategori($idmapel){
	$carikategori = $this->model_banksoal->get_kategori_by_mapel($idmapel);
	
	echo "<option value=''>Pilih Kategori...</option>";
	foreach($carikategori as $kategori){
		?>
		<option value="<?php echo $kategori->id_kategori_bank_soal;?>"><?php echo $kategori->nama_kategori;?></option>
		<?php
	}
}
function ajax_soal_by_kategori($idkategori){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	$x = 1;
	foreach($carisoal as $data){
	?>
		<tr>
			<td><?php echo $x;?></td>
			<td><?php echo $data->topik; ?> ...</td>
			<td>
				<?php
					if($data->pembahasan_teks !== "" AND $data->pembahasan_video !== ""){
				?>
				<a href=""><span class="label label-success">Pembahasan Teks</span></a>
				<a href=""><span class="label label-warning">Pembahasan Video</span></a>
				<?php
					}elseif($data->pembahasan_teks == "" AND $data->pembahasan_video !== ""){
				?>
				<a href=""><span class="label label-warning">Pembahasan Video</span></a>
				<?php
					}elseif($data->pembahasan_teks !== "" AND $data->pembahasan_video == ""){
				?>
				<a href=""><span class="label label-success">Pembahasan Teks</span></a>
				<?php
					}elseif($data->pembahasan_teks == "" AND $data->pembahasan_video == ""){
						
					}
				?>
				
			</td>
			<td>
				<?php
					echo $data->nama_mapel . " - " . $data->alias_kelas;
				?>
			</td>
			<td>
				<?php
					echo $data->bobot_soal;
				?>
			</td>
			<td>
				<?php
					echo $data->kunci;
				?>
			</td>
			<td class="text-center">
				<a href="#" data-toggle="modal" data-target="#myModal<?php echo $data->id_banksoal; ?>">
				<span class="glyphicon glyphicon-eye-open"></span> 
				</a>
				<a href="banksoal/edit/<?php echo $data->id_banksoal;?>">
				<span class="glyphicon glyphicon-pencil"></span> 
				</a>
				
				<?php
				if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
				?>
				<a href="banksoal/hapus/<?php echo $data->id_banksoal;?>" onclick="return confirm('Apakah anda yakin untuk menghapus');">
				<span class="glyphicon glyphicon-trash"></span>
				</a>
				<?php
				}
				?>
			</td>
		</tr>
	<?php
		$x++;
	}
}

function ajax_soal_modal_by_kategori($idkategori){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	$no=1;
	foreach($carisoal as $data){
	?>
	<div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
		<div class="modal-content" id="modalsoal">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  </div>
		  <div class="modal-body">
			<p><?php echo html_entity_decode($data->pertanyaan); ?></p>
			<p>&nbsp;</p>
			<table class="table table-bordered table-striped">
				<tr>
					<td style="width: 30px;"><b>A.</b></td>
					<td>
						<?php
						echo html_entity_decode($data->jawab_1);
						?>
					</td>
				</tr>
				<tr>
					<td><b>B.</b></td>
					<td>
						<?php
						echo html_entity_decode($data->jawab_2);
						?>
					</td>
				</tr>
				<tr>
					<td><b>C.</b></td>
					<td>
						<?php
						echo html_entity_decode($data->jawab_3);
						?>
					</td>
				</tr>
				<tr>
					<td><b>D.</b></td>
					<td>
						<?php
						echo html_entity_decode($data->jawab_4);
						?>
					</td>
				</tr>
				<? if ($data->jawab_5 != ''){ ?>
				<tr>
					<td><b>E.</b></td>
					<td>
						<?php
						echo html_entity_decode($data->jawab_5);
						?>
					</td>
				</tr>
				<? } ?>
				<tr>
					<td>Kunci Jawaban</td>
					<td>
						<b>
						<?php
							if($data->kunci == 1){
								echo "A";
							}elseif($data->kunci == 2){
								echo "B";
							}elseif($data->kunci == 3){
								echo "C";
							}elseif($data->kunci == 4){
								echo "D";
							}elseif($data->kunci == 5){
								echo "E";
							}
						?>
						</b>
					</td>
				</tr>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php	
	}
}

}
?>