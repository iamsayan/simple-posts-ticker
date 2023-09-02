<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

 // register settings
add_action( 'admin_init', 'spt_register_plugin_settings' );

function spt_register_plugin_settings() {

    add_settings_section('spt_plugin_main_section', '', null, 'spt_plugin_main_option');
        add_settings_field('spt_num_posts', __( 'Number of Posts to Show:', 'simple-posts-ticker' ), 'spt_num_posts_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-post-num' ));
        add_settings_field('spt_post_type', __( 'Select Post Type:', 'simple-posts-ticker' ), 'spt_post_type_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-post-type' ));
        add_settings_field('spt_show_orderby', __( 'Orderby Query Method:', 'simple-posts-ticker' ), 'spt_show_orderby_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-orderby' ));
        add_settings_field('spt_show_order', __( 'Post Display Order:', 'simple-posts-ticker' ), 'spt_show_order_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-order' ));
        add_settings_field('spt_post_cat', __( 'Select Post Categories:', 'simple-posts-ticker' ), 'spt_post_cat_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-cat', 'class' => 'spt-cat' ));
        
    add_settings_section('spt_plugin_label_section', '', null, 'spt_plugin_label_option');
        add_settings_field('spt_show_label', __( 'Show Ticker Label:', 'simple-posts-ticker' ), 'spt_show_label_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-ticker-label' ));
        add_settings_field('spt_label_position', __( 'Ticker Label Position:', 'simple-posts-ticker' ), 'spt_label_position_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-position' ));
        add_settings_field('spt_label_text', __( 'Ticker Label Text:', 'simple-posts-ticker' ), 'spt_label_text_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-text' ));
        add_settings_field('spt_label_font_size', __( 'Ticker Label Font Size:', 'simple-posts-ticker' ), 'spt_label_font_size_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-text-font-size' ));
        add_settings_field('spt_margin', __( 'Ticker Label Margin:', 'simple-posts-ticker' ), 'spt_margin_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-margin' ));
        add_settings_field('spt_padding', __( 'Ticker Label Padding:', 'simple-posts-ticker' ), 'spt_padding_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-padding' ));
        add_settings_field('spt_label_text_colour', __( 'Label Text Colour:', 'simple-posts-ticker' ), 'spt_label_text_colour_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-text-colour' ));
        add_settings_field('spt_label_bg_colour', __( 'Label Background Colour:', 'simple-posts-ticker' ), 'spt_label_bg_colour_display', 'spt_plugin_label_option', 'spt_plugin_label_section', array( 'label_for' => 'spt-label-bg-colour' ));
        
    add_settings_section('spt_plugin_settings_section', '', null, 'spt_plugin_settings_option');
        add_settings_field('spt_border', __( 'Ticker Border Style:', 'simple-posts-ticker' ), 'spt_border_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-border' ));
        add_settings_field('spt_border_width', __( 'Ticker Border Width:', 'simple-posts-ticker' ), 'spt_border_width_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-border-width', 'class' => 'spt-border-width' ));
        add_settings_field('spt_border_radius', __( 'Ticker Border Radius:', 'simple-posts-ticker' ), 'spt_border_radius_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-border-radius', 'class' => 'spt-border-radius' ));
        add_settings_field('spt_border_colour', __( 'Ticker Border Colour:', 'simple-posts-ticker' ), 'spt_border_colour_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-border-colour', 'class' => 'spt-border-colour' ));
        add_settings_field('spt_size', __( 'Content Font Size:', 'simple-posts-ticker' ), 'spt_size_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-font-size' ));
        add_settings_field('spt_ticker_margin', __( 'Content Area Margin:', 'simple-posts-ticker' ), 'spt_ticker_margin_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-margin' ));
        add_settings_field('spt_ticker_padding', __( 'Content Area Padding:', 'simple-posts-ticker' ), 'spt_ticker_padding_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-padding' ));
        add_settings_field('spt_ticker_colour', __( 'Content Link Colour:', 'simple-posts-ticker' ), 'spt_ticker_colour_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-colour' ));
        add_settings_field('spt_ticker_bg_colour', __( 'Content BG Colour:', 'simple-posts-ticker' ), 'spt_ticker_bg_colour_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-bg-colour' ));
        add_settings_field('spt_ticker_link_padding', __( 'Single Content Padding:', 'simple-posts-ticker' ), 'spt_ticker_link_padding_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-ticker-link-padding' ));
        
    add_settings_section('spt_plugin_ticker_section', '', null, 'spt_plugin_ticker_option');
        add_settings_field('spt_ticker_direction', __( 'Ticker Animate Direction:', 'simple-posts-ticker' ), 'spt_ticker_direction_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-direction' ));
        add_settings_field('spt_ticker_continuous_flow', __( 'Ticker Continuous Flow:', 'simple-posts-ticker' ), 'spt_ticker_continuous_flow_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-continuous-flow' ));
        add_settings_field('spt_show_loop', __( 'Ticker Content Loop:', 'simple-posts-ticker' ), 'spt_show_loop_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-loop', 'class' => 'spt-loop' ));
        add_settings_field('spt_stop_on_hover', __( 'Pause Ticker on Hover:', 'simple-posts-ticker' ), 'spt_stop_on_hover_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-hover' ));
        add_settings_field('spt_duration', __( 'Ticker Animate Duration:', 'simple-posts-ticker' ), 'spt_duration_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-duration' ));
        add_settings_field('spt_speed', __( 'Ticker Animate Speed:', 'simple-posts-ticker' ), 'spt_speed_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-speed' ));
        add_settings_field('spt_visible', __( 'Ticker Start Visibility:', 'simple-posts-ticker' ), 'spt_visible_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-visible' ));
        add_settings_field('spt_delay_start', __( 'Ticker Delay Before Start:', 'simple-posts-ticker' ), 'spt_delay_start_display', 'spt_plugin_ticker_option', 'spt_plugin_ticker_section', array( 'label_for' => 'spt-delay' ));
        
    add_settings_section('spt_plugin_misc_section', '', null, 'spt_plugin_misc_option');
        add_settings_field('spt_enable_link', __( 'Enable Ticker Hyperlink:', 'simple-posts-ticker' ), 'spt_enable_link_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-link' ));
        add_settings_field('spt_target', __( 'Ticker Link Target:', 'simple-posts-ticker' ), 'spt_target_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-window', 'class' => 'spt-window' ));
        add_settings_field('spt_no_follow', __( 'Add "nofollow" to Link:', 'simple-posts-ticker' ), 'spt_no_follow_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-no-follow', 'class' => 'spt-no-follow' ));
        add_settings_field('spt_show_info', __( 'Show Post Info on Ticker:', 'simple-posts-ticker' ), 'spt_show_info_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-info' ));
        add_settings_field('spt_show_info_position', __( 'Post Info Position:', 'simple-posts-ticker' ), 'spt_show_info_position_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-info-position', 'class' => 'spt-info-position' ));
        add_settings_field('spt_post_info_sep', __( 'Post Info Separator:', 'simple-posts-ticker' ), 'spt_post_info_sep_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-info-sep', 'class' => 'spt-info-sep' ));
        add_settings_field('spt_post_info_colour', __( 'Ticker Post Info Colour:', 'simple-posts-ticker' ), 'spt_post_info_colour_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-info-colour', 'class' => 'spt-info-colour' ));
        add_settings_field('spt_no_content_type', __( 'Ticker No Content Action:', 'simple-posts-ticker' ), 'spt_no_content_type_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-nocontent-type' ));
        add_settings_field('spt_no_content_text', __( 'Ticker No Content Text:', 'simple-posts-ticker' ), 'spt_no_content_text_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-nocontent', 'class' => 'spt-nocontent' ));
        add_settings_field('spt_custom_css', __( 'Custom CSS Code:', 'simple-posts-ticker' ), 'spt_custom_css_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-css' ));
        add_settings_field('spt_delete_data', __( 'Delete Plugin Data?', 'simple-posts-ticker' ), 'spt_delete_data_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-delete-data' ));
        
    //register settings
    register_setting( 'spt_plugin_settings_fields', 'spt_plugin_settings' );
}

?>