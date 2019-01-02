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
    } ?>  <input id="spt-post-num" name="spt_plugin_settings[spt_num_posts]" type="number" min="5" max="20" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_num_posts'])) { echo $spt_settings['spt_num_posts']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the number of posts you want to show in ticker.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
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
        $exclude = array( 'attachment' );
        if( !in_array( $post_type->name, $exclude ) ) {
            $selected = ( $spt_settings['spt_post_type'] == $post_type->name ) ? ' selected="selected"' : '';
            echo '<option value="' . $post_type->name . '"' . $selected . '>' . $post_type->labels->name . '</option>';
        }
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the type of post you want to show in ticker.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_orderby_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_orderby']) ) {
        $spt_settings['spt_show_orderby'] = 'date';
    }
    $items = array(
        'date'      => 'Published Date',
        'modified'  => 'Modified Date',
        'rand'      => 'Random',
    );
    echo '<select id="spt-orderby" name="spt_plugin_settings[spt_show_orderby]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_orderby'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the query method of getting posts from database.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_order_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_order']) ) {
        $spt_settings['spt_show_order'] = 'DESC';
    }
    $items = array(
        'DESC'   => 'Decending',
        'ASC'    => 'Ascending'
    );
    echo '<select id="spt-order" name="spt_plugin_settings[spt_show_order]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_order'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the post display order from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_cat_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( !isset($spt_settings['spt_post_cat']) ) {
        $spt_settings['spt_post_cat'][] = '0';
    }

    $categories = get_terms( array(
        'taxonomy'     => 'category',
        'orderby'      => 'name',
        //'hide_empty'   => false,
    ) );

    echo '<select id="spt-cat" name="spt_plugin_settings[spt_post_cat][]" multiple="multiple" style="width:90%;">';
    foreach( $categories as $item ) {
        $selected = in_array( $item->term_id, $spt_settings['spt_post_cat'] ) ? ' selected="selected"' : '';
        echo '<option value="' . $item->term_id . '"' . $selected . '>' . $item->name . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the category you want to get posts from that to show on Posts Ticker. Leave blank if you want to include all category.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_label_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_label']) ) {
        $spt_settings['spt_show_label'] = 'yes';
    }
    $items = array(
        'yes'  => 'Yes',
        'no'   => 'No',
    );
    echo '<select id="spt-ticker-label" name="spt_plugin_settings[spt_show_label]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_label'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the Posts Ticker label visibility from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_label_text_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_label_text']) ) {
        $spt_settings['spt_label_text'] = 'Latest Posts';
    } ?>  <input id="spt-label-text" name="spt_plugin_settings[spt_label_text]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_label_text'])) { echo $spt_settings['spt_label_text']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the message/label to show before the Posts Ticker', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_label_font_size_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_label_font_size']) ) {
        $spt_settings['spt_label_font_size'] = '100%';
    } ?>  <input id="spt-label-text-font-size" name="spt_plugin_settings[spt_label_font_size]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_label_font_size'])) { echo $spt_settings['spt_label_font_size']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the font size of Posts Ticker label from here. You can use px/em/%.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_margin_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_margin']) ) {
        $spt_settings['spt_margin'] = '2px 10px';
    } ?>  <input id="spt-margin" name="spt_plugin_settings[spt_margin]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_margin'])) { echo $spt_settings['spt_margin']; } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_margin.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php _e( 'Set the margin of the ticker label from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_label_text_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-label-colour" name="spt_plugin_settings[spt_label_text_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_label_text_colour'])) { echo $spt_settings['spt_label_text_colour']; } ?>" />
    <?php
}

function spt_label_bg_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-label-bg-colour" name="spt_plugin_settings[spt_label_bg_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_label_bg_colour'])) { echo $spt_settings['spt_label_bg_colour']; } ?>" />
    <?php
}

function spt_border_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_border']) ) {
        $spt_settings['spt_border'] = 'solid';
    }
    $items = array(
        'none'     => 'None',
        'solid'    => 'Solid',
        'dotted'   => 'Dotted',
        'dashed'   => 'Dashed',
        'double'   => 'Double',
    );
    echo '<select id="spt-border" name="spt_plugin_settings[spt_border]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_border'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Choose the border type of the marquee type posts ticker from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_border_width_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_border_width']) ) {
        $spt_settings['spt_border_width'] = '3px';
    } ?>  <input id="spt-border-width" name="spt_plugin_settings[spt_border_width]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_border_width'])) { echo $spt_settings['spt_border_width']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the label border width from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_border_radius_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_border_radius']) ) {
        $spt_settings['spt_border_radius'] = '0px';
    } ?>  <input id="spt-border-radius" name="spt_plugin_settings[spt_border_radius]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_border_radius'])) { echo $spt_settings['spt_border_radius']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the border radious from here.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_border_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-border-colour" name="spt_plugin_settings[spt_border_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_border_colour'])) { echo $spt_settings['spt_border_colour']; } ?>" />
    <?php
}

