<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" charset="utf-8">
	require(['jquery'], function($){
		var myLatlng = new google.maps.LatLng(39.73993,-121.826019);
		var myOptions = {
		  zoom: 12,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		var kml = '<?= site_url("course/kml/{$course_url}/". date("m") . date("d") ) ?>';
		var ctaLayer = new google.maps.KmlLayer(kml);
		ctaLayer.setMap(map);
		var bikeLayer = new google.maps.BicyclingLayer();
		bikeLayer.setMap(map);
	});
</script>
<div id="map_canvas" style="width: <?= $width ?>; height: <?= $height ?>"></div>