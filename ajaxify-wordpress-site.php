<?php
/*
 *Plugin Name: Ajaxify WordPress Site
 *Description: This will ajaxify your website. All the front end links will turns to ajaxify.
 *Ajaxify WordPress Site will load posts, pages, search etc. without reloading entire page.
 *Author: Soumi Das
 *Author URI: http://www.youngtechleads.com
 *EmailId: soumi.das1990@gmail.com/skype:soumibgb
 *Version: 1.5.5
 *Plugin URI: http://www.youngtechleads.com/aws-plug-in-for-wordpress
 */

/* A HUMBLE REQUEST FOR DONATION: 
 *                                                                                                   
 *I have been provided quite alot of free help and several updates to make this plugin easier to integrate
 * and understand. If this plugin has saved you time then please consider it for donation.                      
 *                                                                                          
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
// Global VAriables
global $plugin_dir_path;
$plugin_dir_path = plugin_dir_url(__FILE__);

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
	$search_form 		= (get_option('search-form') != '') ? get_option('search-form') : 'searchform' ;
	$transition 		= (get_option('transition') != '') ? get_option('transition') : '' ;
	$scrollTop 			= (get_option('scrollTop') != '') ? get_option('scrollTop') : '' ;
	$loader 			= (get_option('loader') != '') ? get_option('loader') : '' ;
	
	update_option('container-id', $container_id);
	update_option('mcdc', $mcdc);
	update_option('search-form', $search_form);
	update_option('transition', $transition);
	update_option('scrollTop', $scrollTop);
	update_option('loader', $loader);
}


/*Call 'aws_option_link' function to Add a submenu link under Profile tab.*/
add_action( 'admin_menu', 'aws_option_link' );

/**
 * Function Name: aws_option_link
 * Description: Add a submenu link under Settings tab.
 *
 */
function aws_option_link() { 
	$aws_page_hook = add_options_page( 'AWS Options Page', 'AWS Options Page', 'manage_options', 'aws-options', 'aws_option_form' );
	
	add_action( "admin_print_scripts-$aws_page_hook", 'aws_admin_css' );
}

function aws_admin_css() {
	global $plugin_dir_path;
	wp_enqueue_style('aws-style-css', $plugin_dir_path . '/css/aws-style.css');
}
/**
 *	Function name: aws_option_form
 *	Description: Show aws option form to admin, save data to wp_option table.
 */
