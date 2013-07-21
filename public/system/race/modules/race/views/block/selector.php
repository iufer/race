<script type="text/javascript" charset="utf-8">
	require(['views/race.selector']);
</script>

<!-- Modal Control -->
<a href="#race_selector" class="btn" data-toggle="modal">Select Races</a>

<!-- Race Listing -->
<div class="well" style="margin-top:10px;">
	<ul id="race_list">
	<?php
		foreach($defaults as $default){
			echo "<li id='race_id_{$default->race_id}' class='race_item' data-race-url='{$default->race_url}' data-race-date='". mysql_to_unix($default->race_start_time) ."'>";
				echo "<span class='race_name'>{$default->race_name} (". date("F j, Y", mysql_to_unix($default->race_start_time)) .")</span>";
				echo '<input type="hidden" name="races[]" class="race_id" value="'. $default->race_id .'" />';
				echo '<a href="#remove" class="btn btn-mini race_clear">Remove</a>';
			echo "</li>";
		}	
	?>
	</ul>
</div>

<!-- Modal Window -->
<div id="race_selector"  class="modal" style="display:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Race Selector</h3>
	</div>
	<div class="modal-body">
		<table class="table table-bordered">
			<tr><th width="50%">Name</th><th width="35%">Date</th></tr>
		</table>
		<div class="race_selector_data_wrap">
			<table class="table table-bordered table-condensed table-striped race_selector_data">
			<?php
				foreach($races as $race){
					printf('<tr id="%1$s" class="race_selector_item" data-race-url="%2$s" data-race-date="%3$s">'.
						'<td width="50%%" class="race_name"><a href="#" data-race-id="%4$s">%5$s</a></td>'.
						'<td width="35%%" class="race_date">%6$s</td></tr>',
						$race->race_url,
						$race->race_url,
						mysql_to_unix($race->race_start_time),
						$race->race_id,
						$race->race_name,
						date("F j, Y", mysql_to_unix($race->race_start_time))
						);
				}
			?>	
			</table>
		</div>		
		
	</div>
	<div class="modal-footer">
		<div class="form-search pull-left">
			<div class="input-append">
				<input type="text" class="race_search search-query span2" placeholder="Search"/>
				<button class="btn race_search_clear">Clear</button>
			</div>
		</div>
		<button data-dismiss="modal" class="btn btn-primary">Done</button>
		<button data-dismiss="modal" class="btn">Cancel</button>
	</div>	
</div>


<style type="text/css" media="screen">
	#race_list li {
		list-style-type: decimal;
	}
	.race_selector_item.selected a {
		color:#bbb !important;
	}
	.race_selector_done {
		float:right;
		margin-top:5px;
		padding-left:4em;
		padding-right:4em;
	}
	.race_selector_data_wrap {
		width:100%;
		overflow:auto; 
		height:270px;
	}
	.race_item { 
		padding:0.5em;
	}
	.race_clear {
		display:inline-block;
		margin-left:15px;
		font-size:85%;
		cursor:pointer;
	}
</style>
