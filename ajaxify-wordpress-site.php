<?php
/*
 *Plugin Name: Ajaxify Wordpress Site
 *Description: This will ajaxify your website. All the front end links will turns to ajaxify.
 *			   Ajaxify Wordpress Site will load posts, pages, search etc. without reloading entire page.
 *			   This was my first plugin and is still a little quirky.
 *Author: Manish Kumar Agarwal
 *EmailId: manishkrag@yahoo.co.in/manisha@mindfiresolutions.com
 *Version: 1.1
 */
 
/*
 ---------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
---------------------------------------------------------------------
*/
 
//Loading js files
function load_scripts() {
	
	//Check whether the core jqury library enqued or not. If not enqued the enque this
	if(!wp_script_is( 'jquery' )) {
		wp_enqueue_script('jquery');
	}
	$plugin_dir_path = plugin_dir_url(__FILE__);
	
	wp_enqueue_script('history-js', $plugin_dir_path . 'js/history.js', array('jquery'));
	wp_enqueue_script('jquery-scrollTo-js', $plugin_dir_path . 'js/jquery.scrollTo-min.js', array('jquery'));
	wp_enqueue_script('ajaxify-js',  $plugin_dir_path . 'js/ajaxify.js', array('jquery'));
	
	$root_url = site_url() . '/';
	wp_localize_script('ajaxify-js', 'rootUrl', $root_url);
}

//calling load_scripts function to load js files
add_action('wp_enqueue_scripts', 'load_scripts');