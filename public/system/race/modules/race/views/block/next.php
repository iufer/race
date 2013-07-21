<?php if($next) : ?>
	<span class="gray4"><?= anchor("race/{$next[0]->race_url}", $next[0]->race_name, 'class="color-a"') ?> in <?= findTime(mysql_to_unix($next[0]->race_start_time), '<em><span class="gray6">%d</span> Days, <span class="gray6">%h</span> Hours, <span class="gray6">%m</span> Minutes</em>') ?></span>
<?php else : ?>
	<span class="gray3">No upcoming races</span>
<?php endif; ?>