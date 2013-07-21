<?php $this->load->header(_l('course_index'), 'course_index'); ?>

<div class="page-header"><h1><?= _l('courses') ?></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= _l('courses') ?>
			</li>
		</ul>
	</div>	
	<div class="span3">
		<?php echo setting('cms_course_sidebar'); ?>
		&nbsp;
	</div>
	<div class="span9">
		<?php
			if(count($courses) > 0) {
				$thead = array(
					array(
						array('th' => _l('name')),
						array('th' => _l('miles')),
						array('th' => _l('elevation'))
					)
				);

				$tbody = array('attr'=>array('class'=>"table-condensed"));
				foreach($courses as $course){
					$tbody[] = array(
						array('td' => anchor("course/{$course->course_url}", $course->course_name)),
						array(
							'td' => number_format($course->course_miles, 1),
							'attr' => array('class'=>'text-right')
						),
						array(
							'td' => formatElevation($course->course_elevation),
							'attr' => array('class'=>'text-right')
						)
					);
				}
			}
			else {
				$thead = null;
				$tbody = array(
					array(
						array('td'=> _l('no_courses_to_show'))
					)
				);
			}

			echo buildTable($tbody, $thead, "table table-striped table-bordered", "course_index_table");
		?>
	</div>
</div>

<?php $this->load->footer(); ?>