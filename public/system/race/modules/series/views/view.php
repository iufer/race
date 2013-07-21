<?php $this->load->header($series->series_name, 'series-view'); ?>

<div class="page-header"><h1><?= $series->series_name ?></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li>
				<a href="<?= site_url('series'); ?>"><?= _l('series') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= $series->series_name ?>
			</li>
		</ul>
	</div>		
	<div class="span4 sidebar">		
		<h2 class="subtitle"><?= $series->series_subtitle ?></h2>
		<!-- <h3 class="series_date"><?php echo date("F j", mysql_to_unix($series->series_date_start)); ?> &ndash; <?php echo date("F j", mysql_to_unix($series->series_date_end)); ?></h3> -->
		<span class="description"><?= $series->series_description ?></span>
	</div>
	
	<div class="span8 main">		
		<div class="races">
			<h2><?= _l('races') ?></h2>
			<?php echo Modules::run('race/race_block/series', $series->series_id, $series); ?>
		</div>

		<div class="results"><?php echo Modules::run('result/result_block/series', $series->series_id); ?></div>
	</div>
</div>

<?php $this->load->footer(); ?>