	</div> <!-- <div class="span9"> -->
</div> <!-- <div class="row"> -->

</div><!-- end container-main -->
			
<div class="container-footer-wrapper" style="margin-top:3em;">
	<div class="container container-footer">
		<div class="row">		
			<div class="span6">
				<h3>Site Map</h3>
				<?php echo Modules::run('site/site_block/sitemap'); ?>
			</div>
			<div class="span3">
				<h3>Follow Us</h3>
				<?php echo Modules::run('site/site_block/shareList'); ?>
			</div>
			<div class="span3">
				<h3><?= setting('site_name') ?></h3>
				<p class=""><?= setting('site_description') ?></p>
				<p class="">
					&copy; <?= setting('site_copyright') ?><br>
				</p>
			</div>
		</div>
	</div>
</div>			
		
<?= $data ?>		

</body>
</html>