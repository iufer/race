<?php $this->load->header(setting('site_city'), 'site_index'); ?>

	<header class="hero-unit" style="background:url(http://farm9.staticflickr.com/8322/7927610312_6cac3f56b4_b.jpg) left 90% no-repeat; background-size:cover;">
		<h1 style="color:white; padding:10px; background-color:rgba(0,0,0,0.8); margin-left:-60px; display:inline-block;"><?= setting('site_name'); ?></h1><br>
		<p style="color:white; padding:10px; background-color:rgba(0,0,0,0.5); margin-left:-60px; display:inline-block;"><?= setting('site_description'); ?></p>
	</header>
	<!-- <div class="row">
			<div class="span12" style="height:302px; margin-top: -20px;">
				<?php // echo Modules::run('site/site_block/stats'); ?>
			</div>
		</div> -->
	<div class="row">
		<div class="span12">
			<?php echo Modules::run('race/race_block/calendar'); ?>
		</div>
	</div>	
	<div class="row">	
		<div class="span8">		
			<?php echo Modules::run('message/message_block/latest'); ?>		

			<h2><?= _l('races') ?></h2>
			<?php echo Modules::run('race/race_block/upcoming'); ?>
			
			<h2><?= _l('series') ?></h2>
			<?php echo Modules::run('series/series_block/upcoming', 5); ?>

			<h2 class="heading-underline"><?= _l('about') ?> <?= setting('site_name') ?></h2>
			<div class="row">
				<div class="span8"><?= setting('site_about'); ?></div>
			</div>
		</div>
		<div class="span4">
			<h2 class="heading-underline"><?= _l('newest_results') ?></h2>
			<?php echo Modules::run('result/result_block/recent', 5); ?>
	
			<h2 class="heading-underline"><?= _l('newest_riders') ?></h2>
			<?php echo Modules::run('rider/rider_block/newRiders', 15); ?>

			<h2 class="heading-underline"><?= _l('recent_photos') ?></h2>
			<?php $this->load->view('site/block/flickr.php'); ?>			
		</div>
	</div>

<?php $this->load->footer(); ?>