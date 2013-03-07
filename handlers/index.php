<?php

$file = 'cache/sitemap.xml';

if (! file_exists ($file) || filemtime ($file) < time () - $appconf['Sitemap']['regenerate']) {
	// Generate sitemap file
	$urls = array ();

	$conf_list = glob ('apps/*/conf/config.php');
	foreach ($conf_list as $conf) {
		$ini = parse_ini_file ($conf, true);
		if (isset ($ini['Admin']['sitemap'])) {
			$urls = array_merge ($urls, call_user_func ($ini['Admin']['sitemap']));
		}
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