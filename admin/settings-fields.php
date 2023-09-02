<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function spt_num_posts_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_num_posts']) ) {
        $spt_settings['spt_num_posts'] = '5';
    } ?>  <input id="spt-post-num" name="spt_plugin_settings[spt_num_posts]" type="number" min="-1" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_num_posts'])) { echo esc_attr( $spt_settings['spt_num_posts'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the number of posts you want to show in ticker.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_type_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( !isset($spt_settings['spt_post_type']) ) {
        $spt_settings['spt_post_type'] = 'post';
    }
    $post_types = get_post_types( array(
        'public'   => true
    ), 'objects' );

    echo '<select id="spt-post-type" name="spt_plugin_settings[spt_post_type]" style="width:30%;">';
    foreach( $post_types as $post_type ) {
        $exclude = apply_filters( 'spt_post_type_exclude_list', array( 'attachment' ) );
        if( !in_array( $post_type->name, $exclude ) ) {
            $selected = ( $spt_settings['spt_post_type'] == $post_type->name ) ? ' selected="selected"' : '';
            echo '<option value="' . $post_type->name . '"' . $selected . '>' . $post_type->labels->name . '</option>';
        }
    }
    $selected_cpt = ( $spt_settings['spt_post_type'] == 'spt_ticker' ) ? ' selected="selected"' : '';
    echo '<option value="spt_ticker"' . $selected_cpt . '>' . __( 'Tickers', 'simple-posts-ticker' ) . '</option>';
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the type of post you want to show in ticker.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_orderby_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_orderby']) ) {
        $spt_settings['spt_show_orderby'] = 'date';
    }
    $items = array(
        'date'      => __( 'Published Date', 'simple-posts-ticker' ),
        'modified'  => __( 'Modified Date', 'simple-posts-ticker' ),
        'rand'      => __( 'Random', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-orderby" name="spt_plugin_settings[spt_show_orderby]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_orderby'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the query method of getting posts from database.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_order_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_order']) ) {
        $spt_settings['spt_show_order'] = 'DESC';
    }
    $items = array(
        'DESC'   => __( 'Decending', 'simple-posts-ticker' ),
        'ASC'    => __( 'Ascending', 'simple-posts-ticker' )
    );
    echo '<select id="spt-order" name="spt_plugin_settings[spt_show_order]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_order'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the post display order from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_cat_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( !isset($spt_settings['spt_post_cat']) ) {
        $spt_settings['spt_post_cat'][] = '0';
    }

    $categories = get_terms( array(
        'taxonomy'     => 'category',
        'orderby'      => 'name'
    ) );

    echo '<select id="spt-cat" name="spt_plugin_settings[spt_post_cat][]" multiple="multiple" style="width:90%;">';
    foreach( $categories as $item ) {
        $selected = in_array( $item->term_id, $spt_settings['spt_post_cat'] ) ? ' selected="selected"' : '';
        echo '<option value="' . $item->term_id . '"' . $selected . '>' . $item->name . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the category you want to get posts from that to show on Posts Ticker. Leave blank if you want to include all category.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_label_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_label']) ) {
        $spt_settings['spt_show_label'] = 'yes';
    }
    $items = array(
        'yes'  => __( 'Yes', 'simple-posts-ticker' ),
        'no'   => __( 'No', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-ticker-label" name="spt_plugin_settings[spt_show_label]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_label'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the Posts Ticker label visibility from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_label_position_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_label_position']) ) {
        $spt_settings['spt_label_position'] = 'left';
    }
    $items = array(
        'left'    => __( 'Left Side', 'simple-posts-ticker' ),
        'right'   => __( 'Right Side', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-label-position" name="spt_plugin_settings[spt_label_position]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_label_position'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the Posts Ticker Label visibility from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_label_text_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_label_text']) ) {
        $spt_settings['spt_label_text'] = 'Latest Posts';
    } ?>  <input id="spt-label-text" name="spt_plugin_settings[spt_label_text]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_label_text'])) { echo esc_attr( $spt_settings['spt_label_text'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the Message/Label to show before the Posts Ticker', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_label_font_size_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_label_font_size']) ) {
        $spt_settings['spt_label_font_size'] = '100%';
    } ?>  <input id="spt-label-text-font-size" name="spt_plugin_settings[spt_label_font_size]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_label_font_size'])) { echo esc_attr( $spt_settings['spt_label_font_size'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the font size of Posts Ticker Label from here. You can use px/em/%.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_margin_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_margin']) ) {
        $spt_settings['spt_margin'] = '0';
    } ?>  <input id="spt-margin" name="spt_plugin_settings[spt_margin]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_margin'])) { echo esc_attr( $spt_settings['spt_margin'] ); } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_margin.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php esc_attr_e( 'Set the margin of the Ticker Label from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_padding_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_padding']) ) {
        $spt_settings['spt_padding'] = '0 10px';
    } ?>  <input id="spt-padding" name="spt_plugin_settings[spt_padding]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_padding'])) { echo esc_attr( $spt_settings['spt_padding'] ); } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_padding.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php esc_attr_e( 'Set the padding of the Ticker label from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_label_text_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-label-text-colour" name="spt_plugin_settings[spt_label_text_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_label_text_colour'])) { echo esc_attr( $spt_settings['spt_label_text_colour'] ); } ?>" />
    <?php
}

