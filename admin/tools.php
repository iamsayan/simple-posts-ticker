<?php

/**
 * Plugin tools options
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/gpl.html
 */

/**
 * Process a settings export that generates a .json file of the shop settings
 */
function spt_process_settings_export() {
	if( empty( $_POST['spt_export_action'] ) || 'spt_export_settings' != $_POST['spt_export_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['spt_export_nonce'], 'spt_export_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
	$settings = get_option( 'spt_plugin_settings' );
	$url = get_site_url();
    $find = array( 'http://', 'https://' );
    $replace = '';
    $output = str_replace( $find, $replace, $url );
	ignore_user_abort( true );
	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=' . $output . '-spt-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );
	echo json_encode( $settings );
	exit;
}

add_action( 'admin_init', 'spt_process_settings_export' );

/**
 * Process a settings import from a json file
 */
function spt_process_settings_import() {
	if( empty( $_POST['spt_import_action'] ) || 'spt_import_settings' != $_POST['spt_import_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['spt_import_nonce'], 'spt_import_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
    $extension = explode( '.', sanitize_text_field( $_FILES['import_file']['name'] ) );
    $file_extension = end($extension);
	if( $file_extension != 'json' ) {
		wp_die( __( '<strong>Settings import failed:</strong> Please upload a valid .json file to import settings in this website.', 'wp-last-modified-info' ) );
	}
	$import_file = sanitize_text_field( $_FILES['import_file']['tmp_name'] );
	if( empty( $import_file ) ) {
		wp_die( __( '<strong>Settings import failed:</strong> Please upload a file to import.', 'wp-last-modified-info' ) );
	}
	// Retrieve the settings from the file and convert the json object to an array.
	$settings = (array) json_decode( file_get_contents( $import_file ) );
    update_option( 'spt_plugin_settings', $settings );
    function spt_import_success_notice() {
        echo '<div class="notice notice-success is-dismissible">
                 <p><strong>' . __( 'Success! Plugin Settings has been imported successfully.', 'wp-last-modified-info' ) . '</strong></p>
             </div>';
    }
    add_action('admin_notices', 'spt_import_success_notice'); 
}

add_action( 'admin_init', 'spt_process_settings_import' );

/**
 * Process reset plugin settings
 */
function spt_remove_plugin_settings() {
	if( empty( $_POST['spt_reset_action'] ) || 'spt_reset_settings' != $_POST['spt_reset_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['spt_reset_nonce'], 'spt_reset_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
    $plugin_settings = 'spt_plugin_settings';
	delete_option( $plugin_settings );
	// delete custom post types
	$spt_cpt_args = array( 'post_type' => 'spt_ticker', 'posts_per_page' => -1 );
	$spt_cpt_posts = get_posts( $spt_cpt_args );
	foreach( $spt_cpt_posts as $post ) {
		wp_delete_post( $post->ID, false );
		delete_post_meta( $post->ID, '_spt_ticker_custom_link' );
	}

    function spt_settings_reset_success_notice() {
        echo '<div class="notice notice-success is-dismissible">
                 <p><strong>' . __( 'Success! Plugin Settings reset successfully.', 'wp-last-modified-info' ) . '</strong></p>
             </div>';
    }
    add_action('admin_notices', 'spt_settings_reset_success_notice'); 
}

add_action( 'admin_init', 'spt_remove_plugin_settings' );

?>