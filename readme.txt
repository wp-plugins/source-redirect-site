=== Source Redirect Site ===
Contributors: presspixels
Donate link: http://www.presspixels.com/donations/
Tags: Press Pixels, Source, Redirect, Redirection, Site, Browser, Location, Mobile, User, State, Location
Requires at least: 3.1
Tested up to: 3.4
Stable tag: 1.1.0

Redirect your Site Content Pages based on the specific Source Hardware Device, Browser Type, Global Region or States, User Roles or Status.

== Description ==

<p><a href="http://www.presspixels.com">Press Pixels</a> <a href="http://www.presspixels.com/release/source-redirect-site/">Source Redirect Site</a> for WordPress redirects your site before loading any site content based on the specific source device, browser (mobile or standard), user role or login status, global location and also any Global State.</p>

<p>Source Redirect Site for WordPress is a complete redirection plugin which allows you to set redirection URL addresses for any browser type, mobile device, user location and even user country state. Site admins can easily set the defined redirect URL’s for all types in their WordPress Source Redirect admin area, before your website loads any content a simple and fast JavaScript check is made and the site user is sent to the correct place!</p>

<p>The Source Redirect Site Plugin for WordPress is ideal for anyone with different site types – for example if someone is using a handheld you could show them a mobile version of your site, or if someone views your site using Internet Explorer 6 you could show them a upgrade page.</p>

<p>With the power of GEO IP Country redirection you can set different URL addresses (for language sites for different countries for example) – add to this the power of redirecting various local states or regions (political campaign sites, US School sites for example). Options are unlimited!</p>

<p>Redirects can be grouped by type or specifically set for the following: <strong>Mobiles</strong> (Android, Blackberry, iPad, iPhone, Nokia, Palm, Windows Mobile / CE, Opera Mobile, Generic Mobile) <strong>Browsers</strong> (Google Chrome, Mozilla Firefox, Opera, Safari, Internet Explorer 6/7/8/9/10) <strong>Users</strong> (logged in/out, user role levels, recursive folders) <strong>Geo Country</strong> Location (All Global Countries) <strong>Geo States</strong> (All US States)</p>

<p><strong>Please note that some features are only available on the <a href="http://www.presspixels.com/release/source-redirect-site/">Pro Version</a>. Specifically the Country and State Redirection, older browser version redirection and the specific mobile device redirection. All other features are active and working in this free version.</strong></p>

<p>If you have suggestions for a new plugin or for version updates for this plugin, feel free to <a href="http://www.presspixels.com/wordpress-contact-press-pixels-support/">contact us</a>. You can also keep updated with our various channels shown below:</p>
<p> <a href="mailto:hello@presspixels.com">mail</a> / <a href="http://feeds.feedburner.com/presspixels">rss</a> / <a href="http://twitter.com/#!/sitesolution">twitter</a> / <a href="http://www.facebook.com/sitesource">facebook</a> / <a href="http://www.presspixels.com">site</a></p>

== Installation ==

Manual Installation from Download File:

1. Extract downloaded ZIP file to a location of your choice.
2. Upload folder`background-slider` to your `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in your WordPress Site.
4. Options can be found under your Admin / Settings / Source Redirect menu.

== Frequently Asked Questions ==

= I can only see the browser redirection in the backend, where the other options? =

You are using the standard free option – you need to get the Pro version for the other options.

= My site now gives an error like “too many redirects"... =

The redirection is looping. What this means is that you have a redirect on that page and have another redirect conflicting. This could be a htaccess file error, or an SEO plugin conflict. Try temporarily disabling your htaccess or other plugins till your site loads fine so you can find the culprit.

= All browsers/countries/devices go the same redirect page. =

Check your Source Redirect Site Plugin settings, each tab has an option to redirect all types – make sure that is set to “no” to enable individual redirection.

= How do I make the redirect back to normal for Mobile users? =

You need to create a link on your site for mobile users, with the target URL as follows: http://[YOURSITE]/?redirect_bypass=1 this will let mobile users return to the base normal looking site.

= I want to know i can make redirect for US states like NY, FL and many more =

Yes, you can with the Pro version – there is a whole tab in the backend which allows setting of URL’s for Any Global States and Global Countries and Regions.

= Does this plugin work with cache plugins (like W3 Total Cache) especially when used in combination with a Content Delivery Network (CDN)? It’s seems like the caching might get in the way of some of the redirection protocols. =

That should work fine as the plugin uses direct 301 and header redirect combinations, using WordPress built in redirect system as well – which should get added to the CDN and cache. We have it running here on Press Pixels using CloudFlare CDN and caching with no problems.

== Screenshots ==

1. Sample Mobile Redirection Admin Page.
2. Sample Browser Redirection Admin Page.
3. Sample Geo Country and State Redirection Admin Page.
4. User Roles / Status and User Redirection Options.

== Changelog ==

= 1.1.0 =
* Bug Fixes, recommended update!

= 1.0.4 =
* Bug Fixes, recommended update!

= 1.0.3 =
* Added User filtering based on login status and also user roles.
* Many minor bug fixes.

= 1.0.2 =
* Fixed call_user_func_array() error

= 1.0.1 =
* Two new features: Redirect Bypass links.
* Custom Redirects for Posts and Pages.

= 1.0 =
* First Release, no changes yet!

== Upgrade Notice ==

= 1.1.0 =
* Bug Fixes, recommended update!

= 1.0.4 =
* Bug Fixes, recommended update!

= 1.0.3 =
* New user features plus code cleaned up, recommended update!

= 1.0.1 =
* Nice new Features, Redirect Bypass and Custom Redirect for Pages and Posts. Recommended!

= 1.0 =
No need to upgrade, current stable release.

== Arbitrary section ==

For more information please feel free to visit Press Pixels through any of these channels:

* Site: <a href="http://www.presspixels.com">Press Pixels</a>
* Plugin: <a href="http://www.presspixels.com/release/source-redirect-site/">Source Redirect Site</a>
* Other Releases: <a href="http://www.presspixels.com/releases/">Listed Here</a>
