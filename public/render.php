<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_shortcode( 'spt-posts-ticker', 'spt_render_posts_ticker' );
add_action( 'wp_head', 'spt_custom_style_to_wp_head', 10 );

function spt_render_posts_ticker( $atts ) {
    $spt_settings = get_option('spt_plugin_settings');

    global $post;

    $num_posts = !empty($spt_settings['spt_num_posts']) ? $spt_settings['spt_num_posts'] : '5';
    $post_type = isset($spt_settings['spt_post_type']) ? $spt_settings['spt_post_type'] : 'post';
    $orderby = isset($spt_settings['spt_show_orderby']) ? $spt_settings['spt_show_orderby'] : 'date';
    $order = isset($spt_settings['spt_show_order']) ? $spt_settings['spt_show_order'] : 'DESC';
    $post_info = isset($spt_settings['spt_show_info']) ? $spt_settings['spt_show_info'] : 'none';
    $category = isset($spt_settings['spt_post_cat']) && $post_type == 'post' ? implode(',', $spt_settings['spt_post_cat']) : '0';
    $label = isset($spt_settings['spt_show_label']) ? $spt_settings['spt_show_label'] : 'yes';
    $label_text = !empty($spt_settings['spt_label_text']) ? $spt_settings['spt_label_text'] : 'Latest Posts';
    $label_size = !empty($spt_settings['spt_label_font_size']) ? $spt_settings['spt_label_font_size'] : '100%';
    $label_colour = !empty($spt_settings['spt_label_text_colour']) ? spt_validateHtmlColour($spt_settings['spt_label_text_colour']) : 'inherit';
    $label_bg_colour = !empty($spt_settings['spt_label_bg_colour']) ? spt_validateHtmlColour($spt_settings['spt_label_bg_colour']) : 'inherit';
    $label_margin = !empty($spt_settings['spt_margin']) ? $spt_settings['spt_margin'] : '2px 10px';
    $label_border = isset($spt_settings['spt_border']) ? $spt_settings['spt_border'] : 'solid';
    $label_border_width = !empty($spt_settings['spt_border_width']) ? $spt_settings['spt_border_width'] : '3px';
    $label_border_radius = !empty($spt_settings['spt_border_radius']) ? $spt_settings['spt_border_radius'] : '0px';
    $label_border_colour = !empty($spt_settings['spt_border_colour']) ? spt_validateHtmlColour($spt_settings['spt_border_colour']) : $label_bg_colour;
    $size = !empty($spt_settings['spt_size']) ? $spt_settings['spt_size'] : '100%';
    $speed = !empty($spt_settings['spt_speed']) ? $spt_settings['spt_speed'] : '50';
    $target = isset($spt_settings['spt_target']) ? $spt_settings['spt_target'] : '_self';
    $nofollow = isset($spt_settings['spt_no_follow']) ? $spt_settings['spt_no_follow'] : 'no';
    $colour = !empty($spt_settings['spt_ticker_colour']) ? spt_validateHtmlColour($spt_settings['spt_ticker_colour']) : '#333333';
    $bg_colour = !empty($spt_settings['spt_ticker_bg_colour']) ? spt_validateHtmlColour($spt_settings['spt_ticker_bg_colour']) : 'inherit';
    $post_info_colour = !empty($spt_settings['spt_post_info_colour']) ? spt_validateHtmlColour($spt_settings['spt_post_info_colour']) : $colour;
    $post_info_sep = !empty($spt_settings['spt_post_info_sep']) ? $spt_settings['spt_post_info_sep'] : ' - ';
    $margin = !empty($spt_settings['spt_ticker_margin']) ? $spt_settings['spt_ticker_margin'] : '2px 0';
    $padding = !empty($spt_settings['spt_ticker_padding']) ? $spt_settings['spt_ticker_padding'] : '0 10px';
    $gap = isset($spt_settings['spt_gap']) ? $spt_settings['spt_gap'] : 'false';
    $no_content = isset($spt_settings['spt_no_content_type']) ? $spt_settings['spt_no_content_type'] : 'none';
    $no_content_text = !empty($spt_settings['spt_no_content_text']) ? $spt_settings['spt_no_content_text'] : 'There are no matching posts to show';

    $atts = shortcode_atts(
		array(
            'num_posts'                 => $num_posts,
            'post_type'                 => $post_type,
            'order_by'                  => $orderby,
            'order'                     => $order,
            'category'                  => $category,
            'show_label'                => $label,
            'label_text'                => $label_text,
            'label_text_size'           => $label_size,
            'label_margin'              => $label_margin,
            'label_colour'              => $label_colour,
            'label_bg_colour'           => $label_bg_colour,
            'label_border'              => $label_border,
            'label_border_width'        => $label_border_width,
            'label_border_radius'       => $label_border_radius,
            'label_border_colour'       => $label_border_colour,
            'size'                      => $size,
            'speed'                     => $speed,
            'target'                    => $target,
            'no_follow'                 => $nofollow,
            'colour'                    => $colour,
            'bg_colour'                 => $bg_colour,
            'margin'                    => $margin,
            'padding'                   => $padding,
            'infinite_scroll'           => $gap,
            'post_info'                 => $post_info,
            'post_info_colour'          => $post_info_colour,
            'post_info_sep'             => $post_info_sep,
            'no_content'                => $no_content,
            'no_content_text'           => $no_content_text,
            'category_name'             => '',
		), $atts, 'spt-posts-ticker' );

    $args = array(
        'numberposts'	=> $atts['num_posts'],
        'category'		=> $atts['category'],
        'orderby'		=> $atts['order_by'],
        'order'			=> $atts['order'],
        'post_type'     => $atts['post_type'],
        'post_status'   => 'publish',
        'no_found_rows' => true,
    );

    if ( !empty( $atts['category_name'] ) ) {
        $args['category'] = '0';
        $args['category_name'] = $atts['category_name'];
    }

    $args = apply_filters( 'spt_ticker_custom_query', $args );

    //error_log( print_r( $args, TRUE ) );
            
    $posts = get_posts( $args );

    $no_follow = '';
    if ( $atts['no_follow'] == 'yes' ) {
        $no_follow = ' rel="nofollow"';
    }

    $border = 'none';
    if ( $atts['label_border'] != 'none' ) {
        $border = $atts['label_border'].' '.$atts['label_border_width'].' '.$atts['label_border_colour'];
    }

    $content = '';
    $content .= "\n".'<!-- This website uses the Simple Posts Ticker plugin v' . SPT_PLUGIN_VERSION . ' - https://wordpress.org/plugins/simple-posts-ticker/ -->' . "\n";
    if ( $atts['show_label'] == 'yes' ) {
        $content .= '<div class="spt-border" style="background-color: '.$atts['label_bg_colour'].';border: '.$border.';border-radius: '.$atts['label_border_radius'].';width: 100%;">';
        $content .= '<div class="spt-label" style="float: left; margin: '.$atts['label_margin'].';color: '.$atts['label_colour'].';font-size: '.$atts['label_text_size'].';">'.$atts['label_text'].'</div>';
    }
    $content .= '<div class="spt-box" style="background-color: '.$atts['bg_colour'].';overflow: hidden;border-top-right-radius: '.$atts['label_border_radius'].';border-bottom-right-radius: '.$atts['label_border_radius'].';">';
    $content .= '<div class="spt-content" data-gap="'.$atts['infinite_scroll'].'" data-speed="'.$atts['speed'].'" style="margin: '.$atts['margin'].';font-size: '.$atts['size'].';">';
    if ( count( $posts ) == 0 ) {
        $content .= '<span class="spt-item" style="padding: '.$atts['padding'].';">';
        $content .= $atts['no_content_text'];
        $content .= '</span>';
    } else {
        foreach ( $posts as $current_post ) {
            $post = $current_post; // Set $post global variable to the current post object 
            setup_postdata( $post ); // Set up "environment"
            $content .= '<span class="spt-item" style="padding: '.$atts['padding'].';">';
            $content .= '<a class="spt-link"'.$no_follow.' style="color: '.$atts['colour'].';" target="'.$atts['target'].'" href="'.get_permalink().'">'.apply_filters( 'spt_post_title_prefix', '' ).substr( get_the_title(), 0, apply_filters( 'spt_post_title_length', '150' ) );
            if ( $atts['post_info'] != 'none' ) {
                if ( $atts['post_info'] == 'pub_date' ) {
                    $info = get_the_date();
                } elseif ( $atts['post_info'] == 'mod_date' ) {
                    $info = get_the_modified_date();
                } elseif ( $atts['post_info'] == 'pub_author' ) {
                    $info = get_the_author();
                } elseif ( $atts['post_info'] == 'mod_author' ) {
                    $info = get_the_modified_author();
                } elseif ( $atts['post_info'] == 'excerpt' ) {
                    $info = substr( get_the_excerpt(), 0, apply_filters( 'spt_post_excerpt_length', '200' ) );
                }
                $content .= '<span class="spt-separator">'.$atts['post_info_sep'].'</span><span class="spt-postinfo" style="color: '.$atts['post_info_colour'].';">'.$info.'</span>';
            }
            $content .= '</a>';
            $content .= '</span>';
        }
        wp_reset_postdata();
    }
    $content .= '</div>'; // end content
    $content .= '</div>'; // end marquee box
    if ( $atts['show_label'] == 'yes' ) {
        $content .= '</div>'; // end border container
    }

    if ( $atts['no_content'] == 'none' ) {
        if ( count( $posts ) == 0 ) {
            $content = '';
        }
    }

    return $content;
}

