<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Simple Posts Ticker
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */
?>

<div class="wrap">
    <div class="head-wrap">
        <h1 class="title">Simple Posts Ticker<span class="title-count"><?php echo SPT_PLUGIN_VERSION ?></span></h1>
        <div><?php _e( 'Simple Posts Ticker is a small tool that shows your most recent posts in a marquee style.', 'simple-posts-ticker' ); ?></div><hr>
        <div class="top-sharebar">
            <a class="share-btn rate-btn" href="https://wordpress.org/support/plugin/simple-posts-ticker/reviews/?filter=5#new-post" target="_blank" title="<?php _e( 'Please rate 5 stars if you like Simple Posts Ticker', 'simple-posts-ticker' ); ?>"><span class="dashicons dashicons-star-filled"></span> <?php _e( 'Rate 5 stars', 'simple-posts-ticker' ); ?></a>
            <a class="share-btn twitter" href="https://twitter.com/intent/tweet?text=Check%20out%20Simple%20Posts%20Ticker,%20a%20%23WordPress%20%23plugin%20that%20shows%20your%20most%20recent%20posts%20in%20a%20marquee%20style%20ticker%20easily.&tw_p=tweetbutton&url=https%3A//wordpress.org/plugins/simple-posts-ticker/&via=im_sayaan" target="_blank"><span class="dashicons dashicons-twitter"></span> <?php _e( 'Tweet about Simple Posts Ticker', 'simple-posts-ticker' ); ?></a>
        </div>
    </div>
    <div id="nav-container" class="nav-tab-wrapper">
        <a href="#post" class="nav-tab active" id="btn1"><span class="dashicons dashicons-admin-post" style="padding-top: 2px;"></span> <?php _e( 'Post Type', 'simple-posts-ticker' ); ?></a>
        <a href="#label" class="nav-tab" id="btn2"><span class="dashicons dashicons-edit" style="padding-top: 2px;"></span> <?php _e( 'Label', 'simple-posts-ticker' ); ?></a>
        <a href="#configure" class="nav-tab" id="btn3"><span class="dashicons dashicons-megaphone" style="padding-top: 2px;"></span> <?php _e( 'Ticker', 'simple-posts-ticker' ); ?></a>
        <a href="#styles" class="nav-tab" id="btn4"><span class="dashicons dashicons-admin-appearance" style="padding-top: 2px;"></span> <?php _e( 'Styles', 'simple-posts-ticker' ); ?></a>
        <a href="#others" class="nav-tab" id="btn5"><span class="dashicons dashicons-screenoptions" style="padding-top: 2px;"></span> <?php _e( 'Others', 'simple-posts-ticker' ); ?></a>
        <a href="#shortcode" class="nav-tab" id="btn6"><span class="dashicons dashicons-editor-code" style="padding-top: 2px;"></span> <?php _e( 'Shortcode', 'simple-posts-ticker' ); ?></a>
        <a href="#tools" class="nav-tab" id="btn7"><span class="dashicons dashicons-editor-help" style="padding-top: 2px;"></span> <?php _e( 'Tools', 'simple-posts-ticker' ); ?></a>
    </div>
    <script>
        var header = document.getElementById("nav-container");
        var btns = header.getElementsByClassName("nav-tab");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
            });
        }
    </script>
    <div id="poststuff" style="padding-top: 0;">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <form id="main-form" method="post" action="options.php">
                    <?php settings_fields('spt_plugin_settings_fields'); ?>
			        <div id="spt-post" class="postbox">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Post Type Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php do_settings_sections('spt_plugin_main_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings', 'spt-save-main' ); ?>
                        </div>
                    </div>
                    <div id="spt-label" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Label Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php do_settings_sections('spt_plugin_label_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings', 'spt-save-label' ); ?>
                        </div>
                    </div>
                    <div id="spt-configure" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Configure Ticker', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php do_settings_sections('spt_plugin_ticker_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings', 'spt-save-ticker' ); ?>
                        </div>
                    </div>
                    <div id="spt-display" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Customize Styles', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php do_settings_sections('spt_plugin_settings_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings', 'spt-save-option' ); ?>
                        </div>
                    </div>
                    <div id="spt-misc" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Miscellaneous Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php do_settings_sections('spt_plugin_misc_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings', 'spt-save-misc' ); ?>
                        </div>
                    </div>
                    <div id="spt-shortcode" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Shortcode Info', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
                        <div class="inside spt-inside" style="padding-bottom: 15px;">
                            <p><?php _e( 'You can show posts ticker anywhere by simply using the shortcode <code>[spt-posts-ticker]</code>. To enter the shortcode directly into templates using PHP, enter <code>echo do_shortcode(&#39;[spt-posts-ticker]&#39;);</code>', 'simple-posts-ticker' ); ?></p>
                            <p><?php _e( 'Use the options/attributes below to override the original settings.', 'simple-posts-ticker' ); ?></p>
                            <table>
                                <tr>
                                    <th><?php _e( 'Attributes', 'simple-posts-ticker' ); ?></th>
                                    <th><?php _e( 'Description', 'simple-posts-ticker' ); ?></th>
                                </tr>
                                <?php $items = array(
                                    'num_posts'                 => __( 'Number of posts to display, defaults to showing 5 most recent posts, use "-1" for all matching posts.', 'simple-posts-ticker' ),
                                    'post_type'                 => __( 'Choose the type of post to display, default to "post" for normal posts or select a custom post type by its slug.', 'simple-posts-ticker' ),
                                    'order_by'                  => __( 'Choose the orderby method to display, default to "date" or set "modified" or "random".', 'simple-posts-ticker' ),
                                    'order'                     => __( 'Set the post display order, default to "DESC" or set "ASC".', 'simple-posts-ticker' ),
                                    'category'                  => __( 'Choose the id of a category to limit the posts, use a comma to separate multiple categories, use "0" for all categories (default).', 'simple-posts-ticker' ),
                                    'category_name'             => __( 'Choose the name of a category to limit the posts, use a comma to separate multiple categories, defaults to none.', 'simple-posts-ticker' ),
                                    'include'                   => __( 'Choose the id of a post to include it in a ticker.', 'simple-posts-ticker' ),
                                    'exclude'                   => __( 'Choose the id of a post to exclude it from a ticker.', 'simple-posts-ticker' ),
                                    'show_label'                => __( 'Choose yes ot no to show/hide a label for the posts ticker.', 'simple-posts-ticker' ),
                                    'label_position'            => __( 'If a label is shown, set what text to use.', 'simple-posts-ticker' ),
                                    'label_text'                => __( 'If a label is shown, choose the font size of the text.', 'simple-posts-ticker' ),
                                    'label_text_size'           => __( 'If a label is shown, choose the font size of the text.', 'simple-posts-ticker' ),
                                    'label_margin'              => __( 'If a label is shown, set the label margin for the label area.', 'simple-posts-ticker' ),
                                    'label_padding'             => __( 'If a label is shown, set the label padding for the label area.', 'simple-posts-ticker' ),
                                    'label_colour'              => __( 'If a label is shown, choose what colour is the ticker label text.', 'simple-posts-ticker' ),
                                    'label_bg_colour'           => __( 'If a label is shown, choose what colour is the background.', 'simple-posts-ticker' ),
                                    'ticker_border'             => __( 'Choose the border type if you want to show a border. It can be "none" or "solid" or "dotted" or "dashed" or "double".', 'simple-posts-ticker' ),
                                    'ticker_border_width'       => __( 'If a label border is shown, choose the border width.', 'simple-posts-ticker' ),
                                    'ticker_border_radius'      => __( 'If a label border is shown, choose the border radius', 'simple-posts-ticker' ),
                                    'ticker_border_colour'      => __( 'If a label border is shown, choose the border colour.', 'simple-posts-ticker' ),
                                    'content_size'              => __( 'Choose the font size of the ticker content text.', 'simple-posts-ticker' ),
                                    'content_margin'            => __( 'Set the margin for the ticker content text.', 'simple-posts-ticker' ),
                                    'content_padding'           => __( 'Set the padding for the ticker content text.', 'simple-posts-ticker' ),
                                    'content_colour'            => __( 'Choose what colour is the ticker content text.', 'simple-posts-ticker' ),
                                    'content_bg_colour'         => __( 'Choose what colour is the background of the ticker content text.', 'simple-posts-ticker' ),
                                    'content_link_padding'      => __( 'Set the padding for the ticker content links.', 'simple-posts-ticker' ),
                                    'ticker_direction'          => __( 'Set the ticker direction from here. It can be "left" or "right".', 'simple-posts-ticker' ),
                                    'ticker_cflow'              => __( 'Set the ticker continuous flow from here. It can be "true" or "false".', 'simple-posts-ticker' ),
                                    'ticker_loop'               => __( 'Set the number of ticker to adaptive continuous flow from here. It can be any number starts from "1".', 'simple-posts-ticker' ),
                                    'ticker_pause'              => __( 'control the ticker mouse hover pause from here. It can be "true" or "false".', 'simple-posts-ticker' ),
                                    'ticker_duration'           => __( 'Duration in milliseconds in which you want your element to travel. Default: 5000.', 'simple-posts-ticker' ),
                                    'ticker_speed'              => __( 'Speed will override duration. Speed allows you to set a relatively constant marquee speed regardless of the width of the containing element. Speed is measured in pixels per second.', 'simple-posts-ticker' ),
                                    'ticker_visible'            => __( 'The marquee will be visible from the start if set to true, defaults to false.$ticker_visible', 'simple-posts-ticker' ),
                                    'ticker_delay'              => __( 'Time in milliseconds before the marquee starts animating. Default: 100.', 'simple-posts-ticker' ),
                                    'hyperlink'                 => __( 'Set the visibility of the hyperlinks. It can be "no", but defaults to "yes".', 'simple-posts-ticker' ),
                                    'target'                    => __( 'Choose the target for the links, can be "_self" or "_blank".', 'simple-posts-ticker' ),
                                    'no_follow'                 => __( 'Choose the rel for the links, default to "no" but can be "yes".', 'simple-posts-ticker' ),
                                    'post_info'                 => __( 'Choose which post info you want to show after post link. It can be "none" or "pub_date" or "mod_date" or "pub_author" or "mod_author" or "excerpt".', 'simple-posts-ticker' ),
                                    'post_info_position'        => __( 'Set the position of the post ticker info. It can be "left", but defaults to "right".', 'simple-posts-ticker' ),
                                    'post_info_colour'          => __( 'If the post info is shown, choose the colour of the post info.', 'simple-posts-ticker' ),
                                    'post_info_sep'             => __( 'If the post info is shown, choose the seperator between link and info.', 'simple-posts-ticker' ),
                                    'no_content'                => __( 'Set the text display action if no matching posts are found.', 'simple-posts-ticker' ),
                                    'no_content_text'           => __( 'Set the text to display if no matching posts are found.', 'simple-posts-ticker' ),
                                    'post_info_start'           => __( 'If the post info is shown, choose the before content of post info.', 'simple-posts-ticker' ),
                                    'post_info_end'             => __( 'If the post info is shown, choose the after content of post info.', 'simple-posts-ticker' ),
                                    'link_class'                => __( 'Set the custom CSS class name for each ticker links.', 'simple-posts-ticker' ),
                                    'css_class'                 => __( 'Set the custom CSS class name for each ticker.', 'simple-posts-ticker' ),
                                );
                                foreach( $items as $item => $desc ) {
                                    echo '<tr>';
                                        echo '<td align="center" class="spt-params"><strong>'.$item.'</strong></td>';
                                        echo '<td align="center" class="spt-desc">'.$desc.'</td>';
                                    echo '</tr>';
                                } ?>
                                </table>
                        </div>
                    </div>
                </form>
                <div id="spt-tools" class="postbox" style="display: none;">
				    <h3 class="hndle spt-hndle">
                        <span class="spt-heading">
                            <?php _e( 'Plugin Tools', 'simple-posts-ticker' ); ?>
                        </span>
                    </h3>
				    <div class="inside spt-inside" style="padding-bottom: 15px;">
                        <div>
                            <span><strong><?php _e( 'Export Settings', 'simple-posts-ticker' ); ?></strong></span>
		    	        	<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', 'simple-posts-ticker' ); ?></p>
		    	        	<form method="post">
		    	        		<p><input type="hidden" name="spt_export_action" value="spt_export_settings" /></p>
		    	        		<p>
		    	        			<?php wp_nonce_field( 'spt_export_nonce', 'spt_export_nonce' ); ?>
		    	        			<?php submit_button( __( 'Export Settings', 'simple-posts-ticker' ), 'secondary', 'spt-export', false ); ?>
		    	        		</p>
		    	        	</form>
                        </div><hr>
                        <div>
                            <span><strong><?php _e( 'Import Settings', 'simple-posts-ticker' ); ?></strong></span>
		    	        	<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', 'simple-posts-ticker' ); ?></p>
		    	        	<form method="post" enctype="multipart/form-data">
		    	        		<p><input type="file" name="import_file" accept=".json"/></p>
		    	        		<p>
		    	        			<input type="hidden" name="spt_import_action" value="spt_import_settings" />
		    	        			<?php wp_nonce_field( 'spt_import_nonce', 'spt_import_nonce' ); ?>
		    	        			<?php submit_button( __( 'Import Settings', 'simple-posts-ticker' ), 'secondary', 'spt-import', false ); ?>
		    	        		</p>
		    	        	</form>
                        </div><hr>
                        <div>
                            <span><strong><?php _e( 'Reset Settings', 'simple-posts-ticker' ); ?></strong></span>
		    	        	<p style="color:red"><strong><?php _e( 'WARNING:', 'simple-posts-ticker' ); ?> </strong><?php _e( 'Resetting will delete all custom options to the default settings of the plugin in your database.', 'simple-posts-ticker' ); ?></p>
		    	        	<form method="post">
		    	        		<p><input type="hidden" name="spt_reset_action" value="spt_reset_settings" /></p>
	                            <p>
		    	        			<?php wp_nonce_field( 'spt_reset_nonce', 'spt_reset_nonce' ); ?>
		    	        			<?php submit_button( __( 'Reset Settings', 'simple-posts-ticker' ), 'secondary', 'spt-reset', false ); ?>
		    	        	    </p>
		    	        	</form>
                        </div>
                    </div>
                </div>
                <div class="coffee-box">
                    <div class="coffee-amt-wrap">
                        <p><select class="coffee-amt">
                            <option value="5usd">$5</option>
                            <option value="6usd">$6</option>
                            <option value="7usd">$7</option>
                            <option value="8usd">$8</option>
                            <option value="9usd">$9</option>
                            <option value="10usd" selected="selected">$10</option>
                            <option value="11usd">$11</option>
                            <option value="12usd">$12</option>
                            <option value="13usd">$13</option>
                            <option value="14usd">$14</option>
                            <option value="15usd">$15</option>
                            <option value=""><?php _e( 'Custom', 'simple-posts-ticker' ); ?></option>
                        </select></p>
                        <a class="button button-primary buy-coffee-btn" style="margin-left: 2px;" href="https://www.paypal.me/iamsayan/10usd" data-link="https://www.paypal.me/iamsayan/" target="_blank"><?php _e( 'Buy me a coffee!', 'simple-posts-ticker' ); ?></a>
                    </div>
                    <span class="coffee-heading"><?php _e( 'Buy me a coffee!', 'simple-posts-ticker' ); ?></span>
                    <p style="text-align: justify;"><?php printf( __( 'Thank you for using %s. If you found the plugin useful buy me a coffee! Your donation will motivate and make me happy for all the efforts. You can donate via PayPal.', 'simple-posts-ticker' ), '<strong>Simple Posts Ticker v' . SPT_PLUGIN_VERSION . '</strong>' ); ?></strong></p>
                    <p style="text-align: justify; font-size: 12px; font-style: italic;">Developed with <span style="color:#e25555;">♥</span> by <a href="https://sayandatta.in" target="_blank" style="font-weight: 500;">Sayan Datta</a> | <a href="mailto:iamsayan@pm.me" target="_blank" style="font-weight: 500;">Hire Me</a> | <a href="https://github.com/iamsayan/simple-posts-ticker" target="_blank" style="font-weight: 500;">GitHub</a> | <a href="https://wordpress.org/support/plugin/simple-posts-ticker" target="_blank" style="font-weight: 500;">Support</a> | <a href="https://wordpress.org/support/plugin/simple-posts-ticker/reviews/?filter=5#new-post" target="_blank" style="font-weight: 500;">Rate it</a> (<span style="color:#ffa000;">&#9733;&#9733;&#9733;&#9733;&#9733;</span>) on WordPress.org, if you like this plugin.</p>
                </div>
                <div id="progressMessage" class="progressModal" style="display:none;">
                    <?php _e( 'Please wait...', 'simple-posts-ticker' ); ?>
                </div>
                <div id="saveMessage" class="successModal" style="display:none;">
                    <p class="spt-success-msg">
                        <?php _e( 'Settings Saved Successfully!', 'simple-posts-ticker' ); ?>
                    </p>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        $('#main-form').submit(function() {
                            $('#progressMessage').show();
                            $(".save-settings").addClass("disabled");
                            $(".save-settings").val("<?php _e( 'Saving...', 'simple-posts-ticker' ); ?>");
                            $(this).ajaxSubmit({
                                success: function() {
                                    $('#progressMessage').fadeOut();
                                    $('#saveMessage').show().delay(4000).fadeOut();
                                    $(".save-settings").removeClass("disabled");
                                    $(".save-settings").val("<?php _e( 'Save Settings', 'simple-posts-ticker' ); ?>");
                                }
                            });
                            return false;
                        });
                    });
                </script>
            </div>
            <div id="postbox-container-1" class="postbox-container">
                <div class="postbox">
                    <h3 class="hndle spt-hndle" style="text-align: center;"><?php _e( 'My Other Plugins!', 'simple-posts-ticker' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-clock"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/wp-last-modified-info/" target="_blank">WP Last Modified Info</a>: </strong>
                                <?php _e( 'Display last update date and time on frontend with \'dateModified\' Schema Markup.', 'simple-posts-ticker' ); ?>
                            </label>
                        </div>
                        <hr>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-update"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/wp-auto-republish/" target="_blank">RevivePress</a>: </strong>
                                <?php _e( 'Automatically republish you old evergreen content to grab better SEO.', 'simple-posts-ticker' ); ?>
                            </label>
                        </div>
                        <hr>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-admin-comments"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/ultimate-facebook-comments/" target="_blank">Ultimate Social Comments</a>: </strong>
                                <?php _e( 'Ultimate Facebook Comment Solution with instant email notification for any WordPress Website.', 'simple-posts-ticker' ); ?>
                            </label>
                        </div>
                        <hr>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-admin-links"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/change-wp-page-permalinks/" target="_blank">WP Page Permalink Extension</a>: </strong>
                                <?php _e( 'Add any page extension like .html, .php, .aspx, .htm, .asp, .shtml only to pages.', 'simple-posts-ticker' ); ?>
                            </label>
                        </div>
                        <hr>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/remove-wp-meta-tags/" target="_blank">Easy Header Footer</a>: </strong>
                                <?php _e( 'Add custom code and remove the unwanted meta tags, links from the source code and many more.', 'simple-posts-ticker' ); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </diV>
        </div>
    </div>
</div>