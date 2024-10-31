=== Product Sorting for EDD ===
Contributors: Catapult_Themes
Donate Link: https://www.paypal.me/catapultthemes
Tags: EDD, Easy Digital Downloads, ecommerce
Requires at least: 4.7
Tested up to: 4.8
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Sort your EDD products by price, title, popularity etc

== Description ==
There's no means for users to sort products on Easy Digital Downloads pages. This plugin adds a dropdown field that lets your customers sort products by whichever parameter they like. The default parameters are:
* Newness (latest first)
* Newness (oldest first)
* Title (A to Z)
* Title (Z to A)
* Price (lowest to highest)
* Price (highest to lowest)

Note: this works with the EDD `[downloads]` shortcode. It doesn't, currently, work with download archive pages. For more information on using the `[downloads]` shortcode, take a look at [this article on the EDD site](http://docs.easydigitaldownloads.com/article/224-downloads).

= Settings? =
There aren't any settings (at the moment). Once activated, the plugin automatically adds the product sorting dropdown to any page where you've added the EDD `[downloads]` shortcode. To turn it off, just deactivate the Product Sorting plugin. I will hopefully get round to adding some simple settings in a future release.

= Filters =
There are two filters you should know about if you want to extend the plugin:
sp_edd_filter_orderby_params - allows you to add or remove the existing sort parameters
sp_edd_filter_styles - allows you to change the styles applied to the select field

Take a look at the `functions-sp-edd.php` file for more information.

== Installation ==
1. Upload the `product-sorting-for-edd` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add your widgets

== Frequently Asked Questions ==

== Screenshots ==

1. 

== Changelog ==

= 1.0.0 =

* Initial commit

== Upgrade Notice ==

Nothing here
