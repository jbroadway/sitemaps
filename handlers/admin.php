<?php

$this->require_admin ();

$page->layout = 'admin';

$page->title = 'Google Sitemaps';

if (isset ($_GET['reset'])) {
	if (file_exists ('cache/sitemap.xml')) {
		unlink ('cache/sitemap.xml');
	}
	$this->add_notification (__ ('sitemap.xml reset.'));
	$this->redirect ('/sitemap.xml/admin');
}

echo $tpl->render ('sitemap.xml/admin');

?>