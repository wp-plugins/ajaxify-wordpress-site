=== Ajaxify Wordpress Site ===
Contributors: manishkrag
Version 1.1
Tags: ajax, posts, pages, page, post, ajax search, ajaxify
Tested up to: 3.4

== Description ==

Ajaxify Wordpress Site will load posts, pages, search etc. without reloading entire page. This was my first plugin and is still a little quirky.

Features:
<br /> Post will load without browser refresh.
<br /> Page will load without browser refresh.
<br /> Make wordpress search to ajaxify search.
<br /> Your custom theme design will not break.

== Installation ==

* Upload `ajaxify-wordpress-site` folder to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress.
* Change the ID of the wordpress search form submit button to "ajax-search".
* Provide "no-ajaxy" class to "a" tag if you dont want to make this "a" tag to be ajaxify.

== Frequently Asked Questions ==

<br />Q: My site not ajaxify even after activating this plugin?
<br />A: Please check you core jQuery library, please use 1.7 version.
<br />Q: Search is not working as ajaxify?
<br />A: Please make sure that your search form submit input tag id should be 'search-submit' and input box id should be 'search-terms'.
<br />Q: I don't want to make a link ajaxify, what to do?
<br />A: Add 'no-ajaxify' class to the 'a' tag which you dont want to make ajaxify.

== Changelog ==

= 1.1 =
* Updated plug-in to update the body tag classes as it should be if your site not in ajaxify mode.
* Removed the scrollToTop functionality at the time of ajaxing to solve the issue coming at the time of jQuery tab.

= 1.0 =
* This is the first version