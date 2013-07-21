<?php $this->load->header( _l('series_index'), 'series_index'); ?>

<div class="page-header"><h1><?= _l('series') ?></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<?= _l('series') ?>
			</li>
		</ul>
	</div>	
	<div class="span3">
		<?php echo setting('cms_series_sidebar'); ?>
		&nbsp;
	</div>
	<div class="span9">	
		<?php

			if($series) {
				$thead = array(
					array(
						array(
							'th' => _l('name')
						),
						array(
							'th' => _l('date')
						)
					)
				);

				$tbody = array('attr'=>array('class'=>"table-condensed"));

				foreach($series as $s){
					$tbody[] = array(
						array(
							'td' => anchor("series/{$s->series_url}", $s->series_name)
						),
						array(
							'td' => date("F j", mysql_to_unix($s->series_date_start)) ." &ndash; ". date("F j, Y", mysql_to_unix($s->series_date_end))
						)
					);					
				}
			}
			else {
				$thead = null;
				$tbody = array(
					array(
						array('td'=>"No series available")
					)
				);
			}

			echo buildTable($tbody, $thead, "table table-bordered table-striped", "series_index_table");		
		?>
	</div>
</div>

<?php $this->load->footer(); ?>