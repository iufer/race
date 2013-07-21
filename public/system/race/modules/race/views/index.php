<?php  $this->load->header( _l('race_index'), 'race_index'); ?>

<div class="page-header"><h1><?= _l('races') ?></h1></div>

<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= _l('races') ?>
			</li>
		</ul>
	</div>
	<div class="span3">
		<?php 
			if(isset($race_type->race_type_id)){
				$race_type_id = $race_type->race_type_id;
				$race_type_name = ': '. $race_type->race_type_description;
			}
			else {
				$race_type_id = false;
				$race_type_name = false;			
			}
		
			echo Modules::run('race_type/race_type_block/listing', 'race/index/0/', $race_type_id); ?>


		<?php echo Modules::run('search/search_block/mini', false); ?>		
		
		<!-- CMS RACE sidebar -->
		<?php echo setting('cms_race_sidebar'); ?>	
	
		
		<a href="<?= site_url('race/rss') ?>" class="btn"><i class="icon-star"></i> <?= _l('upcoming_races_rss') ?></a>
	</div>

	<div class="span9">
		<h2><?= _l('upcoming_races') ?><?= $race_type_name ?></h2>	
		<?php
			$thead = array(
				array(
					array('th' => _l('name')),
					array('th' => _l('type')),
					array('th' => _l('date')),
					array('th' => _l('distance')),
					array('th' => _l('elevation'))
				)
			);

			$tbody = array();
			if( count($races) > 0 ) {
				foreach($races as $race){
					if($race->race_laps > 1){
						$total_distance = $race->race_laps * $race->course_miles;
						$total_elevation = $race->race_laps * $race->course_elevation;
					}
					else {
						$total_distance = (! is_null($race->course_miles)) ? $race->course_miles : 0;
						$total_elevation = (! is_null($race->course_elevation)) ? $race->course_elevation : 0;
					}

					$tbody[] = array(
						array(
							'td' => anchor("race/{$race->race_url}", $race->race_name),
							'attr' => array('class'=>'race_name')
						),
						array(
							'td' => $race->race_type_description,
							'attr' => array('class'=>'race_type')
						),
						array(
							'td' => date("D, M j, g:i a", mysql_to_unix($race->race_start_time)),
							'attr' => array('class'=>'race_date')
						),
						array(
							'td' => formatMiles($total_distance),
							'attr' => array('class'=>'course_miles text-right')
						),
						array(
							'td' => formatElevation($total_elevation),
							'attr' => array('class'=>'course_elevation text-right')
						)
					);			
				}
			}
			else {
				$thead = null;
				$tbody[] = array(
					array('td' => _l('no_upcoming_races'))
				);
			}	

			echo buildTable($tbody, $thead, "table table-bordered table-striped", "race_index_table");		
		?>
			
	
		<h2><?= _l('past_races') ?> <?= $race_type_name ?></h2>
		<?php

			$thead = array(
				array(
					array(
						'th' => _l('name'),
						'attr' => array('width'=>'40%')
					),
					array('th' => '<i class="icon-time"></i>'),
					array('th' => _l('type')),
					array('th' => _l('date'))
				)
			);

			$tbody = array();
			if( count($past_races) > 0 ) {
				$tbody['attr'] = array('class'=>'table-condensed');

				foreach($past_races as $race){
					if($race->race_laps > 1){
						$total_distance = $race->race_laps * $race->course_miles;
						$total_elevation = $race->race_laps * $race->course_elevation;
					}
					else {
						$total_distance = (! is_null($race->course_miles)) ? $race->course_miles : 0;
						$total_elevation = (! is_null($race->course_elevation)) ? $race->course_elevation : 0;
					}			
					
					$tbody[] = array(
						array(
							'td' => anchor("race/{$race->race_url}", $race->race_name),
							'attr' => array('class'=>'race_name')
						),
						array(
							'td' => ($race->result_count > 0) ? anchor("race/{$race->race_url}#results", ' <i class="icon-time"></i>', array('title'=> _l('results_available'))) : '&nbsp;'
						),
						array(
							'td' => $race->race_type_description,
							'attr' => array('class'=>'race_type')
						),
						array(
							'td' => date("l, F j, Y", mysql_to_unix($race->race_start_time)),
							'attr' => array('class'=>'race_date')
						)
					);
				}
			}
			else {
				$thead = null;
				$tbody[] = array(
					array('td' => _l('no_past_races'))
				);
			}

			echo buildTable($tbody, $thead, "table table-bordered table-striped", "race_index_table");
		?>
		
		<p><?= $showing ?></p>
		<?= $this->pagination->create_links(); ?>
		
	</div>

</div>

<?php $this->load->footer(); ?>