function spt_label_bg_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-label-bg-colour" name="spt_plugin_settings[spt_label_bg_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_label_bg_colour'])) { echo esc_attr( $spt_settings['spt_label_bg_colour'] ); } ?>" />
    <?php
}

function spt_border_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_border']) ) {
        $spt_settings['spt_border'] = 'solid';
    }
    $items = array(
        'none'     => __( 'None', 'simple-posts-ticker' ),
        'solid'    => __( 'Solid', 'simple-posts-ticker' ),
        'dotted'   => __( 'Dotted', 'simple-posts-ticker' ),
        'dashed'   => __( 'Dashed', 'simple-posts-ticker' ),
        'double'   => __( 'Double', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-border" name="spt_plugin_settings[spt_border]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_border'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Choose the border type of the marquee posts ticker from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_border_width_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_border_width']) ) {
        $spt_settings['spt_border_width'] = '3px';
    } ?>  <input id="spt-border-width" name="spt_plugin_settings[spt_border_width]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_border_width'])) { echo esc_attr( $spt_settings['spt_border_width'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the label border width from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_border_radius_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_border_radius']) ) {
        $spt_settings['spt_border_radius'] = '0px';
    } ?>  <input id="spt-border-radius" name="spt_plugin_settings[spt_border_radius]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_border_radius'])) { echo esc_attr( $spt_settings['spt_border_radius'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the border radius from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_border_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-border-colour" name="spt_plugin_settings[spt_border_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_border_colour'])) { echo esc_attr( $spt_settings['spt_border_colour'] ); } ?>" />
    <?php
}

function spt_size_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_size']) ) {
        $spt_settings['spt_size'] = '100%';
    } ?>  <input id="spt-font-size" name="spt_plugin_settings[spt_size]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_size'])) { echo esc_attr( $spt_settings['spt_size'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the font size of Posts Ticker text or link from here. You can use px/em/%.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_ticker_margin_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_ticker_margin']) ) {
        $spt_settings['spt_ticker_margin'] = '0';
    } ?>  <input id="spt-ticker-margin" name="spt_plugin_settings[spt_ticker_margin]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_ticker_margin'])) { echo esc_attr( $spt_settings['spt_ticker_margin'] ); } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_margin.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php esc_attr_e( 'Set the posts ticker content area margin from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_ticker_padding_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_ticker_padding']) ) {
        $spt_settings['spt_ticker_padding'] = '0';
    } ?>  <input id="spt-ticker-padding" name="spt_plugin_settings[spt_ticker_padding]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_ticker_padding'])) { echo esc_attr( $spt_settings['spt_ticker_padding'] ); } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_padding.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php esc_attr_e( 'Set the posts ticker content area padding from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_ticker_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-ticker-colour" name="spt_plugin_settings[spt_ticker_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_ticker_colour'])) { echo esc_attr( $spt_settings['spt_ticker_colour'] ); } ?>" />
    <?php
}

function spt_ticker_bg_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-ticker-bg-colour" name="spt_plugin_settings[spt_ticker_bg_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_ticker_bg_colour'])) { echo esc_attr( $spt_settings['spt_ticker_bg_colour'] ); } ?>" />
    <?php
}

