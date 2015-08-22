=== Ajaxify Wordpress Site(AWS) ===
Contributors: manishkrag, soumidas
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=soumi.das1990@gmail.com&item_name=Ajaxify%20WordPress%20Site(AWS)&return=http://wordpress.org/extend/plugins/ajaxify-wordpress-site/
Version 1.5.5
Tags: ajax, posts, pages, page, post, ajax search, ajaxify, ajax page loader, ajax posts, ajaxy pages, ajaxify posts, ajaxify wordpress site, ajaxify-wordpres-site, ajax wordpress, wordpress ajax page load, no refresh, dynamic, no page refresh
Tested up to: 4.3
Stable tag: 1.5.4

== Description ==

**Important Note:**
<p> Ajaxify Wordpress Site Latest Version <a href="http://www.youngtechleads.com/ajaxify-wordpress-site-pro/">Details Here</a></p>
<br />
If your jQuery core library version is less than 2.0 then please go to the plugin's js directory open ajaxify.js file in your favourite editor then search for `.on` and replace it by `.live`. This is because the plugin is written for as per latest version of jQuery

**Ajaxify your wordpress site in two steps:**
<br />1: Install AWS plug-in.
<br />2: Fill up the AWS Options form link present under settings tab. DONE

Ajaxify Wordpress Site will load posts, pages, search, header, sidebar, footer sections etc. without reloading entire page.

By providing the id of the container, in aws options form, whose data needs to update admin can select which portion s/he want to ajaxify. Like if your site has static header, sidebar and footer section then you can provide the middle content area container id, again if your site contain all dynamic data then you have to provide the id of the div in which your sites all content present.

As most of the wordpress plug-in which can make your website ajaxify with constant url which is not SEO friendly, but AWS serves you clean and dynamic urls which make your website SEO friendly too.


**Features:**
<br /> Support added for BuddyPress.
<br /> Post will load without browser refresh.
<br /> Page will load without browser refresh.
<br /> Make wordpress search to ajaxify search.
<br /> Your custom theme design will not break.
<br /> Your sidebar also load without browser refresh, means if a site having different widget in different page at sidebar then they can also use this AWS plug-in.
<br /> Tested in latest IE, FF, Chrome, Safari etc. browsers.

**Plug-in Page:**  <a href="http://www.youngtechleads.com/aws-plug-in-for-wordpress/" target="_blank">Ajaxify Wordpress Site(AWS)</a>

== Installation ==

1. Upload `ajaxify-wordpress-site` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to Settings tab there a `AWS Options Page` link will be present click on it and provide the details.
1. Provide the ID of the container you want to be ajaxify in 'Ajax container ID' field.
1. Provide the class of the menu container in 'Menu container class' field.
1. Provide search form tag id/class with #/. respectively.

== Frequently Asked Questions ==

<br />Q: My site not ajaxify even after activating this plugin?
<br />A: Please check you core jQuery library, please use the latest version.
<br />Q: Search form is not working as ajaxify?
<br />A: Please make sure that your search form tag id provided in AWS admin setting form.
<br />Q: I don't want to make a link ajaxify, what to do?
<br />A: Add 'no-ajaxy' class to the 'a' tag which you don't want to make ajaxify or put the parent tag IDs in first text box in AWS option form separated by comma(,).
<br />Q: How to make Comment Reply link no-ajaxy?
<br />A: Put the parent tag's ID in first text box in AWS options form. Eg: comments
<br />Q: What if my some links are working fine when browser refresh but after first ajax load links are not working?
<br />A: Actually most of the js files are present in HEAD tag and these are not reloading at the time of ajax page load. Try to put all your js events in js live functions.

== Changelog ==

= 1.5.5 =
* Issue fixed, working every alternate time.

= 1.5.4 =
* Added: Support for BuddyPress.
* Modification: Modified the code for search functionality and made it more flexible.
* Optimized: Optimized the js code.

= 1.5.3 =
* Added: Transition Effect Enable/Disable option.
* Added: Scroll to top Effect Enable/Disable option.
* Modification: Default Search box made ajaxify. Now instead of search form ID you have to provide class as default theme having class. If your search is not ajaxify then make the search form as same as ' Twenty Fourteen' theme.

= 1.5.2 =
* Updated: replaced live function by on function.

= 1.5.1 =
* New: Fixed the scroll top issue permanently. Now after each link change AJAX container coming at the top of the browser.
* Removed: jquery.scrollTo-min.js file.

= 1.5.0 =
* New: In AWS Options form added new text field for search form TAG ID to make search ajaxed.
* New: Added showing page loader image during loading the a page.
* Fixed: Solve the issue of loading ajaxed pages twice.
* Optimized: Made the codes more optimized which will increase performance.
* Removed the meta tags reloading as they don't have any role for frontend users.

= 1.4.0 =
* Removed: From the admin AWS options page removed the 'Current menu class' text box.
* Removed: Removed the code from ajaxify.js file related to current menu selector.
* Removed: Removed unnecessary images directory.
* Fixed: Current menu Highlighter issue, informed by several users.

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