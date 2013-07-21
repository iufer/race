<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	
	<title><?= setting('site_name')?> : <?= $title ?></title>
	
	<meta name="description" content="<?= setting('site_description')?>">
	<meta name="author" content="chrisiufer.com">
	
	<link rel="stylesheet" href="<?= base_url() ?>css/admin.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url() ?>site/colors.css" type="text/css">
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	
	<!-- Apple iOS and Android stuff - don't remove! -->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<script src="<?= base_url() ?>js/libs/require.js" data-main="<?= base_url() ?>js/admin" type="text/javascript" charset="utf-8"></script>	
	<script src="<?= base_url() ?>js/config.js" type="text/javascript" charset="utf-8"></script>
	
	<script type="text/javascript" charset="utf-8">
		require(['race'], function(Race){
			Race.base = '<?= base_url() ?>';
		});
	</script>
	
	<?= $data ?>
	
</head>
<body>

<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>	
			</a>
			<?php echo Modules::run('site/site_block/menu'); ?>					
			<div class="nav-collapse">
				<?php echo Modules::run('search/search_block/search'); ?>
			</div>
		</div>
	</div>		
</div>

<div class="container container-main">		
	<div class="row" style="margin-top:2em;">
		<div class="span3">
			<?php echo Modules::run('site/site_block/menu_admin', $page_title); ?>		
		</div>
		<div class="span9">



