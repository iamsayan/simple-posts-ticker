<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

 // custom styles
add_action( 'wp_head', 'spt_custom_style_to_wp_head', 10 );

function spt_custom_style_to_wp_head() { 
    $spt_settings = get_option('spt_plugin_settings');
    $css = wp_unslash( wp_kses_post( $spt_settings['spt_custom_css'] ) );

    $style = '';
    if( !empty( $spt_settings['spt_custom_css'] ) ) {
        $style .= "\n".'<!-- This website uses the Simple Posts Ticker plugin v' . SPT_PLUGIN_VERSION . ' - https://wordpress.org/plugins/simple-posts-ticker/ -->' . "\n";
        $style .= '<style type="text/css">'."\n";
        $style .= $css."\n";
        $style .= '</style>'."\n";
    }
    
    echo $style;
}