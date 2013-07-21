<?php $this->load->header('Search Results', 'search_results'); ?>

<div class="page-header"><h1>Search Results <small>&ldquo;<?= $query ?>&rdquo;</small></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>">Home</a> <span class="divider">/</span>
			</li>
			<li class="active">
				<a href="<?= site_url('search'); ?>">Search</a>
			</li>
		</ul>
	</div>	
  <div class="span12">
  	<form action="<?= site_url('search') ?>" method="POST" id="" class="form-search">
		<input name="q" placeholder="Search" id="search" value="<?= $query ?>" type="text" class="search-query" />
		<button type="submit" class="btn">Search</button>
	</form>
  </div>
</div>
<div class="row">
  <div class="span3">
	<h2>Riders</h2>
	<table class="table table-bordered table-striped">
	<?php
		foreach($riders as $rider){
			echo "<tr><td>". anchor("rider/{$rider->rider_id}", $rider->rider_name) ."</td></tr>";
		}
		if(count($riders) == 0) echo "<tr><td>No riders found matching &ldquo;$query&rdquo;</td></tr>";
	?>
	</table>
	</div>
	<div class="span3">
		<h2>Races</h2>
		<table class="table table-bordered table-striped">
		<?php
			foreach($races as $race){
				echo "<tr><td>". anchor("race/{$race->race_url}", $race->race_name) ."<br>". date("l, F j, g:i A", mysql_to_unix($race->race_start_time)) ."</td></tr>";
			}
			if(count($races) == 0) echo "<tr><td>No races found matching &ldquo;$query&rdquo;</td></tr>";	
		?>
		</table>
	</div>
	<div class="span3">

		<h2>Series</h2>
		<table class="table table-bordered table-striped">
		<?php
			foreach($series as $s){
				echo "<tr><td>". anchor("series/{$s->series_url}", $s->series_name) ."</td></tr>";
			}
			if(count($series) == 0) echo "<tr><td>No series found matching &ldquo;$query&rdquo;</td></tr>";	
		?>
		</table>
	</div>
	<div class="span3">

		<h2>Courses</h2>
		<table class="table table-bordered table-striped">
		<?php
			foreach($courses as $course){
				echo "<tr><td>". anchor("course/{$course->course_url}", $course->course_name) ."</td></tr>";
			}
			if(count($courses) == 0) echo "<tr><td>No courses found matching &ldquo;$query&rdquo;</td></tr>";	
		?>
		</table>
	</div>

</div>

<?php $this->load->footer(); ?>