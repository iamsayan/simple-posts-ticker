<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'admin_notices', 'spt_donate_admin_notice' );
add_action( 'admin_init', 'spt_dismiss_donate_admin_notice' );

function spt_donate_admin_notice() {
    // Show notice after 240 hours (10 days) from installed time.
    if ( spt_plugin_installed_time_donate() > strtotime( '-360 hours' )
        || '1' === get_option( 'spt_plugin_dismiss_donate_notice' )
        || ! current_user_can( 'manage_options' )
        || apply_filters( 'spt_plugin_hide_sticky_donate_notice', false ) ) {
        return;
    }

    $dismiss = wp_nonce_url( add_query_arg( 'spt_donate_notice_action', 'dismiss_donate_true' ), 'dismiss_donate_true' ); 
    $no_thanks = wp_nonce_url( add_query_arg( 'spt_donate_notice_action', 'no_thanks_donate_true' ), 'no_thanks_donate_true' ); ?>
    
    <div class="notice notice-success">
        <p><?php _e( 'Hey, I noticed you\'ve been using Simple Posts Ticker for more than 2 week – that’s awesome! If you like Simple Posts Ticker and you are satisfied with the plugin, isn’t that worth a coffee or two? Please consider donating. Donations help me to continue support and development of this free plugin! Thank you very much!', 'simple-posts-ticker' ); ?></p>
        <p><a href="https://www.paypal.me/iamsayan" target="_blank" class="button button-secondary"><?php _e( 'Donate Now', 'simple-posts-ticker' ); ?></a>&nbsp;
        <a href="<?php echo $dismiss; ?>" class="already-did"><strong><?php _e( 'I already donated', 'simple-posts-ticker' ); ?></strong></a>&nbsp;<strong>|</strong>
        <a href="<?php echo $no_thanks; ?>" class="later"><strong><?php _e( 'Nope&#44; maybe later', 'simple-posts-ticker' ); ?></strong></a>&nbsp;<strong>|</strong>
        <a href="<?php echo $dismiss; ?>" class="never"><strong><?php _e( 'I don\'t want to donate', 'simple-posts-ticker' ); ?></strong></a></p>
        </div>
    <?php
}

function spt_dismiss_donate_admin_notice() {

    if( get_option( 'spt_plugin_no_thanks_donate_notice' ) === '1' ) {
        if ( get_option( 'spt_plugin_dismissed_time_donate' ) > strtotime( '-360 hours' ) ) {
            return;
        }
        delete_option( 'spt_plugin_dismiss_donate_notice' );
        delete_option( 'spt_plugin_no_thanks_donate_notice' );
    }

    if ( ! isset( $_GET['spt_donate_notice_action'] ) ) {
        return;
    }

    if ( 'dismiss_donate_true' === $_GET['spt_donate_notice_action'] ) {
        check_admin_referer( 'dismiss_donate_true' );
        update_option( 'spt_plugin_dismiss_donate_notice', '1' );
    }

    if ( 'no_thanks_donate_true' === $_GET['spt_donate_notice_action'] ) {
        check_admin_referer( 'no_thanks_donate_true' );
        update_option( 'spt_plugin_no_thanks_donate_notice', '1' );
        update_option( 'spt_plugin_dismiss_donate_notice', '1' );
        update_option( 'spt_plugin_dismissed_time_donate', time() );
    }

    wp_redirect( remove_query_arg( 'spt_donate_notice_action' ) );
    exit;
}

function spt_plugin_installed_time_donate() {
    $installed_time = get_option( 'spt_plugin_installed_time_donate' );
    if ( ! $installed_time ) {
        $installed_time = time();
        update_option( 'spt_plugin_installed_time_donate', $installed_time );
    }
    return $installed_time;
}