</div> <!-- end main container -->

<!-- <div class="container container-sponsors">
	<div class="row">	
		<div class="span12">
			<h3><?= setting('site_name') ?> Sponsors</h3>

				<?php echo Modules::run('sponsor/sponsor_block/footer'); ?>			

		</div>
	</div>
</div> -->


<div class="container-footer-wrapper">
	<div class="container container-footer">
		<div class="row">		
			<div class="span6">
				<h4><?= _l('site_map') ?></h4>
				<?php echo Modules::run('site/site_block/sitemap'); ?>
			</div>
			<div class="span3">
				<h4><?= _l('follow_us') ?></h4>
				<?php echo Modules::run('site/site_block/shareList'); ?>
			</div>
			<div class="span3">
				<h4><?= setting('site_name') ?></h4>
				<p><?= setting('site_description') ?></p>
				<p><small>&copy; <?= setting('site_copyright') ?></small></p>
				
				<a class="btn" href="<?= site_url('admin'); ?>">Director Login</a>
				
			</div>
		</div>
	</div>
</div>


	<?php if( setting('site_google_analytics_account') !== '') : ?>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '<?= setting('site_google_analytics_account') ?>']);
	  _gaq.push(['_setDomainName', '<?= setting('site_domain') ?>']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>	
	<?php endif; ?>
	
	<?= $data ?>
		
</body>
</html>