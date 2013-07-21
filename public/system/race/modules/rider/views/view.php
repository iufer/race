<?php $this->load->header($rider->rider_name, 'rider-view'); ?>

<div class="page-header"><h1><?= anchor("rider/{$rider->rider_id}", $rider->rider_name ." ". formatRiderId($rider->rider_id)) ?></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li>
				<a href="<?= site_url('rider'); ?>"><?= _l('riders') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= $rider->rider_name ?> <?= formatRiderId($rider->rider_id) ?>
			</li>
		</ul>
	</div>
	
	<div class="span4 sidebar">				
		<p class="caption"><?= _l('last_raced_with') ?></p>
		<h2><?= $rider->rider_category_name ?></h2>

		<div class="podium">
			<h3><?= _l('podium') ?></h3>
			<?php echo Modules::run('result/result_block/podium', $rider->rider_id); ?>
		</div>

		<div class="race-types">
			<h3><?= _l('race_types') ?></h3>
			<?php echo Modules::run('result/result_block/riderRaceTypes', $rider->rider_id); ?>
		</div>

        <h3><?= _l('details') ?></h3>
		<?php
			$tbody = array(
				array(
					array('th' => _l('rider_id'), 'attr' => array('width'=>'30%') ),
					array('td' => formatRiderId($rider->rider_id) )
				),
				array(
					array('th' => _l('joined') ),
					array('td' => date("F j, Y", mysql_to_unix($rider->rider_date_created)) )
				),
				array(
					array('th' => _l('miles') ),
					array('td' => Modules::run('result/result_block/riderTotalMiles', $rider->rider_id) ),
				),
				array(
					array('th' => _l('first_race') ),
					array('td' => Modules::run('result/result_block/riderFirstRace', $rider->rider_id) ),
				),
				array(
					array('th' => _l('last_race') ),
					array('td' => Modules::run('result/result_block/riderLastRace', $rider->rider_id) ),
				),
				array(
					array('th' => _l('views') ),
					array('td' => number_format($rider->rider_profile_views) )
				)
			);
		
			echo buildTable($tbody, null, 'table table-bordered table-striped');
		?>
	</div>
	
	<div class="span8">		
		<?php 
			list($rider_name) = explode(' ', $rider->rider_name);
			echo Modules::run('result/result_block/riderLatest', $rider->rider_id, $rider_name); 
		?>
		<br><br>

		<!-- Paging Results -->
		<div class="results">
			<?php echo Modules::run('result/result_block/rider', $rider->rider_id, false, 'rider/view/'. $rider->rider_id .'/', $pagination_from); ?>
		</div>
	</div>

</div>

<?php $this->load->footer(); ?>	