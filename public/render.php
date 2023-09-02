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

function spt_render_posts_ticker( $atts ) {
    $spt_settings = get_option('spt_plugin_settings');
    
    global $post;

    // Save the global post object so we can restore it later
    $save_post = $post;

    // post types
    $num_posts = !empty($spt_settings['spt_num_posts']) ? $spt_settings['spt_num_posts'] : '5';
    $post_type = isset($spt_settings['spt_post_type']) ? $spt_settings['spt_post_type'] : 'post';
    $orderby = isset($spt_settings['spt_show_orderby']) ? $spt_settings['spt_show_orderby'] : 'date';
    $order = isset($spt_settings['spt_show_order']) ? $spt_settings['spt_show_order'] : 'DESC';
    $category = isset($spt_settings['spt_post_cat']) && $post_type == 'post' ? implode(',', $spt_settings['spt_post_cat']) : '0';
    
    // label options
    $label = isset($spt_settings['spt_show_label']) ? $spt_settings['spt_show_label'] : 'yes';
    $label_position = !empty($spt_settings['spt_label_position']) ? $spt_settings['spt_label_position'] : 'left';
    $label_text = !empty($spt_settings['spt_label_text']) ? $spt_settings['spt_label_text'] : 'Latest Posts';
    $label_text_size = !empty($spt_settings['spt_label_font_size']) ? $spt_settings['spt_label_font_size'] : '100%';
    $label_margin = !empty($spt_settings['spt_margin']) ? $spt_settings['spt_margin'] : '0';
    $label_padding = !empty($spt_settings['spt_padding']) ? $spt_settings['spt_padding'] : '0 10px';
    $label_colour = !empty($spt_settings['spt_label_text_colour']) ? spt_validate_html_color($spt_settings['spt_label_text_colour']) : 'inherit';
    $label_bg_colour = !empty($spt_settings['spt_label_bg_colour']) ? spt_validate_html_color($spt_settings['spt_label_bg_colour']) : 'inherit';
    
    // border options
    $ticker_border = isset($spt_settings['spt_border']) ? $spt_settings['spt_border'] : 'solid';
    $ticker_border_width = !empty($spt_settings['spt_border_width']) ? $spt_settings['spt_border_width'] : '3px';
    $ticker_border_radius = !empty($spt_settings['spt_border_radius']) ? $spt_settings['spt_border_radius'] : '0px';
    $ticker_border_colour = !empty($spt_settings['spt_border_colour']) ? spt_validate_html_color($spt_settings['spt_border_colour']) : $label_bg_colour;
    
    // content options
    $content_size = !empty($spt_settings['spt_size']) ? $spt_settings['spt_size'] : '100%';
    $content_margin = !empty($spt_settings['spt_ticker_margin']) ? $spt_settings['spt_ticker_margin'] : '0';
    $content_padding = !empty($spt_settings['spt_ticker_padding']) ? $spt_settings['spt_ticker_padding'] : '0';
    $content_colour = !empty($spt_settings['spt_ticker_colour']) ? spt_validate_html_color($spt_settings['spt_ticker_colour']) : '#333333';
    $content_bg_colour = !empty($spt_settings['spt_ticker_bg_colour']) ? spt_validate_html_color($spt_settings['spt_ticker_bg_colour']) : 'inherit';
    $content_link_padding = !empty($spt_settings['spt_ticker_link_padding']) ? $spt_settings['spt_ticker_link_padding'] : '0 10px';
    
    //ticker settings
    $ticker_direction = isset($spt_settings['spt_ticker_direction']) ? $spt_settings['spt_ticker_direction'] : 'right';
    $ticker_cflow = isset($spt_settings['spt_ticker_continuous_flow']) ? $spt_settings['spt_ticker_continuous_flow'] : 'false';
    $ticker_loop = !empty($spt_settings['spt_show_loop']) ? $spt_settings['spt_show_loop'] : '1';
    $ticker_pause = isset($spt_settings['spt_stop_on_hover']) ? $spt_settings['spt_stop_on_hover'] : 'false';
    $ticker_duration = !empty($spt_settings['spt_duration']) ? $spt_settings['spt_duration'] : '5000';
    $ticker_speed = !empty($spt_settings['spt_speed']) ? $spt_settings['spt_speed'] : '';
    $ticker_visible = isset($spt_settings['spt_visible']) ? $spt_settings['spt_visible'] : 'false';
    $ticker_delay = !empty($spt_settings['spt_delay_start']) ? $spt_settings['spt_delay_start'] : '100';
    
    // others
    $hyperlink = isset($spt_settings['spt_enable_link']) ? $spt_settings['spt_enable_link'] : 'yes';
    $target = isset($spt_settings['spt_target']) ? $spt_settings['spt_target'] : '_self';
    $nofollow = isset($spt_settings['spt_no_follow']) ? $spt_settings['spt_no_follow'] : 'no';
    $post_info = isset($spt_settings['spt_show_info']) ? $spt_settings['spt_show_info'] : 'none';
    $post_info_position = isset($spt_settings['spt_show_info_position']) ? $spt_settings['spt_show_info_position'] : 'right';
    $post_info_colour = !empty($spt_settings['spt_post_info_colour']) ? spt_validate_html_color($spt_settings['spt_post_info_colour']) : $content_colour;
    $post_info_sep = !empty($spt_settings['spt_post_info_sep']) ? $spt_settings['spt_post_info_sep'] : '';
    $no_content = isset($spt_settings['spt_no_content_type']) ? $spt_settings['spt_no_content_type'] : 'none';
    $no_content_text = !empty($spt_settings['spt_no_content_text']) ? $spt_settings['spt_no_content_text'] : __( 'There are no matching posts to show', 'simple-posts-ticker' );

    $atts = shortcode_atts( array(
        'num_posts'                 => $num_posts,
        'post_type'                 => $post_type,
        'order_by'                  => $orderby,
        'order'                     => $order,
        'category'                  => $category,
        'show_label'                => $label,
        'label_position'            => $label_position,
        'label_text'                => $label_text,
        'label_text_size'           => $label_text_size,
        'label_margin'              => $label_margin,
        'label_padding'             => $label_padding,
        'label_colour'              => $label_colour,
        'label_bg_colour'           => $label_bg_colour,
        'ticker_border'             => $ticker_border,
        'ticker_border_width'       => $ticker_border_width,
        'ticker_border_radius'      => $ticker_border_radius,
        'ticker_border_colour'      => $ticker_border_colour,
        'content_size'              => $content_size,
        'content_margin'            => $content_margin,
        'content_padding'           => $content_padding,
        'content_colour'            => $content_colour,
        'content_bg_colour'         => $content_bg_colour,
        'content_link_padding'      => $content_link_padding,
        'ticker_direction'          => $ticker_direction,
        'ticker_cflow'              => $ticker_cflow,
        'ticker_loop'               => $ticker_loop,
        'ticker_pause'              => $ticker_pause,
        'ticker_duration'           => $ticker_duration,
        'ticker_speed'              => $ticker_speed,
        'ticker_visible'            => $ticker_visible,
        'ticker_delay'              => $ticker_delay,
        'hyperlink'                 => $hyperlink,
        'target'                    => $target,
        'no_follow'                 => $nofollow,
        'post_info'                 => $post_info,
        'post_info_position'        => $post_info_position,
        'post_info_colour'          => $post_info_colour,
        'post_info_sep'             => $post_info_sep,
        'no_content'                => $no_content,
        'no_content_text'           => $no_content_text,
        'category_name'             => '',
        'post_info_start'           => '',
        'post_info_end'             => '',
        'link_class'                => '',
        'css_class'                 => 'spt-marquee',
        'exclude'                   => array(),
        'include'                   => array(),
    ), $atts, 'spt-posts-ticker' );

    $atts = map_deep( $atts, 'wp_unslash' );
    $atts = map_deep( $atts, 'esc_attr' );

    $comma = ',';
    $scvalue = $atts['post_type'];
    if( strpos( $scvalue, $comma ) !== false ) {
        $post_type = explode(',', sanitize_text_field( $atts['post_type'] ) );
    } else {
        $post_type = sanitize_text_field( $atts['post_type'] );
    }

    $args = array(
        'numberposts'	=> sanitize_text_field( $atts['num_posts'] ),
        'category'		=> sanitize_text_field( $atts['category'] ),
        'orderby'		=> sanitize_text_field( $atts['order_by'] ),
        'order'			=> sanitize_text_field( $atts['order'] ),
        'post_type'     => $post_type,
        'post_status'   => 'publish',
        'exclude'       => array(),
        'include'       => array(),
    );

    if( !empty( $atts['category_name'] ) ) {
        $args['category'] = '0';
        $args['category_name'] = sanitize_text_field( $atts['category_name'] );
    }

    if( !empty( $atts['exclude'] ) ) {
        $exvalue = $atts['exclude'];
        if( strpos( $exvalue, $comma ) !== false ) {
            $exclude_ids = explode(',', sanitize_text_field( $atts['exclude'] ) );
            foreach( $exclude_ids as $exclude_id ) {
                array_push( $args['exclude'], $exclude_id );
            }
        } else {
            array_push( $args['exclude'], sanitize_text_field( $atts['exclude'] ) );
        }
    }

    if( !empty( $atts['include'] ) ) {
        $invalue = $atts['include'];
        if( strpos( $invalue, $comma ) !== false ) {
            $include_ids = explode(',', sanitize_text_field( $atts['include'] ) );
            foreach( $include_ids as $include_id ) {
                array_push( $args['include'], $include_id );
            }
        } else {
            array_push( $args['include'], sanitize_text_field( $atts['include'] ) );
        }
    }

    $args = apply_filters( 'spt_ticker_custom_query', $args );

    //error_log( print_r( $args, TRUE ) );
            
    $posts = get_posts( $args );

    $no_follow = '';
    if( $atts['no_follow'] == 'yes' ) {
        $no_follow = ' rel="nofollow"';
    }

    $border = 'none';
    if( $atts['ticker_border'] != 'none' ) {
        $border = $atts['ticker_border'].' '.$atts['ticker_border_width'].' '.$atts['ticker_border_colour'];
    }

    $linkclass = !empty($atts['link_class']) ? 'spt-link '.$atts['link_class'] : 'spt-link';

    $css= '';
    if( is_rtl() ) {
        $css = 'direction: ltr;';
    }

    $content = '';
    $content .= "\n".'<!-- This website uses the Simple Posts Ticker plugin v' . SPT_PLUGIN_VERSION . ' - https://wordpress.org/plugins/simple-posts-ticker/ -->' . "\n";
    $content .= '<div class="spt-container spt-border" style="border: '.$border.';border-radius: '.$atts['ticker_border_radius'].';width: 100%;">';
    if( $atts['show_label'] == 'yes' ) {
        $content .= '<div class="spt-label" style="float: '.$atts['label_position'].';margin: '.$atts['label_margin'].';padding: '.$atts['label_padding'].';color: '.$atts['label_colour'].';background-color: '.$atts['label_bg_colour'].';font-size: '.$atts['label_text_size'].';border-radius: '.$atts['ticker_border_radius'].';">'.$atts['label_text'].'</div>';
    }
    $content .= '<div class="'.$atts['css_class'].'" data-direction="'.$atts['ticker_direction'].'" data-duplicated="'.$atts['ticker_cflow'].'" data-duration="'.$atts['ticker_duration'].'" data-gap="0" data-speed="'.$atts['ticker_speed'].'" data-pauseOnHover="'.$atts['ticker_pause'].'" data-delayBeforeStart="'.$atts['ticker_delay'].'" data-startVisible="'.$atts['ticker_visible'].'" data-loop="'.$atts['ticker_loop'].'" style="width:auto;margin: '.$atts['content_margin'].';padding: '.$atts['content_padding'].';font-size: '.$atts['content_size'].';background-color: '.$atts['content_bg_colour'].';overflow: hidden;'.$css.'">';
    if( count( $posts ) == 0 ) {
        $content .= '<span class="spt-item" style="padding: '.$atts['content_link_padding'].';">';
        $content .= $atts['no_content_text'];
        $content .= '</span>';
    } else {
        try {
            foreach( $posts as $post ) {
                setup_postdata( $post ); // Set up "environment"
                $viewable = is_post_type_viewable( get_post_type() );
                $content .= '<span class="spt-item" style="padding: '.$atts['content_link_padding'].';">';
                $link = get_permalink();
                if( get_post_type() == 'spt_ticker' ) {
                    if( metadata_exists( 'post', get_the_ID(), '_spt_ticker_custom_link' ) ) {
                        $link = esc_attr( get_post_meta( get_the_ID(), '_spt_ticker_custom_link', true ) );
                    } else {
                        $link = '';
                    }
                }
                if( $atts['hyperlink'] == 'yes' && ( $viewable || !empty( $link ) ) ) {
                    $content .= '<a class="'.$linkclass.'"'.$no_follow.' style="color: '.$atts['content_colour'].';" target="'.$atts['target'].'" href="'.apply_filters( 'spt_post_custom_redir_link', esc_url( $link ) ).'">';
                }
                $title = apply_filters( 'spt_post_title_prefix', '' ).substr( get_the_title(), 0, apply_filters( 'spt_post_title_length', '120' ) ).apply_filters( 'spt_post_title_postfix', '' );
                $separator_start = '';
                $separator_end = '';
                if( $atts['post_info'] != 'none' ) {
                    $info = '';
                    if ( $atts['post_info'] == 'pub_date' ) {
                        $info .= get_the_date();
                    } elseif ( $atts['post_info'] == 'mod_date' ) {
                        $info .= get_the_modified_date();
                    } elseif ( $atts['post_info'] == 'pub_author' ) {
                        $info .= get_the_author();
                    } elseif ( $atts['post_info'] == 'mod_author' ) {
                        $info .= get_the_modified_author();
                    } elseif ( $atts['post_info'] == 'excerpt' ) {
                        $info .= substr( get_the_excerpt(), 0, apply_filters( 'spt_post_excerpt_length', '250' ) );
                    }
                    $separator_start = '<span class="spt-separator">'.$atts['post_info_sep'].'</span><span class="spt-postinfo" style="color: '.$atts['post_info_colour'].';">'.$atts['post_info_start'].$info.$atts['post_info_end'].'</span>';
                    $separator_end = '<span class="spt-postinfo" style="color: '.$atts['post_info_colour'].';">'.$atts['post_info_end'].$info.$atts['post_info_start'].'</span><span class="spt-separator">'.$atts['post_info_sep'].'</span>';
                }
                if( $atts['post_info_position'] == 'left' ) {
                    $content .= $separator_end . $title;
                } else {
                    $content .= $title . $separator_start;
                }
                if( $atts['hyperlink'] == 'yes' && ( $viewable || !empty( $link ) ) ) {
                    $content .= '</a>';
                }
                $content .= '</span>';
            }
        } finally {
            wp_reset_postdata();
      
            // Restore the global post object
            $post = $save_post;
        }
    }
    $content .= '</div>'; // end marquee box
    $content .= '</div>'; // end border container

    if( $atts['no_content'] == 'none' ) {
        if ( count( $posts ) == 0 ) {
            $content = '';
        }
    }

    return $content;
}

function spt_validate_html_color( $input ) {
	if( preg_match( '/^#[a-f0-9]{6}$/i', $input ) ) {
		return $input;
	} else {
		return '#000000';
	}
}