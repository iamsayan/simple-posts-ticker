<?php

/**
 * @package   Simple Posts Ticker
 * @author    Sayan Datta
 * @since     v1.1.1
 * @license   http://www.gnu.org/licenses/gpl.html
 *
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */

add_action( 'add_meta_boxes', 'spt_add_meta_boxes_to_post_edit_screen' );
add_action( 'save_post', 'spt_save_meta_boxes_data', 10, 2 );

function spt_add_meta_boxes_to_post_edit_screen( $post ) {
    // If user can't publish posts, then do not show meta box
    if ( ! current_user_can( 'publish_posts' ) ) return;

    add_meta_box( 'spt_custom_code_meta_box', __( 'Custom URL', 'remove-wp-meta-tags' ), 'spt_meta_box_callback', 'spt_ticker', 'normal', 'high' );
}

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function spt_meta_box_callback( $post ) {
    // make sure the form request comes from WordPress
    wp_nonce_field( 'spt_meta_box_build_nonce', 'spt_meta_box_nonce' );
    // retrieve post id
    $urlboxMeta = get_post_meta( $post->ID, '_spt_ticker_custom_link', true );
    $url = isset( $urlboxMeta ) ? esc_url( $urlboxMeta ) : ''; ?>

    <div style="margin-bottom: -12px;">
        <p class="meta-options">
            <input id="spt_disable_header_status" type="url" name="spt_ticker_custom_link" value="<?php echo $url; ?>" style="width:100%;" />
        </p>
    </div>
<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function spt_save_meta_boxes_data( $post_id ) {
    // verify taxonomies meta box nonce
	if ( ! isset( $_POST['spt_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['spt_meta_box_nonce'], 'spt_meta_box_build_nonce' ) ) {
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
    }
    // store custom fields
    if( isset( $_POST['spt_ticker_custom_link'] ) ) {
        if( empty( $_POST['spt_ticker_custom_link'] ) ) {
            delete_post_meta( $post_id, '_spt_ticker_custom_link' );
        } else {
            update_post_meta( $post_id, '_spt_ticker_custom_link', esc_url( $_POST['spt_ticker_custom_link'] ) );
        }
    }
}

?>