<?php
/**
 * Plugin Name: Simple Posts Ticker
 * Plugin URI: https://wordpress.org/plugins/simple-posts-ticker/
 * Description: The Simple Posts Ticker plugin is a small tool that shows your most recent posts in a marquee style.
 * Version: 1.0.1
 * Author: Sayan Datta
 * Author URI: https://profiles.wordpress.org/infosatech/
 * License: GPLv3
 * Text Domain: simple-posts-ticker
 * Domain Path: /languages
 * 
 * Simple Posts Ticker is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Simple Posts Ticker is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Simple Posts Ticker. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @category Public
 * @package  Simple Posts Ticker
 * @author   Sayan Datta
 * @license  http://www.gnu.org/licenses/ GNU General Public License
 * @link     https://wordpress.org/plugins/simple-posts-ticker/
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define ( 'SPT_PLUGIN_VERSION', '1.0.1' );

// Internationalization
add_action( 'plugins_loaded', 'spt_plugin_load_textdomain' );
/**
 * Load plugin textdomain.
 * 
 * @since 1.0.0
 */
function spt_plugin_load_textdomain() {
    load_plugin_textdomain( 'simple-posts-ticker', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

// register activation hook
register_activation_hook( __FILE__, 'spt_plugin_activation' );
// register deactivation hook
register_deactivation_hook( __FILE__, 'spt_plugin_deactivation' );

function spt_plugin_activation() {
    
    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }
    set_transient( 'spt-admin-notice-on-activation', true, 20 );
}

function spt_plugin_deactivation() {

    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }
    delete_option( 'spt_plugin_dismiss_rating_notice' );
    delete_option( 'spt_plugin_no_thanks_rating_notice' );
    delete_option( 'spt_plugin_installed_time' );
}

function spt_plugin_install_notice() { 

    if( get_transient( 'spt-admin-notice-on-activation' ) ) { ?>
        <div class="notice notice-success">
            <p><strong><?php printf( __( 'Thanks for installing %1$s v%2$s plugin. Click <a href="%3$s">here</a> to configure plugin settings.', 'simple-posts-ticker' ), 'Simple Posts Ticker', SPT_PLUGIN_VERSION, admin_url( 'options-general.php?page=simple-posts-ticker' ) ); ?></strong></p>
        </div> <?php
        delete_transient( 'spt-admin-notice-on-activation' );
    }
}

add_action( 'admin_notices', 'spt_plugin_install_notice' ); 

function spt_load_admin_assets() {
    // get current screen
    $current_screen = get_current_screen();
    if ( strpos( $current_screen->base, 'simple-posts-ticker') !== false ) {
        wp_enqueue_style( 'spt-styles', plugins_url( 'admin/css/admin.min.css', __FILE__ ), array(), SPT_PLUGIN_VERSION );
        wp_enqueue_style( 'spt-selectize-css', plugins_url( 'admin/css/selectize.min.css', __FILE__ ), array(), '0.12.6' );
        
        wp_enqueue_script( 'spt-admin-js', plugins_url( 'admin/js/admin.min.js', __FILE__ ), array(), SPT_PLUGIN_VERSION );
        wp_enqueue_script( 'spt-selectize-js', plugins_url( 'admin/js/selectize.min.js', __FILE__ ), array(), '0.12.6' );
        
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }
}

add_action( 'admin_enqueue_scripts', 'spt_load_admin_assets' );

function spt_enqueue_frontend_files() {
    wp_enqueue_script( 'spt-ticker-js', plugins_url( 'public/js/posts-ticker.min.js', __FILE__ ), array( 'jquery' ), SPT_PLUGIN_VERSION.time() );
}

add_action( 'wp_enqueue_scripts', 'spt_enqueue_frontend_files' );

function spt_ajax_save_admin_scripts() {
    if ( is_admin() ) { 
        // Embed the Script on our Plugin's Option Page Only
        if ( isset($_GET['page']) && $_GET['page'] == 'simple-posts-ticker' ) {
            wp_enqueue_script('jquery');
            wp_enqueue_script( 'jquery-form' );
        }
    }
}

add_action( 'admin_init', 'spt_ajax_save_admin_scripts' );

// register settings
add_action( 'admin_init', 'spt_register_plugin_settings' );

