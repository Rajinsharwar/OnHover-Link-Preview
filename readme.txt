=== OnHover Link Preview ===
Plugin Name: OnHover Link Preview
Description: WordPress plugin for showing the link preview on mouse-hover. Keep your visitors and readers engaged on your blog.
Author: Rajin Sharwar
Author URI: https://profiles.wordpress.org/rajinsharwar
Tags: links, link preview, embeds, blog, mshots, free
Requires at least: 5.9
Tested up to: 6.3.2
Stable tag: 1.0
Requires PHP: 5.6

== Description ==

OnHover Link Preview plugin automatically adds link preview pop-ups so visitors can see the preview of the hyperlink without leaving your website, and just hovering over the link.

Whether users are reading your blog or webpage, they can get a preview of the linked content and get a peak of the preview of the webpage refered.

* Link auto-previews popups work on all types of hyperlinks, under the "entry-content" div class.
* Excludes the header, footer, nav-menu links etc.
* Excludes any Images with a link (<img> tag).
* No code easy one-click installation.
* Easily specify which Elements, Classes, or IDs of the website to exclude from showing auto-previews.

This plugin uses "mShots" as a third party service to get the previews. mshots is a Website Thumbnail/Snapshot Service from Automattic licenced GPL-2.0. No data of your's or your website, is being sent or shared with mShots. You can find it's licence and policy details from the below URL:
https://github.com/Automattic/mShots/blob/master/LICENSE

== Frequently Asked Questions ==

= Can I use this plugin for free? =

Yes, absolutely! You can use this plugin free of cost, without any sort of restrictions or pricing.

= I don't like the current preview box's style. =

You can change the styling/design of the preview box easily by applying styles in the ".on-hover-link-prev" class. You can change the background colour, padding, body-shadow etc. If even after applying styles doesn't reflect any changes, try using the "!important" property.

= How can I exclude the preview from certain pages? =

Currently, it's not possible to exclude the preview from certain pages. But, you can exclude the preview in specific Elements (Ex: h1, h2 ), Classes (Ex: .class1, .another-class ) or even specific IDs (Ex: #my-id, #id1).

= Will this plugin's functionality slow my pages down? =

Seemingly impossible! Only one JS file is being loaded on the frontend, which is a minified version, having a size of 1.13 KB. And the request to get the previews are loaded on hover, means, it will not have any impact of the TTFB or the first contentful paint. The previews are cached as well, to avoid sending multiple preview requests.

== Installation ==
From within WordPress' dashboard:

1. Go to Plugins -> Add New
2. Search for "OnHover Link Preview".
3. Click "Install".
4. Click "Activate".
5. Now the on mouse-hover link previews will be shown.
6. Navigate under the Link Preview menu to configure addiotional settings for the plugin.

== Screenshots ==

1. Frontend
2. Backend.

== Changelog ==

= 1.0 =
* Initial Commit.
