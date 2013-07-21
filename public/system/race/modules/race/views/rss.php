<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<rss version="2.0">
	<channel>
		<title><?= setting('site_name') ?> Upcoming Races Feed</title>
		<link><?php echo $feed_url; ?></link>
	    <description><?php echo $page_description; ?></description>
		<lastBuildDate><?= date(DATE_RFC822); ?></lastBuildDate>
	    <pubDate><?= date(DATE_RFC822); ?></pubDate>
	    <ttl>1800</ttl>
	
		<?php foreach($posts as $post): ?>
	        <item>
				<title><?= $post->race_name ?></title>
	            <description><![CDATA[ <?php echo character_limiter($post->race_description, 500); ?> ]]></description>
				<link><?= site_url("race/{$post->race_url}") ?></link>
	        	<guid><?= site_url("race/{$post->race_url}") ?></guid>
				<pubDate><?= date(DATE_RFC822, mysql_to_unix($post->race_start_time)); ?></pubDate>
	        </item>
	    <?php endforeach; ?>
	
	</channel>
</rss>
