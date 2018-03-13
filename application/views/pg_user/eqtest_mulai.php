		<?php include('header_global.php');?>
		<?php include('navigation_global_test.php');?>
    <div class="b-dot" style="margin-top:70px;">

    <?php include "modal_pembahasan.php"; ?>

		

		<!-- Page Body -->

		<div class="page-body latihan-soal">

			<div class="soal-header">

					<h2>Emotional Quotient Test</h2>
					<ul class="keterangan">
						<li><span class="circle-icon"></span>&nbsp;</li>
						<li><span id="time">00:00</span></li>
					</ul>
			</div>

				<div class="wrapper-soal">

					<div class="container">

						<form id="form_soal" method="post" action="<?php echo base_url('agcutest/penilaian_eq')?>">

							<div class="tab-content">

							<?php

							$no = 1; 

							foreach ($data_soal as $item) 

							{ ?>

								<div id="item_soal_<?php echo $no;?>" class="tab-pane fade" style="width:88%;">

									<div class="row equal-row item-soal">

										<div class="col-xs-12 col-sm-6 col-md-6 soal">

												<?php echo $item->soal ? html_entity_decode($item->soal) : '';?>

										</div>

										<div class="col-xs-12 col-sm-6 col-md-6 jawaban">

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-0_<?php echo $no;?>" value="<?php echo $no;?>-" checked="checked">

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-a_<?php echo $no;?>" value="<?php echo $no;?>-<?php echo $item->skor_a; ?>">

											<label for="opt-a_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>A</p></span> 

												<span class="opt"><?php echo $item->jawab_a ? html_entity_decode($item->jawab_a) : ''?></span>

											</label>



											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-b_<?php echo $no;?>" value="<?php echo $no;?>-<?php echo $item->skor_b; ?>">

											<label for="opt-b_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>B</p></span> <span class="opt"><?php echo $item->jawab_b ? html_entity_decode($item->jawab_b) : ''?></span> 

											</label>

											

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-c_<?php echo $no;?>" value="<?php echo $no;?>-<?php echo $item->skor_c; ?>">

											<label for="opt-c_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>C</p></span> <span class="opt"><?php echo $item->jawab_c ? html_entity_decode($item->jawab_c) : ''?></span>

											</label>



											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-d_<?php echo $no;?>" value="<?php echo $no;?>-<?php echo $item->skor_d; ?>">

											<label for="opt-d_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>D</p></span> <span class="opt"><?php echo $item->jawab_d ? html_entity_decode($item->jawab_d) : ''?></span>

											</label>




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

								<input type="hidden" name="idprofil" value="<?= $idprofil ?>"/>

								<input type="hidden" placeholder="skor" id="textSkor" name="skor" value="0"/>

								<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" onclick="return confirm('Apakah anda yakin untuk menyelesaikan test?');" value="submit">SELESAI</button>
									
								<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" value="submit">SELESAI</button>

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

						    	<li><a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>"><?php echo $no;?></a></li>

						    <?php $no++; 

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

  				$(this).siblings('input[name='+ disableRadio +']').prop('disabled', true);

  				$(this).siblings('input[name='+ disableRadio +']').addClass('disabled');



  				//call ajax method to verify answer

    			if(action !== null) {

    				ajaxCheckJawaban(action, id_opt);

    			}

    			console.log(action, id_opt);

    		});


    	});

    </script>



    <script type="text/javascript">

    	function ajaxCheckJawaban(action, id_opt)

    	{

    		var value = action.split('-');

    		var id_opt = id_opt.split('_');



				$.post("<?=base_url('agcutest/ajax_check_jawaban_eq');?>",

				{

					id: value[0], jawaban: value[1], idprofil: <?php echo $idprofil ?>

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

						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('salah');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-remove'></i>");   		

					}

      	});	    		

    	}

    </script>



    <script type="text/javascript">

    	function ajaxFetchPembahasan(action)

    	{

    		var value = action.split('-');

    		$.post("<?=base_url('tryout/ajax_fetch_pembahasan');?>",

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
					var fiveMinutes = 60 * 30,
					display = document.querySelector('#time');
					startTimer(fiveMinutes, display);
				
				setInterval(function () {document.getElementById("submit_form_soal").click();}, 1800000);
				
			};
			</script>

			<script>
				$(window).load(function() {
					// Animate loader off screen
					$(".se-pre-con").fadeOut("slow");;
				});
			</script>
