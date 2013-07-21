<?php 
$this->load->addJS('rider/edit.js');
$this->load->header('Rider Detail', 'rider_view');
?>

<script type="text/javascript" charset="utf-8">
	var rider_id = <?= $rider->rider_id ?>;
</script>

<ul class="breadcrumb">
  <li><?= anchor("admin", "Admin") ?> <span class="divider">/</span></li>
  <li><?= anchor("admin/rider", "Riders") ?> <span class="divider">/</span></li>
  <li>Edit Rider</li>
</ul>
<h2 class="heading-underline"><?= $rider->rider_name ?></h2>

<?php
$flash = $this->session->flashdata('updated');
if($flash) {
	echo "<div class='alert info'>$flash</div>";
}

$data = array(
	'form_action'=> "admin/rider/edit/{$rider->rider_id}",
	'name' => $rider->rider_name,
	'rider_categories' => $rider_categories,
	'rider_category_id' => $rider->rider_rider_category_id,
	'public' => $rider->rider_public,
	'date_created' => date("F j, g:i a", mysql_to_unix($rider->rider_date_created)),
	'date_modified' => date("F j, g:i a", mysql_to_unix($rider->rider_date_modified)),
	'profile_views' => $rider->rider_profile_views,
	'form_submit' => 'Save Rider'
);

$this->load->view('rider/admin/_form', $data);

$this->load->footer();