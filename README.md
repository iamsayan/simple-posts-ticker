![alt text](https://github.com/iamsayan/simple-posts-ticker/raw/master/banner.png "Plugin Banner")

# Simple Posts Ticker

The Simple Posts Ticker plugin is a small tool that shows your most recent posts in a marquee style.

[![WP compatibility](https://plugintests.com/plugins/simple-posts-ticker/wp-badge.svg)](https://plugintests.com/plugins/simple-posts-ticker/latest) [![PHP compatibility](https://plugintests.com/plugins/simple-posts-ticker/php-badge.svg)](https://plugintests.com/plugins/simple-posts-ticker/latest)

## Description

The Simple Posts Ticker plugin brings a lightweight, flexible and easy way to configure news ticker plugin to WordPress website. This plugin adds scrolling horizontal posts tickers to your site. It can be use as shortcode or PHP codes. You can customize every setting of this plugin in the admin dashboard.

### Advantage of this plugin

* Lightweight jQuery.
* Easy to configuration.
* Custom Post Types support.
* Select post by date/modified date or randomly.
* Select posts by their category.
* Option to show a label before ticker.
* Option to customize all and everything.
* Supports localization.

Like Simple Posts Ticker plugin? Consider leaving a [5 star review](https://wordpress.org/support/plugin/simple-posts-ticker/reviews/?rate=5#new-post).

### Shortcode instructions

Using default settings: **[spt-posts-ticker]**

Use the options/attributes below to override the original settings.

* **num_posts** - number of posts to display, defaults to showing 5 most recent posts, use "-1" for all matching posts
* **post_type** - choose the type of post to display, default to "post" for normal posts or select a custom post type by its slug
* **order_by** - choose the orderby method to display, default to "date" or set "modified" or "random"
* **order** - set the post display order, default to "DESC" or set "ASC"
* **category** - choose the id of a category to limit the posts, use a comma to separate multiple categories, use "0" for all categories (default)
* **category_name** - choose the name of a category to limit the posts, use a comma to separate multiple categories, defaults to none
* **show_label** - choose yes ot no to show/hide a label for the posts ticker
* **label_text** - if a label is shown, set what text to use
* **label_text_size** - if a label is shown, choose the font size of the text
* **label_text_colour** - if a label is shown, choose what colour is the text
* **label_bg_colour** - if a label is shown, choose what colour is the background
* **label_border** - choose the border type if you want to show a border. It can be "none" or "solid" or "dotted" or "dashed" or "double"
* **label_border_width** - if a label border is shown, choose the border width
* **label_border_radius** - if a label border is shown, choose the border radius
* **label_border_colour** - if a label border is shown, choose the border colour
* **size** - set the size of the text, can be in px or em or %
* **speed** - set the speed to scroll by, in pixels per second
* **target** - choose the target for the links, can be "_self" or "_blank"
* **no_follow** - choose the rel for the links, default to "no" but can be "yes"
* **colour** - choose what the colour is for the ticker
* **bg_colour** - choose what colour is the background for the ticker
* **margin** - set the margin for the posts ticker
* **padding** - set the padding for the posts ticker
* **infinite_scroll** - choose whether to infinite scroll the marquee content, defaults to "false", set to "true" for infinite scrolling
* **post_info** - choose which post info you want to show after post link. It can be "none" or "pub_date" or "mod_date" or "pub_author" or "mod_author" or "excerpt"
* **post_info_colour** - if the post info is shown, choose the colour of the post info
* **post_info_sep** - if the post info is shown, choose the seperator between link and info
* **post_info_start** - if the post info is shown, choose the before content of post info
* **post_info_end** - if the post info is shown, choose the after content of post info
* **no_content** - set the text display status if no matching posts are found
* **no_content_text** - set the text to display if no matching posts are found

#### Compatibility

* This plugin is fully compatible with WordPress Version 3.5 and beyond and also compatible with any WordPress theme.

#### Support

* Community support via the [support forums](https://wordpress.org/support/plugin/simple-posts-ticker) at WordPress.org.

#### Contribute
* Active development of this plugin is handled [on GitHub](https://github.com/iamsayan/simple-posts-ticker).
* Feel free to [fork the project on GitHub](https://github.com/iamsayan/simple-posts-ticker) and submit your contributions via pull request.

## Installation

### From within WordPress
1. Visit 'Plugins > Add New'.
1. Search for 'Simple Posts Ticker'.
1. Activate WP Last Modified Info from your Plugins page.
1. Go to "after activation" below.

### Manually
1. Upload the `simple-posts-ticker` folder to the `/wp-content/plugins/` directory.
1. Activate Simple Posts Ticker plugin through the 'Plugins' menu in WordPress.
1. Go to "after activation" below.

### After activation
1. After activation go to 'Settings > Simple Posts Ticker'.
1. Enable/disable options and save changes.

### Frequently Asked Questions

#### How to add this to your site?

If you want to add this somewhere else on your site, like header, footer, sidebar, etc, then probably the easiest way is to go to Appearance, Widgets, and place a text widget somewhere in your layout, and use the shortcode in that.

#### Is this plugin support custom post types?

Yes. this plugin automatically detects all custom post types and shows all of them as a drop down in plugin settings. You need to just select it from plugin settings.

## Changelog ##
[View Changelog](CHANGELOG.md)
