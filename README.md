# Google Sitemaps

This is a Google Sitemaps generator for [Elefant CMS](http://www.elefantcms.com/)
powered websites.

To use, install it into your `apps` folder, then point Google Webmaster Tools
to the URL `/sitemap.xml` on your site. On the first request it will generate
a sitemap file for your site.

### Additional info:

* The generated site map will be cached for 24 hours by default. To change this, edit `apps/sitemap.xml/conf/config.php`.
* To reset the cache early, log into Elefant and go to Tools > Google Sitemaps and click the reset link.
* The site map will include all public pages, published blog posts, and events (if the events app is installed).
