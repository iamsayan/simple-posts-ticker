<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'wp_head', 'spt_custom_style_to_wp_head', 10 );
add_action( 'wp_footer', 'spt_init_script_to_wp_footer', 10 );

function spt_custom_style_to_wp_head() { 
    $spt_settings = get_option('spt_plugin_settings');

    $style = '';
    if( !empty( $spt_settings['spt_custom_css'] ) ) {
        $style .= "\n".'<!-- This website uses the Simple Posts Ticker plugin v' . SPT_PLUGIN_VERSION . ' - https://wordpress.org/plugins/simple-posts-ticker/ -->' . "\n";
        $style .= '<style type="text/css">'."\n";
        $style .= $spt_settings['spt_custom_css']."\n";
        $style .= '</style>'."\n";
    }
    
    echo $style;
}

function spt_init_script_to_wp_footer() { ?>
<!-- This website uses the Simple Posts Ticker plugin v<?php echo SPT_PLUGIN_VERSION; ?> - https://wordpress.org/plugins/simple-posts-ticker/ -->
<script>
    // variables
    var $mq = jQuery('.spt-marquee');
    var cflow = $mq.data('duplicated');
    var text = $mq.html();
    
    //init marquee
    $mq.bind('beforeStarting', function() {
        // check repeated marquee
        if(cflow === true) {
            $mq.marquee('destroy');
    		// we need to repeat at least once..
    		$mq = $mq.append(text).marquee();
        }
    }).marquee();
</script>
<?php 
}