function aws_option_form() {
	echo '<div class="wrap"><h2>AWS Options</h2>';

	/**
	 * Check whether the form submitted or not.
	 */
	if( isset($_POST['option-save']) ) {
		//Get the form value
		$ids 			= trim($_POST['no-ajax-ids']);
		$container_id 	= trim($_POST['container-id']);
		$mcdc 			= trim($_POST['mcdc']);
		$search_form 	= trim($_POST['search_form']);
		$transition 	= $_POST['transition'];
		$scrollTop	 	= $_POST['scrollTop'];
		$loader 		= $_POST['loader'];
		
		if( $container_id == '' || $mcdc == '' )
			echo '<p style="color:red">Data for * marked fields are mendatory.</p>';
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
			update_option('search-form', $search_form);
			update_option('transition', $transition);
			update_option('scrollTop', $scrollTop);
			update_option('loader', $loader);
			echo '<div class="updated" id="message"><p>Settings updated.</p></div>';
		}
	}
	?>
	<!-- AWS option table start here -->
	<form id="option-form" method="post" name="option-form">
		<table id="aws-option-table">
			<tr>
				<td><strong>No ajax container IDs:<strong></td>
				<td>
					<textarea id="no_ajax_ids" name="no-ajax-ids"><?php echo get_option('no-ajax-ids'); ?></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					Provide the ids of the parent tag whose child anchor(a) 
					tags you dont want to handled by AWS plugin.
					<br />
					<b>NOTE:</b> ids should be separated by comma(,) without any spaces. eg: id1,id2,id3
				</td>
			</tr>
			<tr>
				<td><strong>Ajax container ID:*</strong></td>
				<td><input type="text" name="container-id" value="<?php echo get_option('container-id'); ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td>ID of the container div whose data needs to be ajaxify. eg: main/page any one.</td>
			</tr>
			<tr>
				<td><strong>Menu container class:*</strong></td>
				<td>
					<input type="text" name="mcdc" value="<?php echo get_option('mcdc'); ?>" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Class of the div in which menu's ul, li present. eg: menu</td>
			</tr>
			<tr>
				<td><strong>Search form TAG ID/CLASS:*</strong></td>
				<td><input type="text" name="search_form" value="<?php echo get_option('search-form'); ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td>To make your search ajaxify provide the search form ID/CLASS.<br><strong>Example:</strong> if form tag class is search-form then provide <strong><i>.#search-form</i></strong> if ID is search-form the provide <strong><i>#search-form</i></strong></td>
			</tr>
			<tr>
				<td><strong>Enable Transition Effect:</strong></td>
				<td><input type="checkbox" name="transition" value="1" <?php checked( get_option('transition'), 1, true ); ?>" /></td>
			</tr>
			<tr>
				<td><strong>Enable scroll to top Effect:</strong></td>
				<td><input type="checkbox" name="scrollTop" value="1" <?php checked( get_option('scrollTop'), 1, true ); ?>" /></td>
			</tr>
			
			<tr>
				<td><strong>Loader Image:</strong></td>
				<td>
					<?php $loader = get_option('loader'); ?>
					<select name="loader">
						<option value=''>Select Loader</option>
						<?php
						if ($file = opendir(plugin_dir_path(__FILE__) . '/images/')) {
							while (false !== ($entry = readdir($file))) {
								if ($entry != "." && $entry != "..") {
								$selected = '';
									if ($entry == $loader) {
										$selected = "selected";
									}
									echo "<option value='", $entry, "'", $selected, ">", $entry, "</option>\n";
								}
							}
							closedir($file);
						}
						?>
				</select>
			</tr>
			<tr>
				<td></td>
				<td>
					<input class="button" id="option-save" name="option-save" type="submit" value="Save options"/>
				</td>
			</tr>
		</table>
	</form>
	<!-- AWS option table end here -->
	
	<script>
	jQuery('#option-save').click(function(event) {
		var err = 0;
		jQuery('#aws-option-table input').each(function(){
			if(jQuery(this).val() == '') {
				err = 1;
				jQuery(this).css('border-color', '#ff0000');
			}
		});
		if( err === 1 ) {
			event.preventDefault();
			return false;
		}
	});
	</script>
	
	<div style="border:1px solid #720921;color:#720921; background-color:#ccc ;padding:10px;">
		<div style="float:right">
			<form method="post" action="https://www.paypal.com/cgi-bin/webscr" target="_blank" class="">
				<strong>Amount</strong> $ <input type="text" value="" title="Other donate" size="15" name="amount">
				<input type="hidden" value="_xclick" name="cmd">
				<input type="hidden" value="soumi.das1990@gmail.com" name="business">
				<input type="hidden" value="Young Tech Leads" name="item_name">
				<input type="hidden" value="USD" name="currency_code">
				<input type="hidden" value="0" name="no_shipping">
				<input type="hidden" value="1" name="no_note">
				<input type="hidden" value="IC_Sample" name="bn">
				<input type="hidden" value="http://www.youngtechleads.com/thanks" name="return">
				<input type="image" alt="Make payments with payPal - it's fast, free and secure!" name="submit" src="https://www.paypal.com/en_US/i/btn/x-click-but11.gif">
			</form>
		</div>
		If you are using this plugin on your website and it has saved you time/money or you are using this plugin in a commercial project, think about the time and
		effort put into this plugin for free so that life is easier for you, <b>give a donation!</b>
		<div style="clear:right"></div>
		<div style="clear:both"></div>
		<p> Ajaxify Wordpress Site Pro <a href="http://www.youngtechleads.com/ajaxify-wordpress-site-pro/">Details Here</a></p>
	</div>
	
	</div>
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
	global $plugin_dir_path;
	
	wp_enqueue_script('history-js', $plugin_dir_path . 'js/history.js', array('jquery'));
	wp_enqueue_script('ajaxify-js',  $plugin_dir_path . 'js/ajaxify.js', array('jquery'));
	
	$ids_arr = explode(',', get_option('no-ajax-ids'));
	foreach( $ids_arr as $key => $id ) {
		if ( trim($id) == '' )
			unset($ids_arr[$key]);
		else
			$ids_arr[$key] =  '#' . trim($id) . ' a';
	}
	$ids = implode(',', $ids_arr);
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$bp_status = is_plugin_active( 'buddypress/bp-loader.php' );
	
	$aws_data = array(
		'rootUrl' 		=> site_url() . '/',
		'ids' 			=> $ids,
		'container_id' 	=> get_option('container-id'),
		'mcdc' 			=> get_option('mcdc'),
		'searchID' 		=> get_option('search-form'),
		'transition' 	=> get_option('transition'),
		'scrollTop' 	=> get_option('scrollTop'),
		'loader' 		=> get_option('loader'),
		'bp_status'     => $bp_status
	);
	
	wp_localize_script('ajaxify-js', 'aws_data', $aws_data);
	
	
} // End of aws_load_scripts function