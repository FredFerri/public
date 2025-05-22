=== WP Rest Api V2 Multiple PostTypes ===
Contributors: Salil Kothadia, 
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Tags: PostTypes, API, V2, RestApi, JSON, rest
Requires at least: 4.8
Tested up to: 4.9.7
Stable tag: 6.2
Requires PHP: 5.2.4


== Multiple Content type Query API for Wordpress Rest Api V2 ==

Extension of wp/v2/posts api to allow query multiple post types


== About ==

Want to get your site's posts, pages, articles, events?

Use the Endpoint: '/wp-json/wp/v2/multiple-post-type'

List: 

`GET` request to `/wp-json/wp/v2/multiple-post-type?&type[]=post&type[]=page`

Get the page with slug "about-me": 

`GET /wp-json/wp/v2/multiple-post-type?slug=about-me&type[]=post&type[]=page`

Search term "awesome": 

`GET /wp-json/wp/v2/multiple-post-type?search=awesome&type[]=post&type[]=page&type[]=articles`


== Credits ==

Build using the code shared by Ruben Vreeken, (https://github.com/Rayraz)
on stackoverflow (http://stackoverflow.com/questions/38059805/query-multiple-post-types-using-wp-rest-api-v2-wordpress)


== License ==

[GPLv3](http://www.gnu.org/licenses/gpl-3.0.html)