function spt_register_plugin_settings() {

    add_settings_section('spt_plugin_main_section', '', null, 'spt_plugin_main_option');
        add_settings_field('spt_num_posts', __( 'Number of Posts to Show:', 'simple-posts-ticker' ), 'spt_num_posts_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-post-num' ));
        add_settings_field('spt_post_type', __( 'Select Post Type:', 'simple-posts-ticker' ), 'spt_post_type_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-post-type' ));
        add_settings_field('spt_show_orderby', __( 'Orderby Query Method:', 'simple-posts-ticker' ), 'spt_show_orderby_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-orderby' ));
        add_settings_field('spt_show_order', __( 'Post Display Order:', 'simple-posts-ticker' ), 'spt_show_order_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-order' ));
        add_settings_field('spt_post_cat', __( 'Select Post Categories:', 'simple-posts-ticker' ), 'spt_post_cat_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-cat' ));
        
    add_settings_section('spt_plugin_label_section', '', null, 'spt_plugin_label_option');
        add_settings_field('spt_show_label', __( 'Show Ticker Label:', 'simple-posts-ticker' ), 'spt_show_label_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-ticker-label' ));
        add_settings_field('spt_label_text', __( 'Ticker Label Text:', 'simple-posts-ticker' ), 'spt_label_text_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-text' ));
        add_settings_field('spt_label_font_size', __( 'Ticker Label Font Size:', 'simple-posts-ticker' ), 'spt_label_font_size_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-text-font-size' ));
        add_settings_field('spt_margin', __( 'Ticker Label Margin:', 'simple-posts-ticker' ), 'spt_margin_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-margin' ));
        add_settings_field('spt_label_text_colour', __( 'Label Text Colour:', 'simple-posts-ticker' ), 'spt_label_text_colour_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-colour' ));
        add_settings_field('spt_label_bg_colour', __( 'Label Background Colour:', 'simple-posts-ticker' ), 'spt_label_bg_colour_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-bg-colour' ));
        add_settings_field('spt_border', __( 'Label Border Style:', 'simple-posts-ticker' ), 'spt_border_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-border' ));
        add_settings_field('spt_border_width', __( 'Label Border Width:', 'simple-posts-ticker' ), 'spt_border_width_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-border-width', 'class' => 'spt-border-width' ));
        add_settings_field('spt_border_radius', __( 'Label Border Radius:', 'simple-posts-ticker' ), 'spt_border_radius_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-border-radius' ));
        add_settings_field('spt_border_colour', __( 'Label Border Colour:', 'simple-posts-ticker' ), 'spt_border_colour_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-border-colour', 'class' => 'spt-border-colour' ));
        
    add_settings_section('spt_plugin_settings_section', '', null, 'spt_plugin_settings_option');
        add_settings_field('spt_size', __( 'Ticker Font Size:', 'simple-posts-ticker' ), 'spt_size_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-font-size' ));
        add_settings_field('spt_speed', __( 'Ticker Speed (1-100):', 'simple-posts-ticker' ), 'spt_speed_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-speed' ));
        add_settings_field('spt_target', __( 'Ticker Link Target:', 'simple-posts-ticker' ), 'spt_target_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-window' ));
        add_settings_field('spt_no_follow', __( 'Add "nofollow" to Link:', 'simple-posts-ticker' ), 'spt_no_follow_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-no-follow' ));
        add_settings_field('spt_ticker_colour', __( 'Ticker Link Colour:', 'simple-posts-ticker' ), 'spt_ticker_colour_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-colour' ));
        add_settings_field('spt_ticker_bg_colour', __( 'Ticker Background Colour:', 'simple-posts-ticker' ), 'spt_ticker_bg_colour_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-bg-colour' ));
        add_settings_field('spt_ticker_margin', __( 'Ticker Margin:', 'simple-posts-ticker' ), 'spt_ticker_margin_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-margin' ));
        add_settings_field('spt_ticker_padding', __( 'Ticker Padding:', 'simple-posts-ticker' ), 'spt_ticker_padding_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-padding' ));
        add_settings_field('spt_gap', __( 'Ticker Infinite Scrolling:', 'simple-posts-ticker' ), 'spt_gap_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-gap' ));
        add_settings_field('spt_show_info', __( 'Post Info After Ticker:', 'simple-posts-ticker' ), 'spt_show_info_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-info' ));
        add_settings_field('spt_post_info_sep', __( 'Post Info Separator:', 'simple-posts-ticker' ), 'spt_post_info_sep_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-info-sep', 'class' => 'spt-info-sep' ));
        add_settings_field('spt_post_info_colour', __( 'Ticker Post Info Colour:', 'simple-posts-ticker' ), 'spt_post_info_colour_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-info-colour', 'class' => 'spt-info-colour' ));
        add_settings_field('spt_no_content_text', __( 'Ticker No Content Text:', 'simple-posts-ticker' ), 'spt_no_content_text_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-nocontent' ));
        
    add_settings_section('spt_plugin_misc_section', '', null, 'spt_plugin_misc_option');
        add_settings_field('spt_custom_css', __( 'Custom CSS Code:', 'simple-posts-ticker' ), 'spt_custom_css_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-css' ));
        add_settings_field('spt_delete_data', __( 'Delete Plugin Data?', 'simple-posts-ticker' ), 'spt_delete_data_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-delete-data' ));
        
    //register settings
    register_setting( 'spt_plugin_settings_fields', 'spt_plugin_settings' );
}

require_once plugin_dir_path( __FILE__ ) . 'admin/settings-fields.php';

// register admin menu
add_action( 'admin_menu', 'spt_admin_menu' );

function spt_admin_menu() {
    //Add admin menu option
    add_submenu_page( 'options-general.php', __( 'Simple Posts Ticker', 'simple-posts-ticker' ), __( 'Simple Posts Ticker', 'simple-posts-ticker' ), 'manage_options', 'simple-posts-ticker', 'spt_plugin_settings_page' );
}

function spt_plugin_settings_page() { 
    $spt_settings = get_option( 'spt_plugin_settings' ); 
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
}

require_once plugin_dir_path( __FILE__ ) . 'admin/notice.php';
require_once plugin_dir_path( __FILE__ ) . 'public/render.php';

// add action links
function spt_add_action_links ( $links ) {
    $sptlinks = array(
        '<a href="' . admin_url( 'options-general.php?page=simple-posts-ticker' ) . '">' . __( 'Settings', 'simple-posts-ticker' ) . '</a>',
    );
    return array_merge( $sptlinks, $links );
}

function spt_plugin_meta_links( $links, $file ) {
    $plugin = plugin_basename(__FILE__);
    if ( $file == $plugin ) // only for this plugin
        return array_merge( $links, 
            array( '<a href="https://wordpress.org/support/plugin/simple-posts-ticker" target="_blank">' . __( 'Support', 'simple-posts-ticker' ) . '</a>' ),
            array( '<a href="http://bit.ly/2I0Gj60" target="_blank">' . __( 'Donate', 'simple-posts-ticker' ) . '</a>' )
        );
    return $links;
}

// plugin action links
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'spt_add_action_links', 10, 2 );

// plugin row elements
add_filter( 'plugin_row_meta', 'spt_plugin_meta_links', 10, 2 );