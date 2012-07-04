=== Ajaxify Wordpress Site ===
Contributors: manishkrag
Version 1.1
Tags: ajax, posts, pages, page, post, ajax search, ajaxify
Tested up to: 3.4

== Description ==

Ajaxify Wordpress Site will load posts, pages, search etc. without reloading entire page. This was my first plugin and is still a little quirky.

Features:
1. Post will load without browser refresh.
2. Page will load without browser refresh.
3. Make wordpress search to ajaxify search.
4. Your custom theme design will not break.

== Installation ==

1. Upload `ajaxify-wordpress-site` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Change the ID of the wordpress search form submit button to "ajax-search".
4. Provide "no-ajaxy" class to "a" tag if you dont want to make this "a" tag to be ajaxify.

== Frequently Asked Questions ==
Q: My site not ajaxify even after activating this plugin?
A: Please check you core jQuery library, please use 1.7 version.
Q: Search is not working as ajaxify?
A: Please make sure that your search form submit input tag id should be 'search-submit' and input box id should be 'search-terms'.
Q: I don't want to make a link ajaxify, what to do?
A: Add 'no-ajaxify' class to the 'a' tag which you dont want to make ajaxify.

= 1.1 =
* Updated plug-in to update the body tag classes as it should be if your site not in ajaxify mode.
* Removed the scrollToTop functionality at the time of ajaxing to solve the issue coming at the time of jQuery tab.

= 1.0 =
* This is the first version