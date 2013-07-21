<?php $this->load->header($course->course_name, 'course_view'); ?>

<div class="page-header"><h1><?= anchor("course/{$course->course_url}", $course->course_name ) ?></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li>
				<a href="<?= site_url('course'); ?>"><?= _l('courses') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= $course->course_name ?>
			</li>
		</ul>
	</div>		
	
	<div class="span8">		
		<?php echo Modules::run('course/course_block/map', $course->course_url, '100%', '500px'); ?>

		<h3><?= _l('races_on_this_course') ?></h3>
		<?php echo Modules::run('race/race_block/course', $course->course_id); ?>
	</div>

	<div class="span4">
		<?php /*
		<div style="position:relative; z-index:10;" class="bubbletexts" id="bubbletexts"></div>
		<div id="bubbles" style="width:100%; position:relative; z-index:0; "></div>
		<script type="text/javascript" charset="utf-8">
		
			require(['raphael','plugins/raphael.makeBubble'], function(Raphael){
				var paper = Raphael(document.getElementById('bubbles'), 288, 268);
				paper.bubbleDefaults.labelClass += ' fontb';

				paper.makeBubble(80, 70, 60, 0, 5, '<?= number_format($course->course_elevation) ?>', 'ft climb', 'fontc')
				paper.makeBubble(105, 195, 54, 4, 5, '<?= $course->course_category_climb ?>', 'category climb', 'fonta')
				paper.makeBubble(195, 110, 80, 3, 4, '<?= number_format($course->course_miles, 1) ?>', 'miles', 'fontc', null, true);
				 
			});			
		</script>
		*/ ?>
		
		<h3><?= _l('details') ?></h3>
		<?php
			$tbody = array(
				array(
					array('th' => _l('distance')),
					array('td' => formatMiles($course->course_miles))
				),
				array(
					array('th' => _l('elevation')),
					array('td' => formatElevation($course->course_elevation))
				),
				array(
					array('th' => _l('climb_category')),
					array('td' => $course->course_category_climb)
				),
				array(
					array(
						'td' => courseAverageGrade($course->course_elevation, $course->course_miles) . _l('%_average_grade'),
						'attr'=> array('colspan'=>2)
					)
				)
			);		
			echo buildTable($tbody, null, 'table table-bordered');
		?>		
	
		<h3><?= _l('fastest_times') ?></h3>
		<?php echo Modules::run('result/result_block/course', $course->course_id, 10); ?>
	</div>
</div>

<?php $this->load->footer(); ?>