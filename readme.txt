=== Ajaxify Wordpress Site(AWS) ===
Contributors: manishkrag
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=manishkrag@yahoo.co.in&item_name=Ajaxify%20WordPress%20Site(AWS)&return=http://wordpress.org/extend/plugins/ajaxify-wordpress-site/
Version 1.3.2
Tags: ajax, posts, pages, page, post, ajax search, ajaxify, ajax pages, ajax posts, ajaxy pages, ajaxify posts, ajaxify wordpress site, ajaxify-wordpres-site, ajax wordpress, wordpress ajax
Tested up to: 3.4

== Description ==

**Ajaxify your wordpress site in two steps:**
<br /> 1: Install AWS plug-in.
<br /> 2: Fill up the AWS Options form link present under settings tab. DONE

Ajaxify Wordpress Site will load posts, pages, search, header, sidebar, footer sections etc. without reloading entire page. This was my first plugin and is still a little quirky.

By providing the id of the container, in aws options form, whose data needs to update admin can select which portion s/he want to ajaxify. Like if your site has static header, sidebar and footer section then you can provide the middile content area container id, again if your site contain all dynamic data then you have to provide the id of the div in which your sites all content present.

As most of the wordpress plug-in which can make your website ajaxify with constant url which is not SEO friendly, but AWS serves you clean and dynamic urls which make your website SEO friendly too.


**Features:**
<br /> Post will load without browser refresh.
<br /> Page will load without browser refresh.
<br /> Make wordpress search to ajaxify search.
<br /> Your custom theme design will not break.
<br /> Your sidebar also load without browser refresh, means if a site having different widget in differe page at sidebar then they can also use this AWS plug-in.
<br /> Tested in IE, FF, Chrome, Safari etc brwsers.

**Author's Other Plugins:** 
<br /> <a href="http://wordpress.org/extend/plugins/members-import/" target="_blank">Members Import</a>

**Plug-in Page:**  <a href="http://www.youngtechleads.com/aws-plug-in-for-wordpress/" target="_blank">Ajaxify Wordpress Site(AWS)</a>

== Installation ==

1. Upload `ajaxify-wordpress-site` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to Settings tab there a `AWS Options Page` link will be present click on it and provide the datails.
1. Change the ID of the wordpress search form submit button to "search-submit".
1. Provide the ID of the container you want to be ajaxify in 'Ajax container ID' field.
1. Provide the class of the menu container in 'Menu container class' field.

== Frequently Asked Questions ==

<br />Q: My site not ajaxify even after activating this plugin?
<br />A: Please check you core jQuery library, please use 1.7 version.
<br />Q: Search form is not working as ajaxify?
<br />A: Please make sure that your search form tag id should be 'searchform' and input box id should be 's'.
<br />Q: I don't want to make a link ajaxify, what to do?
<br />A: Add 'no-ajaxy' class to the 'a' tag which you dont want to make ajaxify or put the parent tag IDs in first text box of the AWS option form separated by comma(,).
<br />Q: How to make Comment Reply link no-ajaxy?
<br />A: Put the parent tag's ID in first text box in AWS options form. Eg: comments
<br />Q: What if my some links are working fine when browser refresh but after first ajax load links are not working?
<br />A: Actually most of the js files are present in HEAD tag and these are not reloading at the time of ajax page load. Try to put all your js events in js live functions.

== Changelog ==

= 1.3.5 =
* Added: Now all the meta tags are updating with every ajax load. This will increase the SEO functionality.

= 1.3.4 =
* Updated: Previously search form was ajaxify on click event, it is modified to form submit event. Form ID should be 'searchform' and text box ID should be 's'.
* Updated: Changed the fading effect while site's statechange occur.
* Bug fix: Fixed the bug related to external js load.
= 1.3.3 =
* Bug fix: Now if the link containing wp-admin or wp-login text then page will reload. As we only need frontend as ajaxify.
= 1.3.2 =
* Fixed the issue present with AWS options form validation jQuery error message alert functionality.
* Update the code thus default WP search form will work as ajaxify form without any modification.
= 1.3.1 =
* Added AWS Options form validation codes.
= 1.3 =
* Added option page link under Settings tab name AWS options.
* Added text box to provide the id of the container needs to ajaxify.
* Added text box to provide the id of the container containing anchor(a) tags you dont want to handle by AWS.
* Solve the issue with updating the menu items.
* Integrated the dynamic sidebar content load.
* Integrated the page loading bar.
* optimized the js code.

= 1.2 =
* Solve the issue if no-ajaxify class dynamically adding to anchor tags.

= 1.1 =
* Updated plug-in to update the body tag classes as it should be if your site not in ajaxify mode.
* Removed the scrollToTop functionality at the time of ajaxing to solve the issue coming at the time of jQuery tab.

= 1.0 =
* This is the first version