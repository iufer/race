<?php 
$this->load->header($race->race_name, 'race-view');
requirejs('views/race.view');
?>

<div class="page-header"><h1><?= anchor("race/{$race->race_url}", $race->race_name) ?> <?php if($race->is_past) echo "<small>". _l("This event occured in the past") ."</small>";  ?></h1></div>

<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li>
				<a href="<?= site_url('race'); ?>"><?= _l('races') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= $race->race_name ?>
			</li>
		</ul>
	</div>		
	<div class="span8">
		<?php echo Modules::run('message/message_block/latest', $race->race_id); ?>

		<h2><?= date("l, F j, g:i A", mysql_to_unix($race->race_start_time)); ?></h2>
		<?php if($race->race_subtitle != '') echo "<h3>{$race->race_subtitle}</h3>"; ?>					
	
		<?php if($race->race_race_status_id == 3) : ?>
			<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>
				<strong><?= _l('race_canceled') ?></strong> <?= _l('this_race_has_been_canceled') ?>
			</div>
		<?php endif; ?>
	
		<?php 
			// Registration Start Time
			if(!$race->is_past) echo "<p>". _l('registration_starts_at') ." ". date("g:i A", mysql_to_unix($race->race_registration_time)) ."</p>";
		
		?>
		<p><?= $race->race_description ?></p>

		<?php if($race->course_name) : ?>
			<h3><?= $race->course_name ?> <small><?= anchor("course/{$race->course_url}", _l('course_detail')) ?></small></h3>
			<?php echo Modules::run('course/course_block/map', $race->course_url); ?>
		<?php endif; ?>
	</div>

	<div class="span4">	
		<?php /*
		<div style="position:relative; z-index:10;" class="bubbletexts" id="bubbletexts"></div>
		<div id="bubbles" style="width:100%; position:relative; z-index:0;"></div>
		<script type="text/javascript" charset="utf-8">
		
			require(['raphael','race','plugins/raphael.makeBubble'], function(Raphael, Race){
				Race.paper = Raphael(document.getElementById('bubbles'), 288, <?= ($race->race_laps > 1) ? '358':'228'; ?> ); 
				Race.paper.bubbleDefaults.labelClass += ' fontb';
				Race.paper.makeBubble(85, 70, 55, 0, 1, '<?= number_format($race->course_elevation) ?>', '<?= _ll('ft_climb') ?>', 'fontc');
				Race.paper.makeBubble(205, 110, 80, 4, 2, '<?= number_format($race->course_miles,1) ?>', '<?= _ll('miles') ?>', 'fontc', null, true);
			});
			
		</script>
		*/ ?>
		
		<?php if($race->race_sponsor_id > 0) : ?>
			<h3><?= _l('race_sponsor') ?></h3>
			<div class="well"><?php echo Modules::run('sponsor/sponsor_block/view', $race->race_sponsor_id); ?></div>			
		<?php endif; ?>
	

		<h3><?= _l('details') ?></h3>
		<?php
			// start race details table
			$rows = array();

			// Attending
			if(!$race->is_past) {
				$rows[] = array(
					array('th' => _l('attending')),
					array('td' => $race->race_will_attend_count)
				);
					
				$this->load->library('session');
				$attending = $this->session->userdata('races_attending');

				$is_attending = (is_array($attending) and in_array( $race->race_id, $attending) );

				$rows[] = array(
					array('th' => "&nbsp;"),
					array(
						'td' => sprintf('<a href="willAttend/%s" class="btn will_attend %s">%s</a>',
								$race->race_id,
								($is_attending) ? 'disabled' : '',
								($is_attending) ? _l('you_are_attending') : _l('ill_be_there')
							)
					)
				);
			}

			// Race Type
			$rows[] = array(
				array('th' => _l('race_type')),
				array('td' => $race->race_type_description)
			);

			// Race Laps
			if($race->race_laps > 1) {
				$rows[] = array(
					array('th' =>  _l('laps')),
					array('td' => $race->race_laps)
				);
				 /*
				?>
					<script type="text/javascript" charset="utf-8">
						require(['raphael','plugins/raphael.makeBubble','race'], function(Raphael, null, Race){
							Race.paper.makeBubble(110, 210, 75, 3, 3, "<?= $race->race_laps ?>", "<?= _ll('laps') ?>", "fonta", null, true); });
						});
					</script>
				<?php
				*/
			}

			// Course Miles
			if(!is_null($race->course_miles)) {
				if($race->race_laps > 1){
					$rows[] = array(
						array('th' => _l('course')),
						array('td' => formatMiles($race->course_miles))
					);
					$rows[] = array(
						array('th' => _l('total_distance')),
						array('td' => formatMiles($race->course_miles * $race->race_laps))
					);	
				}
				else {
					$rows[] = array(
						array('th' => _l('distance')),
						array('td' => formatMiles($race->course_miles))
					);
				}
			}

			// Elevation
			if(!is_null($race->course_elevation)) {
				$rows[] = array(
					array('th' => _l('elevation')),
					array('td' => formatElevation($race->course_elevation))
				);
			}

			// Grade
			if(!is_null($race->course_elevation) and !is_null($race->course_miles)) {
				$rows[] = array(
					array('th' => _l('grade')),
					array('td' => courseAverageGrade($race->course_elevation, $race->course_miles) . _l('%_average'))
				);
			}

			// Category Climb
			if($race->course_category_climb and $race->course_category_climb > 0) {
				$rows[] = array(
					array('th' => _l('climb_category')),
					array('td' => $race->course_category_climb)
				);
			}

			// Helmets
			$rows[] = array(
				array('th' => _l('helmets')),
				array('td' => _l('mandatory'))
			);

			echo buildTable($rows, NULL, 'table table-bordered table-condensed');
		?>

	
		<?php
			// Show the Point Bracket
			$pb = setting('race_point_bracket', true);

			//Point Bracket Multiplier
			if($race->race_point_bracket == 1){
				$bracket = $pb[$race->race_point_bracket_multiplier];			
				echo "<h3>{$bracket->name}</h3>";
			}

			if($race->race_point_bracket == 1){
				$bracket = $pb[$race->race_point_bracket_multiplier];
				$b = $bracket->b;

				$rows = array();
				$half = floor(count($b)/2);

				for($i=0;$i < $half;$i++){
					$rows[] = array(
						array(
							'th' => "<strong>". formatPlace($i +1) ."</strong>",
							'attr' => array('class' => 'text-right')
						),
						array('td' => $b[$i] ." ". _l('points')),
						array(
							'th' => "<strong>". ((isset($b[$half+$i])) ? formatPlace($half+$i+1) : '') ."</strong>",
							'attr' => array('class' => 'text-right')
						),
						array('td' => (isset($b[$half+$i])) ? $b[$half+$i] ." ". _l('points') : '')
					);					
				}
				$rows[] = array(
					array(
						'th' => 'etc.',
						'attr' => array('class' => 'text-right')
					),
					array(
						'td' => $bracket->remainder ." ". _l('point'),
						'attr' => array('colspan' => 3)
					)
				);

				echo buildTable($rows, null, 'table table-bordered table-condensed table-striped');
			}
		?>
		
		<h3><?= _l('series') ?></h3>
		<?php echo Modules::run('series/series_block/race', $race->race_id); ?>		
		
	</div>
</div>
<br><br>

<?php if($race->has_results > 0) : ?>
<!-- <div class="page-header"><h2><?= _l('results') ?><a name="results"></a></h2></div> -->
<div class="row">
	<div class="span12">
		<?php echo Modules::run('result/result_block/race', $race->race_id); ?>
	</div>
</div>
<?php endif; ?>

<div class="page-header"><h2><?= _l('comments') ?><a name="comments"></a></h2></div>
<div class="row">
	<div class="span8">
		<?php echo Modules::run('race/race_block/comments', $race->race_id); ?>
	</div>
</div>

<?php $this->load->footer();
