<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	
	<title><?= setting('site_name')?> : <?= $title ?></title>
	
	<meta name="description" content="<?= setting('site_description')?>">
	<meta name="author" content="chrisiufer.com">
	
	<link rel="stylesheet" href="<?= base_url() ?>css/race.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>site/colors.css" type="text/css">

	<meta property="og:title" content="<?= $title ?> : <?= setting('site_name') ?>, <?= setting('site_city') ?>" />
	<meta property="og:description" content="<?= setting('site_description')?>" />
	<meta property="og:image" content="<?= base_url('img/logo.png'); ?>?<?= rand(999,9999);?>" />
	<meta property="og:url" content="<?= current_url(); ?>" />
	<meta name="medium" content="mult" />
		
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	
	<!-- Apple iOS and Android stuff - don't remove! -->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">

	<script src="<?= base_url() ?>js/libs/require.js" data-main="<?= base_url() ?>js/main" type="text/javascript" charset="utf-8"></script>	
	<script src="<?= base_url() ?>js/config.js" type="text/javascript" charset="utf-8"></script>
		
	<script type="text/javascript" charset="utf-8">
		require(['race'], function(Race){
			Race.base = '<?= base_url() ?>';
		});
	</script>
	
	<?= $data ?>
	
</head>
<body id="<?= $body_id ?>">
	
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
	<div class="row siteinfo">
		<div class="span12 text-right">
			<strong><?= _l('next_race') ?>:</strong> <?php echo Modules::run('race/race_block/next'); ?>
		</div>
	</div>