function spt_validateHtmlColour( $input ) {
	if ( preg_match( '/^#[a-f0-9]{6}$/i', $input ) ) {
		return $input;
	} else {
		return '#000000';
	}
}

function spt_custom_style_to_wp_head() { 
    $spt_settings = get_option('spt_plugin_settings');

    $style = '';
    $style .= "\n".'<!-- This website uses the Simple Posts Ticker plugin v' . SPT_PLUGIN_VERSION . ' - https://wordpress.org/plugins/simple-posts-ticker/ -->' . "\n";
    $style .= '<style type="text/css">'."\n";
    $style .= '.spt-content { white-space: nowrap; display: inline-block; position: relative; left: 0px; }'."\n";
    if( !empty( $spt_settings['spt_custom_css'] ) ) {
        $style .= esc_html( $spt_settings['spt_custom_css'] )."\n";
    }
    $style .= '</style>'."\n";
    echo $style;
}


function spt_post_ticker_todays_post( $args ) { 
    $today = getdate();
    $args['date_query'] = array(
		array(
			'year'  => $today['year'],
			'month' => $today['mon'],
			'day'   => $today['mday'],
        ),
    );
    return $args;
}
// debug
//add_filter( 'spt_ticker_custom_query', 'spt_post_ticker_todays_post', 10, 1 );