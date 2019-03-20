=== Simple Posts Ticker ===
Contributors: Infosatech
Tags: marquee, posts ticker, jQuery posts ticker, news headlines, news ticker
Requires at least: 4.0
Tested up to: 5.1
Stable tag: 1.0.3
Requires PHP: 5.6
Donate link: http://bit.ly/2I0Gj60
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

The Simple Posts Ticker plugin is a small tool that shows your most recent posts in a marquee style.

== Description ==

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

Using default settings: `[spt-posts-ticker]`

Use the options/attributes below to override the original settings.

* **num_posts** - number of posts to display, defaults to showing 5 most recent posts, use "-1" for all matching posts
* **post_type** - choose the type of post to display, default to "post" for normal posts or select a custom post type by its slug
* **order_by** - choose the orderby method to display, default to "date" or set "modified" or "random"
* **order** - set the post display order, default to "DESC" or set "ASC"
* **category** - choose the id of a category to limit the posts, use a comma to separate multiple categories, use "0" for all categories (default)
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
* **no_content_text** - set the text to display if no matching posts are found

#### Compatibility

* This plugin is fully compatible with WordPress Version 4.0 and beyond and also compatible with any WordPress theme.

#### Support

* Community support via the [support forums](https://wordpress.org/support/plugin/simple-posts-ticker) at WordPress.org.

#### Contribute
* Active development of this plugin is handled [on GitHub](https://github.com/iamsayan/simple-posts-ticker/).
* Feel free to [fork the project on GitHub](https://github.com/iamsayan/simple-posts-ticker/) and submit your contributions via pull request.

== Installation ==

1. Visit 'Plugins > Add New'
1. Search for 'Simple Posts Ticker' and install it.
1. Or you can upload the `simple-posts-ticker` folder to the `/wp-content/plugins/` directory manually.
1. Activate Simple Posts Ticker from your Plugins page.
1. After activation go to 'Settings > Simple Posts Ticker'.
1. Configure settings according to your need and save changes.

== Frequently Asked Questions ==

= How to add this to your site? =

If you want to add this somewhere else on your site, like header, footer, sidebar, etc, then probably the easiest way is to go to Appearance, Widgets, and place a text widget somewhere in your layout, and use the shortcode in that.

= Is this plugin support custom post types? =

Yes. this plugin automatically detects all custom post types and shows all of them as a drop down in plugin settings. You need to just select it from plugin settings.

== Screenshots ==

1. Ticker Demo
2. Post options
3. Label options
4. Display options
5. Others

== Changelog ==

= 1.0.3 =

* Added: A filter to run custom query.
* Fixed: Duplicate HTML Element warning in browser console on Admin Settings Page.
* Removed: Some unwanted code from plugin codebase.

= 1.0.2 =

* Fixed: Untranslated Strings.

= 1.0.1 =

* Added: Label Margin.
* Added: Label Border.
* Added: Post display order.
* Added: Link nofollow.
* Added: Ticker margin.
* Added: Ticker Padding.
* Added: Post Info after ticker.
* Improved: Admin UI.

= 1.0.0 =

* Initial release.