function spt_size_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_size']) ) {
        $spt_settings['spt_size'] = '100%';
    } ?>  <input id="spt-font-size" name="spt_plugin_settings[spt_size]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_size'])) { echo $spt_settings['spt_size']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the font size of Posts Ticker from here. You can use px/em/%.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_speed_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_speed']) ) {
        $spt_settings['spt_speed'] = '50';
    } ?>  <input id="spt-speed" name="spt_plugin_settings[spt_speed]" type="number" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_speed'])) { echo $spt_settings['spt_speed']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the the speed to scroll by, in pixels per second. Higher number indicates high speed and lower number indicates low speed.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_target_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_target']) ) {
        $spt_settings['spt_target'] = '_self';
    }
    $items = array(
        '_self'    => 'Same Window (_self)',
        '_blank'   => 'New Window (_blank)',
    );
    echo '<select id="spt-window" name="spt_plugin_settings[spt_target]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_target'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the target for the links, can be _self or _blank.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_no_follow_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_no_follow']) ) {
        $spt_settings['spt_no_follow'] = 'no';
    }
    $items = array(
        'yes'  => 'Yes',
        'no'   => 'No',
    );
    echo '<select id="spt-no-follow" name="spt_plugin_settings[spt_no_follow]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_no_follow'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enabling this setting will add an attribute called \'nofollow\' to the all post links. This tells search engines to not follow this link.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_ticker_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-ticker-colour" name="spt_plugin_settings[spt_ticker_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_ticker_colour'])) { echo $spt_settings['spt_ticker_colour']; } ?>" />
    <?php
}

function spt_ticker_bg_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-ticker-bg-colour" name="spt_plugin_settings[spt_ticker_bg_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_ticker_bg_colour'])) { echo $spt_settings['spt_ticker_bg_colour']; } ?>" />
    <?php
}

function spt_ticker_margin_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_ticker_margin']) ) {
        $spt_settings['spt_ticker_margin'] = '2px 0';
    } ?>  <input id="spt-ticker-margin" name="spt_plugin_settings[spt_ticker_margin]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_ticker_margin'])) { echo $spt_settings['spt_ticker_margin']; } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_margin.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php _e( 'Set the posts ticker margin from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_ticker_padding_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_ticker_padding']) ) {
        $spt_settings['spt_ticker_padding'] = '0 10px';
    } ?>  <input id="spt-ticker-padding" name="spt_plugin_settings[spt_ticker_padding]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_ticker_padding'])) { echo $spt_settings['spt_ticker_padding']; } ?>" />
        &nbsp;&nbsp;<a href="https://www.w3schools.com/css/css_padding.asp" target="_blank" style="color: #444;"><span class="tooltip" title="<?php _e( 'Set the posts ticker padding from here. Click on the icon for more.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span></a>
    <?php
}

function spt_gap_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_gap']) ) {
        $spt_settings['spt_gap'] = 'false';
    }
    $items = array(
        'true'  => 'Yes',
        'false' => 'No',
    );
    echo '<select id="spt-gap" name="spt_plugin_settings[spt_gap]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_gap'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Choose whether to show a gap between cycles of the marquee content, defaults to \'yes\' for classic marquee style, set to \'no\' for new infinite scrolling style marquee.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_show_info_display() {
    $spt_settings = get_option('spt_plugin_settings');
    
    if( !isset($spt_settings['spt_show_info']) ) {
        $spt_settings['spt_show_info'] = 'none';
    }
    $items = array(
        'none'        => 'None',
        'pub_date'    => 'Post Published Date',
        'mod_date'    => 'Post Modified Date',
        'pub_author'  => 'Post Original Author',
        'mod_author'  => 'Post Modified Author',
        'excerpt'     => 'Post Excerpt',
    );
    echo '<select id="spt-info" name="spt_plugin_settings[spt_show_info]" style="width:30%;">';
    foreach( $items as $item => $label ) {
        $selected = ( $spt_settings['spt_show_info'] == $item ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the visibility of post excerpt to show the excerpt for each post in Posts Ticker.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_info_sep_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_post_info_sep']) ) {
        $spt_settings['spt_post_info_sep'] = ' - ';
    } ?>  <input id="spt-info-sep" name="spt_plugin_settings[spt_post_info_sep]" type="text" size="30" style="width:30%;" required value="<?php if (isset($spt_settings['spt_post_info_sep'])) { echo $spt_settings['spt_post_info_sep']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the font size of Posts Ticker label from here. You can use px/em/%.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_post_info_colour_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input id="spt-info-colour" name="spt_plugin_settings[spt_post_info_colour]" type="text" class="spt-color-picker" placeholder="#fff" value="<?php if (isset($spt_settings['spt_post_info_colour'])) { echo $spt_settings['spt_post_info_colour']; } ?>" />
    <?php
}

function spt_no_content_text_display() {
    $spt_settings = get_option('spt_plugin_settings');
    if( empty($spt_settings['spt_no_content_text']) ) {
        $spt_settings['spt_no_content_text'] = 'There are no matching posts to show';
    }
    ?>  <input id="spt-nocontent" name="spt_plugin_settings[spt_no_content_text]" type="text" size="55" style="width:55%;" required value="<?php if (isset($spt_settings['spt_no_content_text'])) { echo $spt_settings['spt_no_content_text']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set the text to display if no matching posts are found.', 'simple-posts-ticker' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function spt_custom_css_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?> <textarea id="spt-css" placeholder="a.spt-link:hover { color: #000 !important; font-weight: bold; }" name="spt_plugin_settings[spt_custom_css]" rows="8" cols="100" style="width:90%;"><?php if (isset($spt_settings['spt_custom_css'])) { echo $spt_settings['spt_custom_css']; } ?></textarea>
    <br><small><?php printf(__( 'Do not add %s tag. This tag is not required, as it is already added.', 'simple-posts-ticker' ), '<code>&lt;style&gt;&lt;/style&gt;</code>'); ?></small>
    <?php
}

function spt_delete_data_display() {
    $spt_settings = get_option('spt_plugin_settings');
    ?>  <input type="checkbox" id="spt-delete-data" name="spt_plugin_settings[spt_delete_data]" value="1" <?php checked(isset($spt_settings['spt_delete_data']), 1); ?> /> 
        <label for="spt-delete-data" style="font-size: 12px;"><?php _e( 'Yes, I want to delete all plugin data at the time of uninstallation.', 'simple-posts-ticker' ); ?></label>
    <?php
}


?>