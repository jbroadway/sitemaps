<?php

$file = 'cache/sitemap.xml';

if (! file_exists ($file) || filemtime ($file) < time () - $appconf['Sitemap']['regenerate']) {
	// Generate sitemap file
	$urls = array ();

	$pages = Webpage::query ()
		->where ('access', 'public')
		->fetch_orig ();
	foreach ($pages as $page) {
		$urls[] = '/' . $page->id;
	}
	unset ($pages);

	require_once ('apps/blog/lib/Filters.php');
	$posts = blog\Post::query ()
		->where ('published', 'yes')
		->fetch_orig ();
	foreach ($posts as $post) {
		$urls[] = sprintf ('/blog/post/%d/%s', $post->id, blog_filter_title ($post->title));
	}
	unset ($posts);

	if (file_exists ('apps/events')) {
		require_once ('apps/events/lib/Filters.php');
		$events = Event::query ()
			->where ('start_date >= "' . gmdate ('Y-m-01 00:00:00') . '"')
			->where ('end_date <= "' . gmdate ('Y-m-t 23:59:59') . '"')
			->fetch_orig ();
		foreach ($events as $event) {
			$urls[] = sprintf ('/events/%d/%s', $event->id, events_filter_title ($event->title));
		}
		unset ($events);
	}

	if (file_exists ('apps/wiki')) {
		$wiki = Wiki::query ('id')
			->order ('id asc')
			->fetch_orig ();
		foreach ($wiki as $page) {
			$urls[] = sprintf ('/wiki/%s', $page->id);
		}
		unset ($wiki);
	}

	file_put_contents ($file, $tpl->render ('sitemap.xml/index', array ('urls' => $urls)));
}

// Serve the file
$fp = fopen ($file, 'r');
header ('Content-Type: application/xml');
header ('Content-Length: ' . filesize ($file));
header ('Last-Modified: ' . gmdate ('D, d M Y H:i:s', filemtime ($file)) . ' GMT');
header ('Expires: ' . gmdate ('D, d M Y H:i:s', filemtime ($file) + $appconf['Sitemap']['regenerate']) . ' GMT');
fpassthru ($fp);
$this->quit ();

?>