function spt_ticker_link_padding_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_ticker_link_padding']) ) {
        $spt_settings['spt_ticker_link_padding'] = '0 10px';
    } ?>  <input id="spt-ticker-link-padding" name="spt_plugin_settings[spt_ticker_link_padding]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_ticker_link_padding'])) { echo esc_attr( $spt_settings['spt_ticker_link_padding'] ); } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_padding.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php esc_attr_e( 'Set the left right padding of a post a link from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_ticker_direction_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_ticker_direction']) ) {
        $spt_settings['spt_ticker_direction'] = 'right';
    }
    $items = array(
        'right'  => __( 'Left to Right', 'simple-posts-ticker' ),
        'left'   => __( 'Right to Left', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-direction" name="spt_plugin_settings[spt_ticker_direction]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_ticker_direction'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the direction of the posts ticker. It may be Left to Right or Right to Left.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_ticker_continuous_flow_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_ticker_continuous_flow']) ) {
        $spt_settings['spt_ticker_continuous_flow'] = 'false';
    }
    $items = array(
        'true'   => __( 'Enable', 'simple-posts-ticker' ),
        'false'  => __( 'Disable', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-continuous-flow" name="spt_plugin_settings[spt_ticker_continuous_flow]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_ticker_continuous_flow'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Should the marquee be duplicated to show an effect of continuous flow. Configure the continuous flow of Posts Ticker from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_loop_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_show_loop']) ) {
        $spt_settings['spt_show_loop'] = '1';
    } ?>  <input id="spt-loop" name="spt_plugin_settings[spt_show_loop]" type="number" size="30" min="1" style="width:30%;" required value="<?php if (isset($spt_settings['spt_show_loop'])) { echo esc_attr( $spt_settings['spt_show_loop'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the number of ticker to adaptive continuous flow from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_stop_on_hover_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_stop_on_hover']) ) {
        $spt_settings['spt_stop_on_hover'] = 'false';
    }
    $items = array(
        'true'  => __( 'Yes', 'simple-posts-ticker' ),
        'false' => __( 'No', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-hover" name="spt_plugin_settings[spt_stop_on_hover]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_stop_on_hover'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Choose whether to pause marquee scroll on mouse hover, defaults to \'no\', set to \'yes\' to pause scroll on mouse hover.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_duration_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_duration']) ) {
        $spt_settings['spt_duration'] = '5000';
    } ?>  <input id="spt-duration" name="spt_plugin_settings[spt_duration]" type="number" size="30" min="0" style="width:30%;" required value="<?php if (isset($spt_settings['spt_duration'])) { echo esc_attr( $spt_settings['spt_duration'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Duration in milliseconds in which you want your element to travel. Default: 5000. Higher number indicates low speed and lower number indicates high speed.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_speed_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_speed']) ) {
        $spt_settings['spt_speed'] = '0';
    } ?>  <input id="spt-speed" name="spt_plugin_settings[spt_speed]" type="number" size="30" min="0" style="width:30%;" required value="<?php if (isset($spt_settings['spt_speed'])) { echo esc_attr( $spt_settings['spt_speed'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Speed will override duration. Speed allows you to set a relatively constant marquee speed regardless of the width of the containing element. Speed is measured in pixels per second. Higher number indicates high speed and lower number indicates low speed.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_visible_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_visible']) ) {
        $spt_settings['spt_visible'] = 'false';
    }
    $items = array(
        'true'  => __( 'Yes', 'simple-posts-ticker' ),
        'false' => __( 'No', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-visible" name="spt_plugin_settings[spt_visible]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_visible'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'The marquee will be visible from the start if set to true, defaults to false.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_delay_start_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_delay_start']) ) {
        $spt_settings['spt_delay_start'] = '100';
    } ?>  <input id="spt-delay" name="spt_plugin_settings[spt_delay_start]" type="number" size="30" min="0" style="width:30%;" required value="<?php if (isset($spt_settings['spt_delay_start'])) { echo esc_attr( $spt_settings['spt_delay_start'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Time in milliseconds before the marquee starts animating. Default: 100. Higher number indicates high speed and lower number indicates low speed.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_enable_link_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_enable_link']) ) {
        $spt_settings['spt_enable_link'] = 'yes';
    }
    $items = array(
        'yes'  => __( 'Yes', 'simple-posts-ticker' ),
        'no'   => __( 'No', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-link" name="spt_plugin_settings[spt_enable_link]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_enable_link'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'You can control ticker links from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_target_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_target']) ) {
        $spt_settings['spt_target'] = '_self';
    }
    $items = array(
        '_self'    => __( 'Same Window (_self)', 'simple-posts-ticker' ),
        '_blank'   => __( 'New Window (_blank)', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-window" name="spt_plugin_settings[spt_target]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_target'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the target for the links, can be _self or _blank.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_no_follow_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_no_follow']) ) {
        $spt_settings['spt_no_follow'] = 'no';
    }
    $items = array(
        'yes'  => __( 'Yes', 'simple-posts-ticker' ),
        'no'   => __( 'No', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-no-follow" name="spt_plugin_settings[spt_no_follow]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_no_follow'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Enabling this setting will add an attribute called \'nofollow\' to the all post links. This tells search engines to not follow this link.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_info_position_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_info_position']) ) {
        $spt_settings['spt_show_info_position'] = 'right';
    }
    $items = array(
        'left'    => __( 'Left Side', 'simple-posts-ticker' ),
        'right'   => __( 'Right Side', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-info-position" name="spt_plugin_settings[spt_show_info_position]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_info_position'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Select the position of the post ticker info. It may be Left or Right.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_info_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_info']) ) {
        $spt_settings['spt_show_info'] = 'none';
    }
    $items = array(
        'none'        => __( 'None', 'simple-posts-ticker' ),
        'pub_date'    => __( 'Post Published Date', 'simple-posts-ticker' ),
        'mod_date'    => __( 'Post Modified Date', 'simple-posts-ticker' ),
        'pub_author'  => __( 'Post Original Author', 'simple-posts-ticker' ),
        'mod_author'  => __( 'Post Modified Author', 'simple-posts-ticker' ),
        'excerpt'     => __( 'Post Excerpt', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-info" name="spt_plugin_settings[spt_show_info]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_info'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the visibility of post excerpt to show the excerpt for each post in Posts Ticker.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_info_sep_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_post_info_sep']) ) {
        $spt_settings['spt_post_info_sep'] = ' - ';
    } ?>  <input id="spt-info-sep" name="spt_plugin_settings[spt_post_info_sep]" type="text" size="30" style="width:30%;" value="<?php if (isset($spt_settings['spt_post_info_sep'])) { echo esc_attr( $spt_settings['spt_post_info_sep'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the font size of Posts Ticker label from here. You can use px/em/%.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_info_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-info-colour" name="spt_plugin_settings[spt_post_info_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_post_info_colour'])) { echo esc_attr( $spt_settings['spt_post_info_colour'] ); } ?>" />
    <?php
}

