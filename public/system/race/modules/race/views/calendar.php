<div class="row" style="margin-bottom:0.5em;">
	<div class="span10"><h2><?= $month ?> <img class="calendar-loading" src="<?= base_url('img/ajax-loader.gif') ?>" style="display:none;" /></h2></div>
	<div class="span2">		
		<div class="btn-group pull-right">
			<button class="calbutton btn btn-mini" data-action="prev"><i class="icon-chevron-left"></i></button>
			<button class="calbutton btn btn-mini" data-action="next"><i class="icon-chevron-right"></i></button>
		</div>
	</div>
</div>
<?= $calendar ?>