<?php $this->load->header('Search', 'search_index'); ?>

<div class="page-header"><h1>Search</h1></div>
<div class="row">
  <div class="span8">
	<style type="text/css" media="screen">
		.searchbox.inline { -moz-border-radius:6px; -webkit-border-radius:6px; border-radius:6px; border:1px solid #ddd; }
	</style>
	

	<form action="<?= site_url('search') ?>" method="POST" id="" class="form-search">
		<input name="q" placeholder="Search" id="search" type="text" class=" search-query" />
		<button type="submit" class="btn">Search</button>
	</form>
	
	</div>
	<div class="span4">
		<?= setting('cms_search_sidebar'); ?>
	</div>
</div>

<?php $this->load->footer(); ?>