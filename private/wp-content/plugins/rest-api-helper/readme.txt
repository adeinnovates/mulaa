=== REST API Helper ===

Contributors: JasmanXcrew 
Donate link: http://ihsana.net/
Tags: rest-api,mobile app,ionic,json,json-api,cors, ionicframework,preflight,onesignal,acf
Requires at least: 4
Tested up to: 4
Stable tag: 1
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/license-list.html#GPLCompatibleLicenses

== Description ==
**Like this plugin? Please consider [leaving a 5-star review](https://wordpress.org/support/view/plugin-reviews/rest-api-helper).**
This plugin help REST API for display featured media source, author, categories, and custom fields. 
This plugin is made for [Ionic Mobile App Builder](https://goo.gl/qznlXo), suitable used for ionicframework. 
This plugin also support for display custom field in metabox and also make it allow crossorigin only for json files. Compatible with wp-restapi2 and json-api.

Features:
* Product listing without Woo API
* REST-API Auth Basic
* Fix CORS and Preflight CORS (Example Issue: Request header field ....... is not allowed by Access-Control-Allow-Headers in preflight response.)
* Woo ACF Gallery
* Gallery JSON Array or Object
* One Signal Push
* Custom Field Support

== Installation ==
1. Unzip and Upload `rest-api-helper.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

for enable Woo product and categories, edit rest-api-helper.php change line, or add code in wp-config.php
``` 
define("IMH_WOO", false);
```
to 
``` 
define("IMH_WOO", true);
```

You can changing custom field for gallery (default woo using _product_image_gallery metakey), edit rest-api-helper.php change line
``` 
define("IMH_WOO_ACF_GALLERY", '_product_image_gallery'); 
```
to 
``` 
define("IMH_WOO_ACF_GALLERY", 'images'); 
```

and for type data object or string (default string, separator with coma)
``` 
define("IMH_WOO_ACF_GALLERY_OBJECT", false); 
```

for enable oneSignal Sender
``` 
define("IMH_ONESIGNAL_PUSH", false);
```
to 
``` 
define("IMH_ONESIGNAL_PUSH", true);
```
then fix your app_id and app_key

``` 
define("IMH_ONESIGNAL_PUSH", false);
define("IMH_ONESIGNAL_PAGE_IN_APP", 'post_singles'); //this additional data (key: page and value: post_singles/post_id)
define("IMH_ONESIGNAL_APP_ID", '31ee45e2-c63d-4048-903a-89ca43f3afa2');
define("IMH_ONESIGNAL_APP_KEY", 'YzUzNmZkOTAtMmVlMC00OWIzLThlNGQtMzQyYzzyNmFhZjcw');
```

so that configuration is not lost after update, please write code on wp-config.php

``` 
define("IMH_WOO", true);
define("IMH_RESTAPI_BASIC_AUTH",false);
define("IMH_ALLOW_PREFLIGHT_CORS",false );
define("IMH_WOO_ACF_GALLERY",'_product_image_gallery');
define("IMH_WOO_ACF_GALLERY_OBJECT",false);
define("IMH_ONESIGNAL_PUSH",false);
define("IMH_ONESIGNAL_PAGE_IN_APP",'post_singles');
define("IMH_ONESIGNAL_APP_ID",'31ee45e2-c63d-4048-903a-89ca43f3afa2');
define("IMH_ONESIGNAL_APP_KEY",'YzUzNmZkOTAtMmVlMC00OWIzLThlNGQtMzQyYzzyNmFhZjcw');
```

You can allow anonymous comments using configuration:

```
define("IMH_ALLOW_PREFLIGHT_CORS",true); //required for method post
define("IMH_ANONYMOUS_COMMENTS",true);
```

send comment using url like this:
```
http://wordpress.co.id/wp-json/wp/v2/comments?author_name=Your Name Here&author_email=your-email-address@website-address-here.com&author_name=Your Name Here&content=Your Comment Here&post=20
```


== Frequently asked questions ==

== Screenshots ==

== Changelog ==



=== Changelog 1.7 ===
* add option page
* content render for shortcode visual composer

=== Changelog 1.8 ===
* add woo support

=== Changelog 2.1.1 ===
* fix woo issue

=== Changelog 2.1.2 ===
* add custom field support

=== Changelog 2.1.3 ===
* add custom field for gallery support 
  
=== Changelog 2.1.4 ===
* fix permalink for woo

=== Changelog 2.1.5 ===
* Add onesignal sender

=== Changelog 2.1.6 ===
* Add Woocommerce attributes

=== Changelog 2.1.7 ===
* Fix issue attributes

=== Changelog 2.1.8 ===
* Improved: support Very Simple Event List

=== Changelog 2.1.9 ===
* Improved: for keep configuration is not lost after update, save your config in wp-config.php

=== Changelog 2.2.0 ===
* Add Basic Auth Support

=== Changelog 2.2.1 ===
* Add preflight support for post

=== Changelog 2.2.2 ===
* Add OneSignal Sender Page

=== Changelog 2.2.3 ===
* Add option allow anonymous comments

=== Changelog 2.2.4 ===
* Fix error on post-edit

== Credits ==
* [Ihsana IT Solution](http://ihsana.com)
* [IMA Builder - Build App without coding](https://goo.gl/qznlXo)

== Upgrade Notice == 