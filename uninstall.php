<?php
/**
 * Runs on Uninstall of Simple Posts Ticker
 *
 * @package   Simple Posts Ticker
 * @author    Sayan Datta
 * @license   http://www.gnu.org/licenses/gpl.html
 */

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

// Make sure that we are uninstalling
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

// Leave no trail
$plugin_option = 'spt_plugin_settings';

if( !is_multisite() ) {
    $options = get_option( $plugin_option );
	if ( isset($options['spt_delete_data']) && $options['spt_delete_data'] == 1 ) {
        delete_option( $plugin_option );
        
        // delete custom post types
        $spt_cpt_args = array( 'post_type' => 'spt_ticker', 'posts_per_page' => -1 );
        $spt_cpt_posts = get_posts( $spt_cpt_args );
        foreach( $spt_cpt_posts as $post ) {
            wp_delete_post( $post->ID, false );
            delete_post_meta( $post->ID, '_spt_ticker_custom_link' );
        }
    }
} else {
    global $wpdb;
	
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    $original_blog_id = get_current_blog_id();
    foreach( $blog_ids as $blog_id ) {
		
        switch_to_blog( $blog_id );
		
		$options = get_option( $plugin_option );
		
		if ( isset($options['spt_delete_data']) && $options['spt_delete_data'] == 1 ) {
			
			// Remove all plugin settings
            delete_option( $plugin_option );
            
            // delete custom post types
            $spt_cpt_args = array( 'post_type' => 'spt_ticker', 'posts_per_page' => -1 );
            $spt_cpt_posts = get_posts( $spt_cpt_args );
            foreach( $spt_cpt_posts as $post ) {
                wp_delete_post( $post->ID, false );
                delete_post_meta( $post->ID, '_spt_ticker_custom_link' );
            }
		}
    }
    switch_to_blog( $original_blog_id );
}