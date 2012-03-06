<?php

$this->require_admin ();

$page->layout = 'admin';

$page->title = 'Google Sitemaps';

if (isset ($_GET['reset'])) {
	unlink ('cache/sitemap.xml');
	$this->add_notification (i18n_get ('sitemap.xml reset.'));
	$this->redirect ('/sitemap.xml/admin');
}

echo $tpl->render ('sitemap.xml/admin');

?>