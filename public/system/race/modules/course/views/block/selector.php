<script type="text/javascript" charset="utf-8">
	require(['views/course.selector']);
</script>

<!-- Modal Control -->
<a href="#course_selector" class="btn" data-toggle="modal">Select Course</a>

<!-- Course Listing -->
<div class="well" style="margin-top:10px;">
	<?php
		printf('<span id="course_name">%1$s</span> <input type="hidden" name="course_id" id="course_id" value="%2$s" /> <button class="course_clear btn btn-mini" style="margin-left:15px; %3$s">Clear</button>',
			($default) ? $default->course_name : 'No course selected',
			($default) ? $default->course_id : 'display:none;',
			($default) ? '' : ''
		);
	?>
</div>

<!-- Modal Window -->
<div id="course_selector" class="modal" style="display:none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h2>Course Selector</h2>
	</div>
	<div class="modal-body">
		<table class="table table-bordered">
			<thead><tr><th width="60%">Name</th><th width="15%">Miles</th><th width="15%">Elevation</th></tr></thead>
		</table>
	
		<div class="course_selector_data_wrap">
			<table class="table table-bordered table-condensed table-striped course_selector_data">
			<?php
				foreach($courses as $course){
					printf('<tr id="%s">'.
						'<td width="60%%" class="course_name"><a href="#" data-course-id="%s">%s</a></td>'.
						'<td width="15%%" class="course_miles">%s</td>'.
						'<td width="15%%" class="course_elevation">%s</td></tr>',
						$course->course_url,
						$course->course_id,
						$course->course_name,
						formatMiles($course->course_miles),
						formatElevation($course->course_elevation)
						);
				}
			?>	
			</table>
		</div>

	</div>	
	<div class="modal-footer">
		<div class="form-search pull-left">
			<div class="input-append">
				<input type="text" class="course_search search-query span2" placeholder="Search"/>
				<button class="btn course_search_clear">Clear</button>
			</div>
		</div>
		<button data-dismiss="modal" class="btn btn-primary">Done</button>
		<button data-dismiss="modal" class="btn">Cancel</button>
	</div>
</div>

<style type="text/css" media="screen">
	.course_selector_data_wrap {
		width:100%;
		overflow:auto; 
		height:270px;
	}		
</style>
