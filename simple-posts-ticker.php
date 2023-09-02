<?php
/**
 * Plugin Name: Simple Posts Ticker
 * Plugin URI: https://wordpress.org/plugins/simple-posts-ticker/
 * Description: The Simple Posts Ticker plugin is a small tool that shows your most recent posts in a marquee style.
 * Version: 1.1.6
 * Author: Sayan Datta
 * Author URI: https://sayandatta.co.in
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
 * @author   Sayan Datta <iamsayan@pm.me>
 * @license  http://www.gnu.org/licenses/ GNU General Public License
 * @link     https://wordpress.org/plugins/simple-posts-ticker/
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SPT_PLUGIN_VERSION', '1.1.6' );

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
    set_transient( 'spt-admin-notice-on-activation', true, 5 );
    flush_rewrite_rules();
}

function spt_plugin_deactivation() {
    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }
    delete_option( 'spt_plugin_dismiss_rating_notice' );
    delete_option( 'spt_plugin_no_thanks_rating_notice' );
    delete_option( 'spt_plugin_installed_time' );
    flush_rewrite_rules();
}

add_action( 'admin_notices', function () { 
    if( get_transient( 'spt-admin-notice-on-activation' ) ) { ?>
        <div class="notice notice-success">
            <p><strong><?php printf( __( 'Thanks for installing %1$s v%2$s plugin. Click <a href="%3$s">here</a> to configure plugin settings.', 'simple-posts-ticker' ), 'Simple Posts Ticker', SPT_PLUGIN_VERSION, admin_url( 'options-general.php?page=simple-posts-ticker' ) ); ?></strong></p>
        </div> <?php
        delete_transient( 'spt-admin-notice-on-activation' );
    }
} );

add_action( 'admin_enqueue_scripts', function () {
    // get current screen
    $current_screen = get_current_screen();
    if ( strpos( $current_screen->base, 'simple-posts-ticker' ) === false ) {
        return;
    }

    wp_enqueue_style( 'spt-styles', plugins_url( 'admin/css/admin.min.css', __FILE__ ), array(), SPT_PLUGIN_VERSION );
    wp_enqueue_style( 'spt-selectize-css', plugins_url( 'admin/css/selectize.min.css', __FILE__ ), array(), '0.15.2' );
    
    wp_enqueue_script( 'spt-admin-js', plugins_url( 'admin/js/admin.min.js', __FILE__ ), array(), SPT_PLUGIN_VERSION );
    wp_enqueue_script( 'spt-selectize-js', plugins_url( 'admin/js/selectize.min.js', __FILE__ ), array(), '0.15.2' );
    
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
} );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_script( 'spt-ticker-js', plugins_url( 'public/js/jquery.marquee.min.js', __FILE__ ), array( 'jquery' ), '1.5.2', true );
    wp_enqueue_script( 'spt-init-js', plugins_url( 'public/js/ticker.min.js', __FILE__ ), array( 'jquery' ), SPT_PLUGIN_VERSION, true );
} );

add_action( 'admin_init', function () {
    if ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'simple-posts-ticker' ) {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-form' );
    }
} );

require_once plugin_dir_path( __FILE__ ) . 'admin/settings-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/settings-fields.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/meta-box.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/post-type.php';

// register admin menu
add_action( 'admin_menu', function () {
    add_submenu_page( 'options-general.php', __( 'Simple Posts Ticker', 'simple-posts-ticker' ), __( 'Simple Posts Ticker', 'simple-posts-ticker' ), 'manage_options', 'simple-posts-ticker', function () {
        require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
    } );
} );

require_once plugin_dir_path( __FILE__ ) . 'admin/notice.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/donate.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/tools.php';
require_once plugin_dir_path( __FILE__ ) . 'public/render.php';
require_once plugin_dir_path( __FILE__ ) . 'public/load.php';

// plugin action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function ( $links ) {
    $sptlinks = array(
        '<a href="' . admin_url( 'options-general.php?page=simple-posts-ticker' ) . '">' . __( 'Settings', 'simple-posts-ticker' ) . '</a>',
    );
    return array_merge( $sptlinks, $links );
} );

// Add plugin riw item.
add_filter( 'plugin_row_meta', function ( $links, $file ) {
    $plugin = plugin_basename( __FILE__ );
    if ( $file == $plugin ) { // only for this plugin
        return array_merge( $links, 
            array( '<a href="https://wordpress.org/support/plugin/simple-posts-ticker" target="_blank">' . __( 'Support', 'simple-posts-ticker' ) . '</a>' ),
            array( '<a href="https://www.paypal.me/iamsayan/" target="_blank">' . __( 'Donate', 'simple-posts-ticker' ) . '</a>' )
        );
    }
    return $links;
}, 10, 2 );