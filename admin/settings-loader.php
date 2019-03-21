<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function spt_register_plugin_settings() {

    add_settings_section('spt_plugin_main_section', '', null, 'spt_plugin_main_option');
        add_settings_field('spt_num_posts', __( 'Number of Posts to Show:', 'simple-posts-ticker' ), 'spt_num_posts_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-post-num' ));
        add_settings_field('spt_post_type', __( 'Select Post Type:', 'simple-posts-ticker' ), 'spt_post_type_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-post-type' ));
        add_settings_field('spt_show_orderby', __( 'Orderby Query Method:', 'simple-posts-ticker' ), 'spt_show_orderby_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-orderby' ));
        add_settings_field('spt_show_order', __( 'Post Display Order:', 'simple-posts-ticker' ), 'spt_show_order_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-order' ));
        add_settings_field('spt_post_cat', __( 'Select Post Categories:', 'simple-posts-ticker' ), 'spt_post_cat_display', 'spt_plugin_main_option', 'spt_plugin_main_section', array( 'label_for' => 'spt-cat', 'class' => 'spt-cat' ));
        
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
        add_settings_field('spt_no_content_type', __( 'Ticker No Content Action:', 'simple-posts-ticker' ), 'spt_no_content_type_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-nocontent-type' ));
        add_settings_field('spt_no_content_text', __( 'Ticker No Content Text:', 'simple-posts-ticker' ), 'spt_no_content_text_display', 'spt_plugin_settings_option', 'spt_plugin_settings_section', array( 'label_for' => 'spt-nocontent', 'class' => 'spt-nocontent' ));
        
    add_settings_section('spt_plugin_misc_section', '', null, 'spt_plugin_misc_option');
        add_settings_field('spt_custom_css', __( 'Custom CSS Code:', 'simple-posts-ticker' ), 'spt_custom_css_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-css' ));
        add_settings_field('spt_delete_data', __( 'Delete Plugin Data?', 'simple-posts-ticker' ), 'spt_delete_data_display', 'spt_plugin_misc_option', 'spt_plugin_misc_section', array( 'label_for' => 'spt-delete-data' ));
        
    //register settings
    register_setting( 'spt_plugin_settings_fields', 'spt_plugin_settings' );
}

?>