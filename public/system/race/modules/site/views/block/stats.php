<?php 
// pr($data); 

// (
//     [time] => 78179
//     [points] => 64
//     [miles] => 238.079998254776
//     [courses] => 14
//     [scheduled_races] => 0
//     [riders] => 44
//     [laps] => 40
//     [series] => 7
//     [tt] => 15
//     [past_races] => 28
// )

?>
<div style="position:relative; z-index:10;" class="bubbletexts" id="bubbletexts"></div>
<div id="bubbles" style="width:100%; position:relative; z-index:0;"></div>
<script type="text/javascript" charset="utf-8">
	/* 			 
		makeBubble( x origin, y origin, radius, color index, animation order, data, label, data class, label class, strong output );
	*/
	$(function(){
		var paper = Raphael(document.getElementById('bubbles'), 940, 302);
		paper.bubbleDefaults.labelClass += ' fontb';

		paper.makeBubble(90, 98, 50, 0, 5, '<?= $data->courses ?>', 'courses', 'fontc')
			 .makeBubble(143, 196, 75, 1, 4, '<?= $data->scheduled_races ?>', 'scheduled races', 'fontb',null,true)
			 .makeBubble(380, 230, 50, 3, 2, '<?= $data->riders ?>', 'riders', 'fonta')
			 .makeBubble(282, 140, 93, 2, 3, '<?= number_format($data->miles) ?>', 'miles raced this year', 'fontc')
			 .makeBubble(426, 112, 68, 0, 1, '<?= $data->laps ?>', 'laps raced this year', 'fontc')
			 .makeBubble(624, 95, 62, 3, 2, '<?= $data->series ?>', 'series', 'fontb',null,true)
			 .makeBubble(540, 200, 80, 1, 2, '<?= number_format($data->time / 60) ?>', 'minutes raced', 'fontc')
			 .makeBubble(699, 232, 50, 0, 3, '<?= $data->tt ?>', 'time trials', 'fonta')
			 .makeBubble(749, 127, 84, 2, 4, '<?= number_format($data->points) ?>', 'points awarded', 'fontc')
			 .makeBubble(868, 188, 58, 1, 5, '<?= $data->past_races ?>', 'past races', 'fonta');
	});			
</script>