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
            <a class="share-btn rate-btn" href="https://wordpress.org/support/plugin/simple-posts-ticker/reviews/?filter=5#new-post" target="_blank" title="Please rate 5 stars if you like Simple Posts Ticker"><span class="dashicons dashicons-star-filled"></span> Rate 5 stars</a>
            <a class="share-btn twitter" href="https://twitter.com/home?status=Check%20out%20Simple%20Posts%20Ticker,%20a%20%23WordPress%20%23plugin%20that%20shows%20your%20most%20recent%20posts%20in%20a%20marquee%20style%20ticker%20easily.%20https%3A//wordpress.org/plugins/simple-posts-ticker/%20via%20%40im_sayaan" target="_blank"><span class="dashicons dashicons-twitter"></span> Tweet about Simple Posts Ticker</a>
        </div>
    </div>
    <div id="nav-container" class="nav-tab-wrapper">
        <a href="#post" class="nav-tab active" id="btn1"><span class="dashicons dashicons-admin-post" style="padding-top: 2px;"></span> <?php _e( 'Post', 'simple-posts-ticker' ); ?></a>
        <a href="#label" class="nav-tab" id="btn2"><span class="dashicons dashicons-edit" style="padding-top: 2px;"></span> <?php _e( 'Label', 'simple-posts-ticker' ); ?></a>
        <a href="#display" class="nav-tab" id="btn3"><span class="dashicons dashicons-visibility" style="padding-top: 2px;"></span> <?php _e( 'Display', 'simple-posts-ticker' ); ?></a>
        <a href="#others" class="nav-tab" id="btn4"><span class="dashicons dashicons-screenoptions" style="padding-top: 2px;"></span> <?php _e( 'Others', 'simple-posts-ticker' ); ?></a>
        <a href="#shortcode" class="nav-tab" id="btn5"><span class="dashicons dashicons-editor-code" style="padding-top: 2px;"></span> <?php _e( 'Shortcode', 'simple-posts-ticker' ); ?></a>
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
			        <div id="spt-post" class="postbox">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Post Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php settings_fields('spt_plugin_settings_fields'); ?>
                            <?php do_settings_sections('spt_plugin_main_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings' ); ?>
                        </div>
                    </div>
                    <div id="spt-label" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Label Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php settings_fields('spt_plugin_settings_fields'); ?>
                            <?php do_settings_sections('spt_plugin_label_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings' ); ?>
                        </div>
                    </div>
                    <div id="spt-display" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Display Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php settings_fields('spt_plugin_settings_fields'); ?>
                            <?php do_settings_sections('spt_plugin_settings_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings' ); ?>
                        </div>
                    </div>
                    <div id="spt-misc" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Miscellaneous Options', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside">
                            <?php settings_fields('spt_plugin_settings_fields'); ?>
                            <?php do_settings_sections('spt_plugin_misc_option'); ?>
                            <?php submit_button( __( 'Save Settings', 'simple-posts-ticker' ), 'primary save-settings' ); ?>
                        </div>
                    </div>
                    <div id="spt-shortcode" class="postbox" style="display: none;">
				        <h3 class="hndle spt-hndle">
                            <span class="spt-heading">
                                <?php _e( 'Shortcode Info', 'simple-posts-ticker' ); ?>
                            </span>
                        </h3>
				        <div class="inside spt-inside" style="padding-bottom: 30px;">
                            <p>You can show posts ticker anywhere by simply using the shortcode <code>[spt-posts-ticker]</code>. To enter the shortcode directly into templates using PHP, enter <code>echo do_shortcode('[spt-posts-ticker]');</code></p>
                            <p>Use the options/attributes below to override the original settings.</p>
                            <li><strong>num_posts</strong> - number of posts to display, defaults to showing 5 most recent posts, use "-1" for all matching posts</li>
                            <li><strong>post_type</strong> -  choose the type of post to display, default to "post" for normal posts or select a custom post type by its slug</li>
                            <li><strong>order_by</strong> - choose the orderby method to display, default to "date" or set "modified" or "random"</li>
                            <li><strong>order</strong> - set the post display order, default to "DESC" or set "ASC"</li>
                            <li><strong>category</strong> - choose the id of a category to limit the posts, use a comma to separate multiple categories, use "0" for all categories (default)</li>
                            <li><strong>show_label</strong> - choose yes ot no to show/hide a label for the posts ticker</li>
                            <li><strong>label_text</strong> - if a label is shown, set what text to use</li>
                            <li><strong>label_text_size</strong> - if a label is shown, choose the font size of the text</li>
                            <li><strong>label_text_colour</strong> - if a label is shown, choose what colour is the text</li>
                            <li><strong>label_bg_colour</strong> - if a label is shown, choose what colour is the background</li>
                            <li><strong>label_border</strong> - choose the border type if you want to show a border. It can be "none" or "solid" or "dotted" or "dashed" or "double"</li>
                            <li><strong>label_border_width</strong> - if a label border is shown, choose the border width</li>
                            <li><strong>label_border_radius</strong> - if a label border is shown, choose the border radius</li>
                            <li><strong>label_border_colour</strong> - if a label border is shown, choose the border colour</li>
                            <li><strong>size</strong> - set the size of the text, can be in px or em or %</li>
                            <li><strong>speed</strong> - set the speed to scroll by, in pixels per second</li>
                            <li><strong>target</strong> - choose the target for the links, can be "_self" or "_blank"</li>
                            <li><strong>no_follow</strong> - choose the rel for the links, default to "no" but can be "yes"</li>
                            <li><strong>colour</strong> - choose what the colour is for the ticker</li>
                            <li><strong>bg_colour</strong> - choose what colour is the background for the ticker</li>
                            <li><strong>margin</strong> - set the margin for the posts ticker</li>
                            <li><strong>padding</strong> - set the padding for the posts ticker</li>
                            <li><strong>infinite_scroll</strong> - choose whether to infinite scroll the marquee content, defaults to "false", set to "true" for infinite scrolling</li>
                            <li><strong>post_info</strong> - choose which post info you want to show after post link. It can be "none" or "pub_date" or "mod_date" or "pub_author" or "mod_author" or "excerpt"</li>
                            <li><strong>post_info_colour</strong> - if the post info is shown, choose the colour of the post info</li>
                            <li><strong>post_info_sep</strong> - if the post info is shown, choose the seperator between link and info</li>
                            <li><strong>no_content_text</strong> - set the text to display if no matching posts are found</li>
                            <p>Here's an example of using the shortcode with attributes:<br><code>[spt-posts-ticker num_posts="5" post_type="page" order_by="modified" order="DESC" category="1,29,45" show_label="yes" label_text="Latest Posts" label_text_size="12px" label_text_colour="#ffffff" label_bg_colour="#1e73be" label_border="solid" label_border_width="3px" label_border_radius="15px" label_border_colour="#ffffff" size="100%" speed="100" target="_self" no_follow="yes" colour="#ffffff" bg_colour="#ffffff" margin="2px 0" padding="0 10px" post_info="pub_date" post_info_colour="#ffffff" post_info_sep=" - " infinite_scroll="true" no_content_text="No matching posts"]</code></p>
                            <p>You can also insert the shortcode with attributes directly into your theme with PHP:<br><code>&lt;?php echo do_shortcode('[spt-posts-ticker num_posts="5" post_type="page" order_by="modified" order="DESC" category="1,29,45" show_label="yes" label_text="Latest Posts" label_text_size="12px" label_text_colour="#ffffff" label_bg_colour="#1e73be" label_border="solid" label_border_width="3px" label_border_radius="15px" label_border_colour="#ffffff" size="100%" speed="100" target="_self" no_follow="yes" colour="#ffffff" bg_colour="#ffffff" margin="2px 0" padding="0 10px" post_info="pub_date" post_info_colour="#ffffff" post_info_sep=" - " infinite_scroll="true" no_content_text="No matching posts"]'); ?&gt;</code></p>
                        </div>
                    </div>
                    <div class="coffee-box">
                        <div class="coffee-amt-wrap">
                            <p><select class="coffee-amt">
                                <option value="2usd">$2</option>
                                <option value="3usd">$3</option>
                                <option value="4usd">$4</option>
                                <option value="5usd" selected="selected">$5</option>
                                <option value="6usd">$6</option>
                                <option value="7usd">$7</option>
                                <option value="8usd">$8</option>
                                <option value="9usd">$9</option>
                                <option value="10usd">$10</option>
                                <option value="11usd">$11</option>
                                <option value="12usd">$12</option>
                                <option value="">Custom</option>
                            </select></p>
                            <a class="button button-primary buy-coffee-btn" href="https://www.paypal.me/iamsayan/5usd" data-link="https://www.paypal.me/iamsayan/" target="_blank">Buy me a coffee!</a>
                        </div>
                        <span class="coffee-heading">Buy me a coffee!</span>
                        <p style="text-align: justify;">Thank you for using <strong>Simple Posts Ticker v<?php echo SPT_PLUGIN_VERSION ?></strong>. If you found the plugin useful buy me a coffee! Your donation will motivate and make me happy for all the efforts. You can donate via PayPal.</p>
                        <p style="text-align: justify; font-size: 12px; font-style: italic;">Developed with <span style="color:#e25555;">♥</span> by <a href="https://profiles.wordpress.org/infosatech/" target="_blank" style="font-weight: 500;">Sayan Datta</a> | <a href="https://github.com/iamsayan/simple-posts-ticker" target="_blank" style="font-weight: 500;">GitHub</a> | <a href="https://wordpress.org/support/plugin/simple-posts-ticker" target="_blank" style="font-weight: 500;">Support</a> | <a href="https://wordpress.org/support/plugin/simple-posts-ticker/reviews/?filter=5#new-post" target="_blank" style="font-weight: 500;">Rate it</a> (<span style="color:#ffa000;">&#9733;&#9733;&#9733;&#9733;&#9733;</span>) on WordPress.org, if you like this plugin.</p>
                    </div>
                    <div id="progressMessage" class="progressModal" style="display:none;">
                        <?php _e( 'Please wait...', 'simple-posts-ticker' ); ?>
                    </div>
                    <div id="saveMessage" class="successModal" style="display:none;">
                        <p class="spt-success-msg">
                            <?php _e( 'Settings Saved Successfully!', 'simple-posts-ticker' ); ?>
                        </p>
                    </div>
                </form>
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
                    <h3 class="hndle spt-hndle" style="text-align: center;">My Other Plugins!</h3>
                    <div class="inside">
                        <div class="spt-misc-pub-section">
                            <span class="dashicons dashicons-clock"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/wp-last-modified-info/" target="_blank">WP Last Modified Info</a>: </strong>
                                Display last updated info on pages and posts very easily with 'dateModified' Schema Markup.
                            </label>
                        </div>
                        <hr>
                        <div class="spt-misc-pub-section">
                            <span class="dashicons dashicons-admin-comments"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/ultimate-facebook-comments/" target="_blank">Ultimate Facebook Comments</a>: </strong>
                                Ultimate Facebook Comment Solution with instant email notification.
                            </label>
                        </div>
                        <hr>
                        <div class="spt-misc-pub-section">
                            <span class="dashicons dashicons-admin-links"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/change-wp-page-permalinks/" target="_blank">WP Page Permalink Extension</a>: </strong>
                                Add any page extension like .html, .php, .aspx, .htm, .asp, .shtml only to wordpress pages.
                            </label>
                        </div>
                        <hr>
                        <div class="spt-misc-pub-section">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/wp-auto-republish/" target="_blank">WP Auto Republish</a>: </strong>
                                Automatically republish you old evergreen content to grab better SEO.
                            </label>
                        </div>
                        <hr>
                        <div class="spt-misc-pub-section">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <label>
                                <strong><a href="https://wordpress.org/plugins/remove-wp-meta-tags/" target="_blank">Easy Header Footer</a>: </strong>
                                Customize WP header, add custom code and enable, disable or remove the unwanted meta tags, links from the source code and many more.
                            </label>
                        </div>
                    </div>
                </div>
            </diV>
        </div>
    </div>
</div>