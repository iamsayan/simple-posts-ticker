<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'init', 'spt_generate_ticker_post_type', 0 );

// Register Custom Post Type
function spt_generate_ticker_post_type() {

	$labels = array(
		'name'                  => _x( 'Tickers', 'Post Type General Name', 'simple-posts-ticker' ),
		'singular_name'         => _x( 'Ticker', 'Post Type Singular Name', 'simple-posts-ticker' ),
		'menu_name'             => __( 'Tickers', 'simple-posts-ticker' ),
		'name_admin_bar'        => __( 'Tickers', 'simple-posts-ticker' ),
		'archives'              => __( 'Ticker Archives', 'simple-posts-ticker' ),
		'attributes'            => __( 'Ticker Attributes', 'simple-posts-ticker' ),
		'parent_item_colon'     => __( 'Parent Item:', 'simple-posts-ticker' ),
		'all_items'             => __( 'All Tickers', 'simple-posts-ticker' ),
		'add_new_item'          => __( 'Add New Ticker', 'simple-posts-ticker' ),
		'add_new'               => __( 'Add New', 'simple-posts-ticker' ),
		'new_item'              => __( 'New Ticker', 'simple-posts-ticker' ),
		'edit_item'             => __( 'Edit Ticker', 'simple-posts-ticker' ),
		'update_item'           => __( 'Update Ticker', 'simple-posts-ticker' ),
		'view_item'             => __( 'View Ticker', 'simple-posts-ticker' ),
		'view_items'            => __( 'View Tickers', 'simple-posts-ticker' ),
		'search_items'          => __( 'Search Ticker', 'simple-posts-ticker' ),
		'not_found'             => __( 'Not found', 'simple-posts-ticker' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'simple-posts-ticker' ),
		'featured_image'        => __( 'Featured Image', 'simple-posts-ticker' ),
		'set_featured_image'    => __( 'Set featured image', 'simple-posts-ticker' ),
		'remove_featured_image' => __( 'Remove featured image', 'simple-posts-ticker' ),
		'use_featured_image'    => __( 'Use as featured image', 'simple-posts-ticker' ),
		'insert_into_item'      => __( 'Insert into ticker', 'simple-posts-ticker' ),
		'uploaded_to_this_item' => __( 'Uploaded to this ticker', 'simple-posts-ticker' ),
		'items_list'            => __( 'Tickers list', 'simple-posts-ticker' ),
		'items_list_navigation' => __( 'Tickers list navigation', 'simple-posts-ticker' ),
		'filter_items_list'     => __( 'Filter tickers list', 'simple-posts-ticker' ),
	);
	$args = array(
		'label'                 => __( 'Ticker', 'simple-posts-ticker' ),
		'description'           => __( 'Frontend Tickers', 'simple-posts-ticker' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'excerpt', 'author' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
    register_post_type( 'spt_ticker', $args );

}