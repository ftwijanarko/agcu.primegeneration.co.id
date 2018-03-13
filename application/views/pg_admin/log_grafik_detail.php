<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <link rel="icon" type="image/png" href="assets/img/favicon.ico">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

 <title>Light Bootstrap Dashboard by Creative Tim</title>

 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  <!-- Bootstrap core CSS     -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />

  <!-- Animation library for notifications   -->
  <link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet"/>

  <!--  Light Bootstrap Table core CSS    -->
  <link href="<?php echo base_url('assets/css/light-bootstrap-dashboard.css');?>" rel="stylesheet"/>

  
  <!--  CSS for BintangSekolah PG_Admin  -->
  <link href="<?php echo base_url('assets/css/pg_admin.css" rel="stylesheet');?>" />


  <!--     Fonts and icons     -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

  <!-- ADDITIONAL -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">

</head>
<body>

<!-- Needed to override default css for Eternicode's Datepicker -->
<style type="text/css">
.datepicker.dropdown-menu {
  opacity: 100;
  display: block;
  visibility: visible;
}
</style>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Grafik Log Akses</h4>
                <p class="category">Grafik riwayat akses</p>
              </div>
              <div class="content">
                <div class="row">
                  <div class="col-md-12">
                    <form action="<?php echo base_url('pg_admin/log/ajax_grafik')?>" method="post" name="formAksesDate">
                      <div class="form-group well">
                        <label><strong>Range Tanggal</strong>
                          <br>Lihat riwayat akses berdasarkan bulan</label>
                        <div class="input-daterange input-group" id="input-daterange">
                          <input type="text" class="input-sm form-control" name="log_date_start" value="<?php echo (date('F Y', strtotime(date('M Y').'-4 months')));?>"/>
                          <span class="input-group-addon">s/d</span>
                          <input type="text" class="input-sm form-control" name="log_date_end" value="<?php echo date('F Y');?>"/>
                          <div class="input-group-btn">
                            <button type="submit" name="submitAksesDate" class="btn btn-default"><i class="glyphicon glyphicon-th-list"></i> Tampilkan</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-12">
                    <div id="linechart-container"></div>
                  </div>
                  <div class="col-md-12">
                    <div id="barchart-container"></div>
                  </div>
                </div>

                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-primary">
                        <ul class="nav nav-tabs nav-justified">
                          <li class="panel-heading active"><a data-toggle="tab" href="#home">Teks</a></li>
                          <li class="panel-heading"><a data-toggle="tab" href="#menu1">Video</a></li>
                          <li class="panel-heading"><a data-toggle="tab" href="#menu2">Latihan Soal</a></li>
                        </ul>
                      <div class="panel-body">
                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <label><strong>Materi Teks</strong>
                              <br>Bulan <span class="label_bulan"><?php echo (date('F Y', strtotime(date('M Y').'-4 months'))) .' s/d '. date('F Y');?></span></label>
                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th class="text-center">Jumlah Akses</th>
                                  </tr>
                                </thead>
                                <tbody id="data_teks">
                                  <?php
                                  foreach ($group_log_teks as $teks) 
                                  { ?>
                                  <tr>
                                    <td><?php echo $teks['alias_kelas'];?></td>
                                    <td><?php echo $teks['nama_mapel'];?></td>
                                    <td class="text-center"><?php echo $teks['jumlah_akses'];?> x</td>
                                  </tr>
                                  <?php 
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div id="menu1" class="tab-pane fade">
                            <label><strong>Materi Video</strong>
                              <br>Bulan <span class="label_bulan"><?php echo date('F Y')?></span></label>
                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th class="text-center">Jumlah Akses</th>
                                  </tr>
                                </thead>
                                <tbody id="data_video">
                                  <?php
                                  foreach ($group_log_video as $video) 
                                  { ?>
                                  <tr>
                                    <td><?php echo $video['alias_kelas'];?></td>
                                    <td><?php echo $video['nama_mapel'];?></td>
                                    <td class="text-center"><?php echo $video['jumlah_akses'];?> x</td>
                                  </tr>
                                  <?php 
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div id="menu2" class="tab-pane fade">
                            <label><strong>Latihan Soal</strong>
                              <br>Bulan <span class="label_bulan"><?php echo date('F Y')?></span></label>
                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th class="text-center">Jumlah Akses</th>
                                  </tr>
                                </thead>
                                <tbody id="data_soal">
                                  <?php
                                  foreach ($group_log_soal as $soal) 
                                  { ?>
                                  <tr>
                                    <td><?php echo $soal['alias_kelas'];?></td>
                                    <td><?php echo $soal['nama_mapel'];?></td>
                                    <td class="text-center"><?php echo $soal['jumlah_akses'];?> x</td>
                                  </tr>
                                  <?php 
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="<?php echo base_url()?>/assets/js/plugins/highcharts/themes/sand-signika.js"></script>


<!-- PLUGINS FUNCTION -->
<!-- Needed for Highcharts plugin -->
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
        // Build the chart
      $('#linechart-container').highcharts({
           title: {
            text: 'Jumlah Akses Konten per-Bulan',
            x: -20 //center
        },
        subtitle: {
            text: "<?php echo (date('F Y', strtotime(date('M Y').'-4 months'))) .' s/d '. date('F Y');?>",
            x: -20
        },
        xAxis: {
            categories: [<?php foreach($bulan as $bulan) { echo "'".$bulan."',"; }?>],
            gridLineWidth: 1
        },
        yAxis: {
            title: {
                text: 'Jumlah Akses'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' x'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
                    name: 'Teks',
                    data: [<?php echo implode(',', $log_teks)?>]
                }, {
                    name: 'Video',
                    data: [<?php echo implode(',', $log_video)?>]
                }, {
                    name: 'Soal',
                    data: [<?php echo implode(',', $log_soal)?>]
                }, {
                    name: 'Keseluruhan',
                    data: [<?php echo implode(',', $log_total)?>]
                }
                ]
        });

        // $(function () {
        //     $('#barchart-container').highcharts({
        //         chart: {
        //             type: 'column'
        //         },
        //         title: {
        //             text: 'Monthly Average Rainfall'
        //         },
        //         subtitle: {
        //             text: 'Source: WorldClimate.com'
        //         },
        //         xAxis: {
        //             categories: [],
        //             crosshair: true
        //         },
        //         yAxis: {
        //             min: 0,
        //             title: {
        //                 text: 'Rainfall (mm)'
        //             }
        //         },
        //         tooltip: {
        //             headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        //                 '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        //             footerFormat: '</table>',
        //             shared: true,
        //             useHTML: true
        //         },
        //         plotOptions: {
        //             column: {
        //                 pointPadding: 0.2,
        //                 borderWidth: 0
        //             }
        //         },
        //         series: [{
        //             name: 'Teks',
        //             data: [12, 2, 14, 15, 12, 1]

        //         }, {
        //             name: 'Video',
        //             data: [10, 1, 5, 6, 7, 8]

        //         }, {
        //             name: 'Soal',
        //             data: [2, 4, 6, 8, 23, 5]

        //         }, {
        //             name: 'Total',
        //             data: [22, 12, 16, 19, 23, 17]

        //         }]
        //     });
        // });


        $('#input-daterange').datepicker({
          format: "MM yyyy",
          startView: 1,
          minViewMode: 1,
          maxViewMode: 2,
          todayBtn: "linked",
          // language: "id"
        });

        $('button[name^=submitAksesDate]').click(function(e) {
          e.preventDefault();
          var dateStart = $('input[name^=log_date_start]').val();
          var dateEnd = $('input[name^=log_date_end]').val();
          // console.log(dateStart +' - '+ dateEnd + ' ' + $('form[name^=formAksesDate]').attr('action'));
          
          $.ajax({
            url: $('form[name^=formAksesDate]').attr('action'),
            type: 'POST',
            dataType: 'json',
            data: { log_date_start:dateStart, log_date_end:dateEnd },
            success: function(response) {
              console.log("Teks: "+response.range_teks);
              console.log("Video: "+response.range_video);
              console.log("Soal: "+response.range_soal);
              // $('.label_bulan').text(dateStart +' - '+ dateEnd);
              // $('#data_teks').html(response.data_teks);
              // $('#data_video').html(response.data_video);
              // $('#data_soal').html(response.data_soal);

              var chart = $('#linechart-container').highcharts();
              // chart.setTitle(null, { text: 'WHYYY!?'});
              chart.xAxis[0].setCategories(response.bulan);
              chart.series[0].setData(response.range_teks);
              chart.series[1].setData(response.range_video);
              chart.series[2].setData(response.range_soal);
              chart.series[3].setData(response.range_total);
              // chart.redraw();
            }
          });
        })
      });
    });
</script>

</html>