function spt_no_content_type_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_no_content_type']) ) {
        $spt_settings['spt_no_content_type'] = 'none';
    }
    $items = array(
        'none'  => __( 'Show Nothing', 'simple-posts-ticker' ),
        'text'  => __( 'Show a Message', 'simple-posts-ticker' ),
    );
    echo '<select id="spt-nocontent-type" name="spt_plugin_settings[spt_no_content_type]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_no_content_type'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set what you want to do when there are no posts available to show.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_no_content_text_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_no_content_text']) ) {
        $spt_settings['spt_no_content_text'] = __( 'There are no matching posts to show', 'simple-posts-ticker' );
    }
    ?>  <input id="spt-nocontent" name="spt_plugin_settings[spt_no_content_text]" type="text" size="55" style="width:55%;" required value="<?php if (isset($spt_settings['spt_no_content_text'])) { echo esc_attr( $spt_settings['spt_no_content_text'] ); } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php esc_attr_e( 'Set the text to display if no matching posts are found.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_custom_css_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?> <textarea id="spt-css" placeholder="a.spt-link:hover { color: #000 !important; font-weight: bold; }" name="spt_plugin_settings[spt_custom_css]" rows="8" cols="100" style="width:90%;"><?php if (isset($spt_settings['spt_custom_css'])) { echo wp_unslash( wp_kses_post( $spt_settings['spt_custom_css'] ) ); } ?></textarea>
    <br><small><?php printf(__( 'Do not add %s tag. This tag is not required, as it is already added.', 'simple-posts-ticker' ), '<code>&lt;style&gt;&lt;/style&gt;</code>'); ?></small>
    <?php
}

function spt_delete_data_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input type="checkbox" id="spt-delete-data" name="spt_plugin_settings[spt_delete_data]" value="1" <?php checked(isset($spt_settings['spt_delete_data']), 1); ?> /> 
        <label for="spt-delete-data" style="font-size: 12px;"><?php esc_html_e( 'Yes, I want to delete all plugin data at the time of uninstallation.', 'simple-posts-ticker' ); ?></label>
    <?php
}


?>