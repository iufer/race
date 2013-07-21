<?php
$this->load->header('Race Index', 'race_index'); 
requirejs('views/race.index');
?>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li>Races</li>
</ul>
<h2 class="heading-underline">Race Index</h2>

<ul class="nav nav-tabs">
  <li class="active"><a href="#upcoming-races" data-toggle="tab">Upcoming Races</a></li>
  <li><a href="#past-races" data-toggle="tab">Past Races</a></li>
</ul>

<div class="tab-content">
	<div id="upcoming-races" class="tab-pane active">
		<?php
		if( count($races) > 0 ) {
			$thead = array(
				array(
					array('th' => _l('name')),
					array('th' => _l('date')),
					array('th' => _l('status')),
					array('th' => _l('actions'))
				)
			);

			$tbody = array(
				array('attr' => array('class'=>'table-condensed'))
			);

			foreach($races as $race){
				$tbody[] = array(
					array('td' => anchor("admin/race/edit/{$race->race_id}", $race->race_name) ),
					array('td' => date("F j, g:i a", mysql_to_unix($race->race_start_time)) ),
					array('td' => form_dropdown($race->race_id, $race_statuses, $race->race_status_id, 'class="race_status span2"') ),
					array('td' => $this->load->view('admin/_actions', $race, true))
				);		
			}
		}
		else {
			$thead = null;
			$tbody = array( array( array('td' => "No upcoming races. ". anchor("admin/race/add", 'Add New Race', 'class="btn btn-mini btn-primary"') )));
		}

		echo buildTable($tbody, $thead, 'table table-bordered table-striped');
		?>
	</div>

	<div id="past-races" class="tab-pane">
		<?php
		// Past Races		
		if( count($past_races) > 0 ) {
			$thead = array(
				array(
					array('th' => _l('name'), 'attr' => array('width' => '33%')),
					array('th' => _l('date')),
					array('th' => '<i class="icon-time"></i>'),
					array('th' => _l('status')),
					array('th' => _l('actions'))
				)
			);

			$tbody = array(array('attr' => array('class'=>'table-condensed')));

			foreach($past_races as $race){
				$tbody[] = array(
					array('td' => anchor("admin/race/edit/{$race->race_id}", $race->race_name) ),
					array('td' => date("F j, g:i a", mysql_to_unix($race->race_start_time)) ),
					array('td' => ($race->result_count > 0) ? anchor("admin/race/edit/{$race->race_id}", '<i class="icon-time"></i>') : '' ),
					array('td' => form_dropdown($race->race_id, $race_statuses, $race->race_status_id, 'class="race_status span2"') ),
					array('td' => $this->load->view('admin/_actions', $race, true) )
				);		
			}
		}
		else {
			$thead = null;
			$tbody = array( array( array('td' => 'No past races.') ) );
		}

		echo buildTable($tbody, $thead, 'table table-bordered table-striped');
		?>
	</div>
</div>
<?php $this->load->footer();