<?php
/*
 *Plugin Name: Ajaxify Wordpress Site
 *Description: This will ajaxify your website. All the front end links will turns to ajaxify.
 *Ajaxify Wordpress Site will load posts, pages, search etc. without reloading entire page.
 *This was my first plugin and is still a little quirky.
 *Author: Manish Kumar Agarwal
 *Author URI: http://www.youngtechleads.com/
 *EmailId: manishkrag@yahoo.co.in/manisha@mindfiresolutions.com/skype:mfsi_manish
 *Version: 1.3.5
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


/*Call 'aws_install' function at the time of plug-in install.*/
register_activation_hook( __FILE__, 'aws_install' );

/**
 * Function Name: aws_install
 * Description: Save data to database at the time of plugin install.
 *
 */
function aws_install() {
	$container_id 		= (get_option('container-id') != '') ? get_option('container-id') : 'main' ;
	$mcdc 				= (get_option('mcdc') != '') ? get_option('mcdc') : 'menu' ;
	$current_menu_class = (get_option('current-menu-class') != '') ? get_option('current-menu-class') : 'current_page_item' ;
	
	update_option('container-id', $container_id);
	update_option('mcdc', $mcdc);
	update_option('current-menu-class', $current_menu_class);
}


/*Call 'aws_option_link' function to Add a submenu link under Profile tab.*/
add_action( 'admin_menu', 'aws_option_link' );

/**
 * Function Name: aws_option_link
 * Description: Add a submenu link under Settings tab.
 *
 */
function aws_option_link() { 
	add_options_page( 'AWS Options Page', 'AWS Options Page', 'manage_options', 'aws-options', 'aws_option_form' );
}

/**
 *	Function name: aws_option_form
 *	Description: Show aws option form to admin, save data to wp_option table.
 */
function aws_option_form() {
	echo '<h2>AWS Options</h2>';

	/**
	 * Check whether the form submitted or not.
	 */
	if( isset($_POST['option-save']) ) {
		//Get the form value
		$ids = trim($_POST['no-ajax-ids']);
		$container_id = trim($_POST['container-id']);
		$mcdc = trim($_POST['mcdc']);
		$current_menu_class = trim($_POST['current-menu-class']);
		
		if( $container_id == '' || $mcdc == '' || $current_menu_class == '' )
			echo '<p style="color:red">Last three(3) fields are mendatory.</p>';
		else {
			//Explode the value by comma(,).
			$ids_arr = explode(',', $ids);
			
			//Remove spaces if any.
			foreach( $ids_arr as $key => $id ) {
				$ids_arr[$key] = trim($id);
			}
			$ids = implode(',', $ids_arr);
			
			////Update the database
			update_option('no-ajax-ids', $ids);
			update_option('container-id', $container_id);
			update_option('mcdc', $mcdc);
			update_option('current-menu-class', $current_menu_class);
		}
	}
	?>
	<!-- AWS option table start here -->
	<form id="option-form" method="post" name="option-form">
		<table id="aws-option-table">
			<tr>
				<td>No ajax container IDs:</td>
				<td><input type="text" name="no-ajax-ids" value="<?php echo get_option('no-ajax-ids'); ?>" /></td>
				<td>
					Provide the ids of the parent tag whose child anchor(a) 
					tags you dont want to handled by AWS plugin.
					<br />
					<b>NOTE:</b> ids should be separated by comma(,) without any spaces. eg: id1,id2,id3
				</td>
			</tr>
			<tr><td colspan=3></td></tr>
			<tr>
				<td>Ajax container ID:</td>
				<td><input type="text" name="container-id" value="<?php echo get_option('container-id'); ?>" /></td>
				<td>ID of the container div whose data needs to be ajaxify. eg: main/page any one.</td>
			</tr>
			<tr><td colspan=3></td></tr>
			<tr>
				<td>Menu container class:</td>
				<td><input type="text" name="mcdc" value="<?php echo get_option('mcdc'); ?>" /></td>
				<td>Class of the div in which menu's ul, li present. eg: menu</td>
			</tr>
			<tr><td colspan=3></td></tr>
			<tr>
				<td>Current menu class:</td>
				<td><input type="text" name="current-menu-class" value="<?php echo get_option('current-menu-class'); ?>" /></td>
				<td>Class of the current/selected menu on which css written. eg: current_page_item</td>
			</tr>
			<tr><td colspan=3></td></tr>
			<tr>
				<td></td>
				<td><input id="option-save" type="submit" name="option-save" value="Save options"/></td>
				<td></td>
			</tr>
		</table>
	</form>
	<!-- AWS option table end here -->
	
	<script>
	jQuery('#option-save').click(function(event) {
		jQuery('#aws-option-table input:not(:first)').each(function(){
			if(jQuery(this).val() == '') {
				alert('Please provide the data for field: ' + jQuery(this).closest('tr').children('td:nth-child(1)').text().replace(':', ''));
				event.preventDefault();
				return false;
			}
		});
	});
	</script>
	<?php
		
} //End of aws_option_form function

//calling aws_load_scripts function to load js files
add_action('wp_enqueue_scripts', 'aws_load_scripts');

/**
 *	Function name: aws_load_scripts
 *	Description: Loading the required js files and assing required php variable to js variable.
 */
function aws_load_scripts() {
	
	//Check whether the core jqury library enqued or not. If not enqued the enque this
	if(!wp_script_is( 'jquery' )) {
		wp_enqueue_script('jquery');
	}
	$plugin_dir_path = plugin_dir_url(__FILE__);
	
	wp_enqueue_script('history-js', $plugin_dir_path . 'js/history.js', array('jquery'));
	wp_enqueue_script('jquery-scrollTo-js', $plugin_dir_path . 'js/jquery.scrollTo-min.js', array('jquery'));
	wp_enqueue_script('ajaxify-js',  $plugin_dir_path . 'js/ajaxify.js', array('jquery'));
	wp_enqueue_script('jquery-form');
	
	$ids_arr = explode(',', get_option('no-ajax-ids'));
	foreach( $ids_arr as $key => $id ) {
		if ( trim($id) == '' )
			unset($ids_arr[$key]);
		else
			$ids_arr[$key] =  '#' . trim($id) . ' a';
	}
	$ids = implode(',', $ids_arr);
	
	$root_url = site_url() . '/';
	wp_localize_script('ajaxify-js', 'rootUrl', $root_url);
	
	//Get the ids from the database and assing to js variable
	wp_localize_script('ajaxify-js', 'ids', $ids);
	wp_localize_script('ajaxify-js', 'container_id', get_option('container-id'));
	wp_localize_script('ajaxify-js', 'mcdc', get_option('mcdc'));
	wp_localize_script('ajaxify-js', 'current_menu_class', get_option('current-menu-class'));
	
} // End of aws_load_scripts function