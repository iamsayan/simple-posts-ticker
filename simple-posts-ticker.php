<?php
/**
 * Plugin Name: Simple Posts Ticker
 * Plugin URI: https://wordpress.org/plugins/simple-posts-ticker/
 * Description: The Simple Posts Ticker plugin is a small tool that shows your most recent posts in a marquee style.
 * Version: 1.0.5
 * Author: Sayan Datta
 * Author URI: https://sayandatta.com
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

define ( 'SPT_PLUGIN_VERSION', '1.0.5' );

// debug scripts
//define ( 'SPT_PLUGIN_ENABLE_DEBUG', 'true' );

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
    set_transient( 'spt-admin-notice-on-activation', true, 15 );
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
    $ver = SPT_PLUGIN_VERSION;
    if( defined( 'SPT_PLUGIN_ENABLE_DEBUG' ) ) {
        $ver = time();
    }

    // get current screen
    $current_screen = get_current_screen();
    if ( strpos( $current_screen->base, 'simple-posts-ticker') !== false ) {
        wp_enqueue_style( 'spt-styles', plugins_url( 'admin/css/admin.min.css', __FILE__ ), array(), $ver );
        wp_enqueue_style( 'spt-selectize-css', plugins_url( 'admin/css/selectize.min.css', __FILE__ ), array(), '0.12.6' );
        
        wp_enqueue_script( 'spt-admin-js', plugins_url( 'admin/js/admin.min.js', __FILE__ ), array(), $ver );
        wp_enqueue_script( 'spt-selectize-js', plugins_url( 'admin/js/selectize.min.js', __FILE__ ), array(), '0.12.6' );
        
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }
}

add_action( 'admin_enqueue_scripts', 'spt_load_admin_assets' );

function spt_enqueue_frontend_files() {
    $ver = SPT_PLUGIN_VERSION;
    if( defined( 'SPT_PLUGIN_ENABLE_DEBUG' ) ) {
        $ver = time();
    }
    wp_enqueue_script( 'spt-ticker-js', plugins_url( 'public/js/posts-ticker.min.js', __FILE__ ), array( 'jquery' ), $ver );
}

add_action( 'wp_enqueue_scripts', 'spt_enqueue_frontend_files' );

function spt_ajax_save_admin_scripts() {
    if ( is_admin() ) { 
        // Embed the Script on our Plugin's Option Page Only
        if ( isset($_GET['page']) && $_GET['page'] == 'simple-posts-ticker' ) {
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-form' );
        }
    }
}

add_action( 'admin_init', 'spt_ajax_save_admin_scripts' );

// register settings
add_action( 'admin_init', 'spt_register_plugin_settings' );

require_once plugin_dir_path( __FILE__ ) . 'admin/settings-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/settings-fields.php';

// register admin menu
add_action( 'admin_menu', 'spt_admin_menu' );

function spt_admin_menu() {
    //Add admin menu option
    add_submenu_page( 'options-general.php', __( 'Simple Posts Ticker', 'simple-posts-ticker' ), __( 'Simple Posts Ticker', 'simple-posts-ticker' ), 'manage_options', 'simple-posts-ticker', 'spt_plugin_settings_page' );
}

function spt_plugin_settings_page() {
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
}

require_once plugin_dir_path( __FILE__ ) . 'admin/notice.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/donate.php';

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