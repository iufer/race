<?php $this->load->header( _l('rider_index'), 'rider_index'); ?>

<div class="page-header"><h1><?= _l('riders') ?></h1></div>
<div class="row">
	<div class="span12">
		<ul class="breadcrumb">
			<li>
				<a href="<?= site_url(); ?>"><?= _l('home') ?></a> <span class="divider">/</span>
			</li>
			<li class="active">
				<a href="<?= site_url('rider'); ?>"><?= _l('riders') ?></a>
			</li>
		</ul>
	</div>
	
	<div class="span3">
		<?php echo Modules::run('rider_category/rider_category_block/listing', 'rider/index/'); ?>
		<?php echo Modules::run('search/search_block/mini', false); ?>				
								
		<?php echo setting('cms_rider_sidebar'); ?>
		
		<script type="text/javascript" charset="utf-8">
			require(['jquery'], function($){
				// auto select the sidebar based on what's in the header
				var id = $('#rider_category_header').data('rider-category-id');
				$('li.rider_category').each( function(){
					if( $(this).data('rider-category-id') == id ){
						$(this).addClass('active');
					}
				});
			});
		</script>
	</div>
	
	<div class="span9">
		<?php if($rider_category) : ?>
			<h2 id="rider_category_header" data-rider-category-id="<?= $rider_category->rider_category_id ?>"><?= $rider_category->rider_category_name ?></h2>
		<?php endif; ?>
		
		<?php
			if($riders) {
				$thead = array(
					array(
						array(
							'th' => _l('name')
						),
						array(
							'th' => _l('category')
						),
						array(
							'th' => _l('races')
						)
					)
				);

				$tbody = array('attr'=>array('class'=>'table-condensed'));
				foreach($riders as $rider){
					$tbody[] = array(
						array(
							'td' => anchor("rider/{$rider->rider_id}", "{$rider->rider_name} <span class='result_rider_id'>".formatRiderId($rider->rider_id)."</span>"),
							'attr' => array('class'=>"rider_name", 'width'=>"45%")
						),
						array(
							'td' => $rider->rider_category_name,
							'attr' => array('class'=>"rider_category")
						),
						array(
							'td' => $rider->race_count,
							'attr' => array('class'=>"rider_race_count text-right")
						)
					);
				}
			}
			else {
				$thead = null;
				$tbody = array(
					array(
						array('td'=> _l('no_riders_to_display'))
					)
				);
			}
			echo buildTable($tbody, $thead, "table table-bordered table-striped", "rider_index_table");
		?>

		<p><?= $showing ?>, <?= _ll('sorted_by_name') ?>.</p>		
		<?= $this->pagination->create_links(); ?>
	</div>
</div>

<?php $this->load->footer(); ?>