<?php 
	printf('<div class="display-none"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&display=latest&size=s&layout=x&source=user&user=%1$s"></script></div>',
	setting('site_share_flickr_user'));
?>
<ul id="flickr" class="thumbnails"></ul>

<script type="text/javascript" charset="utf-8">
	require(['helpers/flickr']);
</script>