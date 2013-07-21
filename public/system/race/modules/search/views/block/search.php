<?php
	//echo form_open('search', array('id'=>'xsearchform', 'class'=>'navbar-search pull-right'));
	// echo '<input type="search" name="q" id="search" placeholder="Search">';
	//echo '<input name="q" placeholder="Search" id="search" type="text" class="search-query" />';
	//if($showButton) echo '<button class="action">Search</button>';
	//echo form_close();
?>

<form action="<?= site_url('search') ?>" method="POST" id="" class="navbar-search pull-right">
	<input name="q" placeholder="Search" id="search" type="text" class="search-query" />
</form>