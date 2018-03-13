				</div>
		</div>

		<div class="container-fluid b2st mt20 pb20 def-footer">
			<!-- footer content -->
			<footer class="footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<a href="<?= base_url() ?>"><img src="<?= ASSETS_IMAGE ?>/logo.png" style="width:175px;margin:20px 0px 0px 0px;"></a>
								<p>
									Kantor Pusat:<br>
									Jl Magelang No 113<br>
									Yogyakarta, Indonesia<br>
									(0274) 292 3430 								
								</p>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">&nbsp;</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">&nbsp;</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="ptb10">
								<h4 class="b1db pb10">Ikuti Kami</h4>
								<a href="https://www.facebook.com/pgbimbel" class="mfs" target="_blank"><i class="fa fa-facebook-square f32"></i></a>
								<a href="https://twitter.com/pgbimbel" class="mfs" target="_blank"><i class="fa fa-twitter f32"></i></a>
								<a href="http://instagram.com/pgbimbel/" class="mfs" target="_blank"><i class="fa fa-instagram f32"></i></a>
								<a href="https://plus.google.com/107637736689582288635/posts" class="mfs" target="_blank"><i class="fa fa-google-plus f32"></i></a>
								<a href="#" class="mfs" target="_blank"><i class="fa fa-youtube f32"></i></a>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- /footer content -->
		</div>
		<div class="clearfix"></div>
		<div class="container-fluid def-footer">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center ptb10 copi">
						&copy copyright 2017 Prime Generation. <a href="http://www.primegeneration.co.id" target="_blank">www.primegeneration.co.id</a> 
				</div>
			</div>
		</div>

		<script src="<?= ASSETS_JS ?>bootstrap.min.js"></script>

		<!-- chart js -->
		<script src="<?= ASSETS_JS ?>chartjs/chart.min.js"></script>
		<!-- bootstrap progress js -->
		<script src="<?= ASSETS_JS ?>progressbar/bootstrap-progressbar.min.js"></script>
		<script src="<?= ASSETS_JS ?>nicescroll/jquery.nicescroll.min.js"></script>
		<!-- icheck -->
		<script src="<?= ASSETS_JS ?>icheck/icheck.min.js"></script>
		<!-- tags -->
		<script src="<?= ASSETS_JS ?>tags/jquery.tagsinput.min.js"></script>
		<!-- switchery -->
		<script src="<?= ASSETS_JS ?>switchery/switchery.min.js"></script>
		<!-- daterangepicker -->
		<script type="text/javascript" src="<?= ASSETS_JS ?>moment.min2.js"></script>
		<script type="text/javascript" src="<?= ASSETS_JS ?>datepicker/daterangepicker.js"></script>
		<!-- richtext editor -->
		<script src="<?= ASSETS_JS ?>editor/bootstrap-wysiwyg.js"></script>
		<script src="<?= ASSETS_JS ?>editor/external/jquery.hotkeys.js"></script>
		<script src="<?= ASSETS_JS ?>editor/external/google-code-prettify/prettify.js"></script>
		<!-- select2 -->
		<script src="<?= ASSETS_JS ?>select/select2.full.js"></script>
		<!-- form validation -->
		<script type="text/javascript" src="<?= ASSETS_JS ?>parsley/parsley.min.js"></script>
		<!-- textarea resize -->
		<script src="<?= ASSETS_JS ?>textarea/autosize.min.js"></script>
		<script>
				autosize($('.resizable_textarea'));
		</script>
		<!-- Autocomplete -->
		<script type="text/javascript" src="<?= ASSETS_JS ?>autocomplete/countries.js"></script>
		<script src="<?= ASSETS_JS ?>autocomplete/jquery.autocomplete.js"></script>
		<script type="text/javascript">
				$(function () {
						'use strict';
						var countriesArray = $.map(countries, function (value, key) {
								return {
										value: value,
										data: key
								};
						});
						// Initialize autocomplete with custom appendTo:
						$('#autocomplete-custom-append').autocomplete({
								lookup: countriesArray,
								appendTo: '#autocomplete-container'
						});
				});
		</script>
		<script src="<?= ASSETS_JS ?>custom.js"></script>


		<!-- select2 -->
		<script>
				$(document).ready(function () {
						$(".select2_single").select2({allowClear: true});
						$(".select2_group").select2({});
						$(".select2_multiple").select2({
								maximumSelectionLength: 4,
								placeholder: "With Max Selection limit 4",
								allowClear: true
						});
				});
		</script>
		<!-- /select2 -->
		<!-- input tags -->
		<script>
				function onAddTag(tag) {
						alert("Added a tag: " + tag);
				}

				function onRemoveTag(tag) {
						alert("Removed a tag: " + tag);
				}

				function onChangeTag(input, tag) {
						alert("Changed a tag: " + tag);
				}

				$(function () {
						$('#tags_1').tagsInput({
								width: 'auto'
						});
				});
		</script>
		<!-- /input tags -->
		<!-- form validation -->
		<script type="text/javascript">
				$(document).ready(function () {
						$.listen('parsley:field:validate', function () {
								validateFront();
						});
						$('#demo-form .btn').on('click', function () {
								$('#demo-form').parsley().validate();
								validateFront();
						});
						var validateFront = function () {
								if (true === $('#demo-form').parsley().isValid()) {
										$('.bs-callout-info').removeClass('hidden');
										$('.bs-callout-warning').addClass('hidden');
								} else {
										$('.bs-callout-info').addClass('hidden');
										$('.bs-callout-warning').removeClass('hidden');
								}
						};
				});

				$(document).ready(function () {
						$.listen('parsley:field:validate', function () {
								validateFront();
						});
						$('#demo-form2 .btn').on('click', function () {
								$('#demo-form2').parsley().validate();
								validateFront();
						});
						var validateFront = function () {
								if (true === $('#demo-form2').parsley().isValid()) {
										$('.bs-callout-info').removeClass('hidden');
										$('.bs-callout-warning').addClass('hidden');
								} else {
										$('.bs-callout-info').addClass('hidden');
										$('.bs-callout-warning').removeClass('hidden');
								}
						};
				});
				try {
						hljs.initHighlightingOnLoad();
				} catch (err) {}
		</script>
		<!-- /form validation -->
		<!-- editor -->
		<script>
				$(document).ready(function () {
						$('.xcxc').click(function () {
								$('#descr').val($('#editor').html());
						});
				});

				$(function () {
						function initToolbarBootstrapBindings() {
								var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
						'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
						'Times New Roman', 'Verdana'],
										fontTarget = $('[title=Font]').siblings('.dropdown-menu');
								$.each(fonts, function (idx, fontName) {
										fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
								});
								$('a[title]').tooltip({
										container: 'body'
								});
								$('.dropdown-menu input').click(function () {
												return false;
										})
										.change(function () {
												$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
										})
										.keydown('esc', function () {
												this.value = '';
												$(this).change();
										});

								$('[data-role=magic-overlay]').each(function () {
										var overlay = $(this),
												target = $(overlay.data('target'));
										overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
								});
								if ("onwebkitspeechchange" in document.createElement("input")) {
										var editorOffset = $('#editor').offset();
										$('#voiceBtn').css('position', 'absolute').offset({
												top: editorOffset.top,
												left: editorOffset.left + $('#editor').innerWidth() - 35
										});
								} else {
										$('#voiceBtn').hide();
								}
						};

						function showErrorAlert(reason, detail) {
								var msg = '';
								if (reason === 'unsupported-file-type') {
										msg = "Unsupported format " + detail;
								} else {
										console.log("error uploading file", reason, detail);
								}
								$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
										'<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
						};
						initToolbarBootstrapBindings();
						$('#editor').wysiwyg({
								fileUploadError: showErrorAlert
						});
						window.prettyPrint && prettyPrint();
				});
		</script>
		<!-- /editor -->
		
    <!-- sparkline -->
    <script src="<?= ASSETS_JS ?>sparkline/jquery.sparkline.min.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="<?= ASSETS_JS ?>excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/date.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>flot/jquery.flot.resize.js"></script>

    <!-- flot -->
    <script type="text/javascript">
        //define chart clolors ( you maybe add more colors if you want or flot will add it automatic )
        var chartColours = ['#96CA59', '#3F97EB', '#72c380', '#6f7a8a', '#f7cb38', '#5a8022', '#2c7282'];

        //generate random number for charts
        randNum = function () {
            return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
        }

        $(function () {
            var d1 = [];
            //var d2 = [];

            //here we generate data for chart
            for (var i = 0; i < 30; i++) {
                d1.push([new Date(Date.today().add(i).days()).getTime(), randNum() + i + i + 10]);
                //    d2.push([new Date(Date.today().add(i).days()).getTime(), randNum()]);
            }

            var chartMinDate = d1[0][0]; //first day
            var chartMaxDate = d1[20][0]; //last day

            var tickSize = [1, "day"];
            var tformat = "%d/%m/%y";

            //graph options
            var options = {
                grid: {
                    show: true,
                    aboveData: true,
                    color: "#3f3f3f",
                    labelMargin: 10,
                    axisMargin: 0,
                    borderWidth: 0,
                    borderColor: null,
                    minBorderMargin: 5,
                    clickable: true,
                    hoverable: true,
                    autoHighlight: true,
                    mouseActiveRadius: 100
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        lineWidth: 2,
                        steps: false
                    },
                    points: {
                        show: true,
                        radius: 4.5,
                        symbol: "circle",
                        lineWidth: 3.0
                    }
                },
                legend: {
                    position: "ne",
                    margin: [0, -25],
                    noColumns: 0,
                    labelBoxBorderColor: null,
                    labelFormatter: function (label, series) {
                        // just add some space to labes
                        return label + '&nbsp;&nbsp;';
                    },
                    width: 40,
                    height: 1
                },
                colors: chartColours,
                shadowSize: 0,
                tooltip: true, //activate tooltip
                tooltipOpts: {
                    content: "%s: %y.0",
                    xDateFormat: "%d/%m",
                    shifts: {
                        x: -30,
                        y: -50
                    },
                    defaultTheme: false
                },
                yaxis: {
                    min: 0
                },
                xaxis: {
                    mode: "time",
                    minTickSize: tickSize,
                    timeformat: tformat,
                    min: chartMinDate,
                    max: chartMaxDate
                }
            };
            var plot = $.plot($("#placeholder33x"), [{
                label: "Email Sent",
                data: d1,
                lines: {
                    fillColor: "rgba(150, 202, 89, 0.12)"
                }, //#96CA59 rgba(150, 202, 89, 0.42)
                points: {
                    fillColor: "#fff"
                }
            }], options);
        });
    </script>
    <!-- /flot -->
    <!--  -->
    <script>
        $('document').ready(function () {
            $(".sparkline_one").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 5, 6, 4, 5, 6, 3, 5, 4, 5, 4, 5, 4, 3, 4, 5, 6, 7, 5, 4, 3, 5, 6], {
                type: 'bar',
                height: '125',
                barWidth: 13,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline11").sparkline([2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3], {
                type: 'bar',
                height: '40',
                barWidth: 8,
                colorMap: {
                    '7': '#a1a1a1'
                },
                barSpacing: 2,
                barColor: '#26B99A'
            });

            $(".sparkline22").sparkline([2, 4, 3, 4, 7, 5, 4, 3, 5, 6, 2, 4, 3, 4, 5, 4, 5, 4, 3, 4, 6], {
                type: 'line',
                height: '40',
                width: '200',
                lineColor: '#26B99A',
                fillColor: '#ffffff',
                lineWidth: 3,
                spotColor: '#34495E',
                minSpotColor: '#34495E'
            });

            var doughnutData = [
                {
                    value: 30,
                    color: "#455C73"
                },
                {
                    value: 30,
                    color: "#9B59B6"
                },
                {
                    value: 60,
                    color: "#BDC3C7"
                },
                {
                    value: 100,
                    color: "#26B99A"
                },
                {
                    value: 120,
                    color: "#3498DB"
                }
        ];
            var myDoughnut = new Chart(document.getElementById("canvas1i").getContext("2d")).Doughnut(doughnutData);
            var myDoughnut = new Chart(document.getElementById("canvas1i2").getContext("2d")).Doughnut(doughnutData);
            var myDoughnut = new Chart(document.getElementById("canvas1i3").getContext("2d")).Doughnut(doughnutData);
        });
    </script>
    <!-- -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->

    <!-- PNotify -->
    <script type="text/javascript" src="<?= ASSETS_JS ?>notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?= ASSETS_JS ?>notify/pnotify.nonblock.js"></script>

		<script src="<?=ASSETS_JS?>datepicker/datejs/js/jscal2.js"></script>
		<script src="<?=ASSETS_JS?>datepicker/datejs/js/lang/id.js"></script>
		<script type="text/javascript">//<![CDATA[

		  var cal = Calendar.setup({
			  showTime     	: 24,
			  onSelect		: function(cal) { cal.hide() }
		  });
		  cal.manageFields("ftanggal", "tanggal", "%d-%m-%Y");
		  cal.manageFields("ftanggal1", "tanggal1", "%d-%m-%Y");
		  cal.manageFields("ftanggal2", "tanggal2", "%d-%m-%Y");

		//]]></script>

	<script>
	function formatangka(objek) {
	   a = objek.value;
	   b = a.replace(/[^\d]/g,"");
	   c = "";
	   panjang = b.length;
	   j = 0;
	   for (i = panjang; i > 0; i--) {
	     j = j + 1;
	     if (((j % 3) == 1) && (j != 1)) {
	       c = b.substr(i-1,1) + "," + c;
	     } else {
	       c = b.substr(i-1,1) + c;
	     }
	   }
	   objek.value = c;
	}
	</script>
		
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>" defer></script>
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.steps.min.js');?>" defer></script>
	<script type="text/javascript" src="<?php echo base_url('assets/dashboard/js/init.js');?>" defer></script>
	<script type="text/javascript" src="<?php echo base_url('assets/dashboard/maximage/lib/js/jquery.maximage.min.js');?>" defer></script>
	<script type="text/javascript" src="<?php echo base_url('assets/dashboard/maximage/lib/js/jquery.cycle.all.js');?>" defer></script>	
	
	<!-- SCRIPT UNTUK SLIDER -->
	<script type="text/javascript" charset="utf-8">
    $(window).bind("load resize", function() {
        $('.popup-materi-container .content').css({'height':$.Window.height()-250});
      
    });
    $(window).load(function() {
      $('#maximage')
        .maximage({
          cycleOptions: {
            fx:'fade',
            timeout: 6000,
        }
      });
    });

    $(document).ready(function(){
      $("#myCarousel").carousel({interval: false});
    });
  </script>
  
	<!-- END SCRIPT SLIDER -->


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
</body>

</html>