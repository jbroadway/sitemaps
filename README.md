# Google Sitemaps

This is a Google Sitemaps generator for [Elefant CMS](http://www.elefantcms.com/)
powered websites.

To use, install it into your `apps` folder as `sitemap.xml`, then point Google Webmaster Tools
to the URL `/sitemap.xml` on your site. On the first request it will generate
a sitemap file for your site.

### Additional info:

* The generated site map will be cached for 24 hours by default. To change this, edit `apps/sitemap.xml/conf/config.php`.
* To reset the cache early, log into Elefant and go to Tools > Google Sitemaps and click the reset link.
* The site map will include all public pages, published blog posts, and events (if the events app is installed).

### Troubleshooting

If your sitemap link (e.g., `/sitemap.xml`) generates a blank response, make
sure you have PHP's `short_open_tag` setting disabled and restart your web
server. This causes `<?xml` tags to create PHP parse errors. Note that this
is different than the `<?=` shortened tags that are always enabled in PHP 5.4+.

### Adding URLs from your custom apps

Just create a static method call on your models that returns an array of URLs
you want to include in the site map, and add a line in your app's `conf/config.php`
in the `[Admin]` section like this:

```
sitemap = "myapp\MyModel::sitemap"
```

Here's a sample model for the above:

```php
<?php

namespace myapp;

class MyModel extends \Model {
	public $table = 'myapp_mymodel';

	public static function sitemap () {
		$res = self::query ()
			->where ('published', 'yes')
			->fetch_orig ();
	
		$urls = array ();
		foreach ($res as $item) {
			$urls[] = '/myapp/item/' . $item->id . '/' . \URLify::filter ($item->title);
		}
		return $urls;
	}
}

?>
```
