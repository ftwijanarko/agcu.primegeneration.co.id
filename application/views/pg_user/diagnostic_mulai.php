		<?php include('header_global.php');?>
		<?php include('navigation_global_test.php');?>
    <div class="b-dot" style="margin-top:70px;">

			<style>
				.no-js #loader { display: none;  }
				.js #loader { display: block; position: absolute; left: 100px; top: 0; }
				.se-pre-con {
					position: fixed;
					left: 0px;
					top: 0px;
					width: 100%;
					height: 100%;
					z-index: 9999;
					background: url('<?php echo base_url('assets/img/preloading.gif') ?>') center no-repeat #fff;
				}
			</style>

			<div class="se-pre-con"></div>

			<?php include "modal_pembahasan.php"; ?>

			<!-- Page Body -->

			<div class="page-body latihan-soal">

				<div class="soal-header">

						<h2>AGCU Diagnostic Test</h2>
						<h4>Sisa Waktu : <span id="time">00:00</span></h4>
						<div id="simpanwaktu">
						</div>
				</div>


					<div class="wrapper-soal">

						<div class="container">

							<form id="form_soal" method="post" action="<?php echo base_url('agcutest/penilaian')?>">

								<div class="tab-content">

								<?php

								$no = 1; 

								foreach ($data_soal as $item){ 
									if(isset($terjawab)){
										foreach($terjawab as $sudah_jawab){
											if($sudah_jawab->id_soal == $item->id_banksoal){
												$sudah_dijawab[$item->id_banksoal] = $sudah_jawab->status;
											}
										}
									}
								?>

									<div id="item_soal_<?php echo $no;?>" class="tab-pane fade" style="width:88%;">

										<div class="row equal-row item-soal">

											<div class="col-xs-12 col-sm-6 col-md-6 soal">

													<?php echo $item->pertanyaan ? html_entity_decode($item->pertanyaan) : '';?>

											</div>

											<div class="col-xs-12 col-sm-6 col-md-6 jawaban">

												<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-a_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-1">

												<label for="opt-a_<?php echo $no;?>" class="label-opt"> 

													<span class="opt-id"><p>A</p></span> 

													<span class="opt"><?php echo $item->jawab_1 ? html_entity_decode($item->jawab_1) : ''?></span>

												</label>



												<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-b_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-2">

												<label for="opt-b_<?php echo $no;?>" class="label-opt"> 

													<span class="opt-id"><p>B</p></span> <span class="opt"><?php echo $item->jawab_2 ? html_entity_decode($item->jawab_2) : ''?></span> 

												</label>

												

												<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-c_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-3">

												<label for="opt-c_<?php echo $no;?>" class="label-opt"> 

													<span class="opt-id"><p>C</p></span> <span class="opt"><?php echo $item->jawab_3 ? html_entity_decode($item->jawab_3) : ''?></span>

												</label>



												<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-d_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-4">

												<label for="opt-d_<?php echo $no;?>" class="label-opt"> 

													<span class="opt-id"><p>D</p></span> <span class="opt"><?php echo $item->jawab_4 ? html_entity_decode($item->jawab_4) : ''?></span>

												</label>



													<?php
												if($item->jawab_5 !== ""){
												?>
												<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-e_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-5">

												<label for="opt-e_<?php echo $no;?>" class="label-opt">

													<span class="opt-id"><p>E</p></span> <span class="opt"><?php echo $item->jawab_5 ? html_entity_decode($item->jawab_5) : ''?></span>

												</label>
												<?php
												}
												?>
												



												<div class="row" >

													<div class="col-md-12">

														<span class="btn btn-info next_soal hidden" id="next_soal_<?php echo $no;?>" >Selanjutnya <i class="glyphicon glyphicon-chevron-right"></i></span>

													


													</div>

												</div>



											</div>

										</div>

									</div>

								<?php

								$no++; 

								} ?>

								</div>
							
							<textarea id="stopwatch" name="lamapengerjaan" style="display: none;"></textarea>
								<div class="row">

									<input type="hidden" placeholder="skor" id="textSkor" name="skor" value="0"/>

									<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" onclick="return confirm('Apakah anda yakin untuk menyelesaikan test?');" value="submit">SELESAI</button>
									
									<button style="display:none;" type="submit" name="submit_form_soal" id="submit_soal" value="submit">SELESAI</button>

								</div>

							</form>



						</div>

					</div>

					

					<div class="row">

						<div class="soal-pagination col-lg-12">

							<nav class="text-center">

								<ul id="toggle_soal" class="pagination custom-pagination">

									<?php 

									$no = 1;

									foreach ($data_soal as $page) 
									
									{ ?>

										<?php 
									if(isset($sudah_dijawab[$page->id_banksoal])){
								?>
									<li class="benar">
									<a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>">
									<i class='glyphicon glyphicon-ok'></i>
									</a>
									</li>
								<?php
									}else{
								?>
										<li>
									<a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>"><?php echo $no;?>
									
									</a>
									</li>

									<?php 
									}
								$no++; 

									} ?>

								</ul>

							</nav>

						</div>

					</div>


			</div>

			<!-- /Page Body -->
		
		</div>

		<!-- Footer -->

		<?php include('footer_global.php'); ?>

		<!-- /Footer -->

		

	  <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>

      <!-- NEEDED FOR SHAKA PLAYER -->

    <!-- Menu Toggle Script -->

		<script>

		$("#menu-toggle").click(function(e) {

			e.preventDefault();

			$("#wrapper").toggleClass("toggled");

		});

		</script>

		

		<script>

	    if ( supports_media_source() ) {

        supported.style.display="";

        videoObj.style.display="";

	    }

	    else {

        notsupported.style.display="";

	    }

			var video;

			var player;

			var source; 

			var estimator;



	    function connect(data = null)

	    {

        if(connectObj.textContent == "Stop") 

				{

					dashStop();

					connectObj.textContent = "Start";

					statusStr.textContent = "Disconnected";

      	}

        else 

        {

        	

	        connectObj.textContent = "Stop";

	        statusStr.textContent = "Playing";

	        

	        if ( video == null )

	        { video = document.querySelector("video"); }



	        if ( player == null )

	        { player = new shaka.player.Player(video); }



	        // Attach the player to the window so that it can be easily debugged.

	        window.player = player;



	        // Listen for errors from the Player.

	        player.addEventListener('error', failed );



	        // Construct a DashVideoSource to represent the DASH manifest.

	        //var mpdUrl = 'http://turtle-tube.appspot.com/t/t2/dash.mpd';

	        if ( estimator != null ) { estimator=null; }

	          estimator = new shaka.util.EWMABandwidthEstimator();



	        if ( source != null )

	        { source = null; }



	      	if (data !== null)

        	{

		        // source = new shaka.player.DashVideoSource("<?php //echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);

		        // source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);

		        source = new shaka.player.DashVideoSource(data, null, estimator);



		        // Load the source into the Player.

		        player.load(source);

		      }

    		}

	    }



			function failed(e)

			{

				var done = false;

				if ( e.detail == 'Error: Network failure.' )

				{

					statusStr.textContent = 'Network Connection Failed.';

					done = true;

				}

				

				if ( e.detail.status!=200 && done == false )

        {

					switch ( e.detail.status )

					{

					case 404:

						statusStr.textContent = e.detail.url+' not found.';

					break;

					

					default:

	          statusStr.textContent = 'Error '+e.detail.status+' for '+e.detail.url;

					break;

        	}

				}

			}



			function dashStop()

			{

				if(player!=null)

				{

					player.unload();

				}

				connectObj.textContent = "Start";

				statusStr.textContent = "Disconnected";

			}



    </script>

    <!-- /NEEDED FOR SHAKA PLAYER -->





    <script type="text/javascript">

    	$(document).ready(function(){

    		//set default selected soal

    		$("#toggle_soal li a")[0].click();

    	

    		$("input.pilihan_jawaban").click(function(e){

    			console.log(e.target.value);

    		});



    		$('.next_soal').click(function(){

    			var next = $('#toggle_soal > .active').next('li').find('a');

    			if(next.length > 0) {

    				next.trigger('click');

    			}

    			else {

    				// $('#form_soal').submit();

    				$('#submit_form_soal').click();

    				console.log('form_soal submitted');

    			}



    		});



    		$("a.modal-pembahasan").click(function(e){

    			e.preventDefault();

    			var target = $(e.currentTarget),

          action = target.data('action');

          //call ajax function to send value to server

          ajaxFetchPembahasan(action);

          

          console.log(action);

    		});



    	});

    </script>



    <script type="text/javascript">

    	$(document).ready(function(){

    		//set default selected soal

    		$("#toggle_soal li a")[0].click();

    	

    		$("input.pilihan_jawaban").click(function(e){

    			var action = e.target.value || null;

    			var id_opt = e.target.id || null;

  				var disableRadio = (e.target.name);

  				

  				//disabling other button

  				//$(this).siblings('input[name='+ disableRadio +']').prop('disabled', true);

  				//$(this).siblings('input[name='+ disableRadio +']').addClass('disabled');



  				//call ajax method to verify answer

    			if(action !== null) {

    				ajaxCheckJawaban(action, id_opt);

    			}

    			console.log(action, id_opt);

    		});



    		$("a.modal-pembahasan").click(function(e){

    			e.preventDefault();

    			

    			var target = $(e.currentTarget),

          action = target.data('action') || null;

          //call ajax function to send value to server

          if(action !== null){

          	ajaxFetchPembahasan(action);

          }

          console.log(action);

    		});



    		$('#pembahasanVideoModal').on('shown.bs.modal', function () {

					// var video = $("#videoObj");

					// video.paused ? video.get(0).play() : video.get(0).pause();

    			// connect();

					// $("#videoObj").get(0).play();

				})



				$('#pembahasanVideoModal').on('hidden.bs.modal', function () {

					// var video = $("#videoObj");

					// video.paused ? video.get(0).play() : video.get(0).pause();

					$("#videoObj").get(0).pause();

    			// connect();

				})



				$('#changeSource').click(function (e){

    			source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:sample.mp4/manifest.mpd", null, estimator);

	        // Load the source into the Player.

	        player.load(source);

				});



				$('#pauseVideo').click(function (e){

					// var vid = document.getElementById("videoObj"); 

					// vid.pause();

					$("#videoObj").get(0).pause();

				});



				$('#playVideo').click(function (e){

					$("#videoObj").get(0).play();

				});



    	});

    </script>



    <script type="text/javascript">

    	function ajaxCheckJawaban(action, id_opt)

    	{

    		var value = action.split('-');

    		var id_opt = id_opt.split('_');



				$.post("<?=base_url('agcutest/ajax_check_jawaban');?>",

				{

					id: value[0], jawaban: value[1]

				},

				function(data, status){

    			console.log('\nid: '+value[0]+ ', jawaban: '+value[1]);

          console.log("StatusCheckJawaban: " + status + "\nDATA: " + data);



					$("#next_soal_" + id_opt[1]).removeClass('hidden');   		

					

					if(data == "benar")
					{

						var skor = $("#textSkor").val() || 0;

						skor = parseInt(skor, 10);

						$("#textSkor").val(skor+=1);

						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('benar');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-ok'></i>");   		

					}

					else if(data == "salah")

					{

						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('benar');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-ok'></i>");   		

					}

      	});	    		

    	}

    </script>



    <script type="text/javascript">

    	function ajaxFetchPembahasan(action)

    	{

    		var value = action.split('-');

    		$.post("<?=base_url('agcutest/ajax_fetch_pembahasan');?>",

    		{

    			id: value[0], tipe: value[1]

    		},

    		function(data, status){

    			console.log('\nid: '+value[0]+ ', tipe: '+value[1]);

          console.log("\nStatusFetchPembahasan: " + status + "\nDATA: " + data);



          if(value[1] == 'teks')

          {

          	$('#konten_pembahasan_teks').html(data);

          }

          else if(value[1] == 'video')

          {

						connect(data);

          }

      	});

    	}

    </script>
	
<?php
if(isset($elapsed_time)){
	$waktu = ($durasi->durasi) - $elapsed_time->elapsed_time;
	$timer = $waktu * 60000;
}else{
	$waktu = $durasi->durasi;
	$timer = $waktu * 60000;
}
?>

<script>
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

//COUNT UUUUUUUUUUP
var timerVar = setInterval(countTimer, 1000);
var totalSeconds = 0;
function countTimer() {
++totalSeconds;
var hour = Math.floor(totalSeconds /3600);
var minute = Math.floor((totalSeconds - hour*3600)/60);
var seconds = totalSeconds - (hour*3600 + minute*60);

document.getElementById("stopwatch").innerHTML = hour + ":" + minute + ":" + seconds;
}
// END COUNT UUUUUUUUUUP

window.onload = function () {
    var fiveMinutes = 60 * <?php echo $waktu; ?>,
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
	
	setInterval(function () {document.getElementById("submit_soal").click();}, <?php echo $timer;?>);
	
};
</script>

<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
		setInterval(function () {
			$(function(){
				$("#simpanwaktu").load("../simpanwaktu/");
			});
		}, 1000);
	});
</script>

	</body>

</html>
