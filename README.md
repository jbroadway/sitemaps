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