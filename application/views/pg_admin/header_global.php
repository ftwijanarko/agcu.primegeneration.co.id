<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

		<title>Prime Generation - Integrative Bimbel Pertama Di Indonesia</title>
		<meta name="description" content="Elearning dan Integrative Bimbel Pertama Di Indonesia" />
		<meta name="keywords" content="e-learning, bimbel, sekolah" />

		<link rel="shortcut icon" href="<?=ASSETS_IMAGE.'logo.png'?>" />

    <!-- Bootstrap core CSS -->

    <link href="<?= ASSETS_CSS ?>bootstrap.min.css" rel="stylesheet">

    <link href="<?= ASSETS_FONTS ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= ASSETS_CSS ?>animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?= ASSETS_CSS ?>custom1.css" rel="stylesheet">
    <link href="<?= ASSETS_CSS ?>icheck/flat/green.css" rel="stylesheet">
    <!-- editor -->
    <!--<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">-->
    <link href="<?= ASSETS_CSS ?>editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?= ASSETS_CSS ?>editor/index.css" rel="stylesheet">
    <!-- select2 -->
    <link href="<?= ASSETS_CSS ?>select/select2.min.css" rel="stylesheet">
    <link href="<?= ASSETS_CSS ?>nprogress.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=ASSETS_JS?>datepicker/datejs/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?=ASSETS_JS?>datepicker/datejs/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?=ASSETS_JS?>datepicker/datejs/css/gold/gold.css" />
    <!-- switchery -->
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>switchery/switchery.min.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/jquery.steps.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/plugins/chosen.css');?>"/>

    <script src="<?= ASSETS_JS ?>jquery.min.js"></script>
    <script src="<?= ASSETS_JS ?>nprogress.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
				
  </head>
  <body <?= $this->uri->segment(6) == "print" ? 'onload="window.print();"' : '' ?> class="nav-md">

