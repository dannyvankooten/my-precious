=== My Precious ===
Contributors: Ibericode, DvanKooten, hchouhan, lapzor
Tags: privacy, data
Requires at least: 4.9
Tested up to: 4.9
Stable tag: 2.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Stops leaking of sensitive information to WordPress.org.

== Description ==

#### My Precious

By default, WordPress.org collects data on your site like the number of users your site has, the PHP version your server is running among other stuff.

This plugins strips off sensitive data that we think should not be collected, like your site URL & the number of your users your site has.
This is your data and yours alone and more importantly, you should have a choice in whether this should be collected at all.

For more information, please see [Trac ticket #16778](https://core.trac.wordpress.org/ticket/16778).


**What data is stripped?**

The following request data will be stripped off from all requests to `api.wordpress.org`:

- Your site URL
- Number of users


**Server Requirements**

- PHP version 5.3 or later


== Changelog ==

#### 2.0 - January 11, 2018

Dedicated filter is used to strip number of users - requires WordPress 4.9 or newer.

#### 1.0 - December 7, 2016

Initial release.

