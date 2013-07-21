<div class="frame borderc3 clearfix">
	<header class="bgc3">
		<span class="racefont"><?= $message->message_title ?></span>
	</header>
	<article>
		<p><?= $message->message_message ?></p>
		<span class="gray3 nicetext">Posted by <?= $message->user_name ?> on <?= date('F j, Y, \a\t g:i a', mysql_to_unix($message->message_date_created)) ?></span>
	</article>	
</div>