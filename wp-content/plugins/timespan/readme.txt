=== TimeSpan ===
Contributors: paperleaf
Tags: Reading, Blog, Time, Length, Post, PaperLeaf, Paper, Leaf, Paper Leaf, Time Span, Span
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

TimeSpan is a simple, easy to set-up WordPress plugin that automagically calculates the approximate length of time it will take to read a blog post.


== Description ==

Welcome to TimeSpan

The plugin ships with default settings, but allows you to change everything from: the message shown for a post that will take less than one minute; the message shown for any post over 1 minute; and the words-per-minute used to calculate the reading time.

**Setup**

Once the plugin is activated, you have two options: you can include it in your theme files (handy for WordPress developers), or you can let us do all the heavy lifting with automagic setup.

**Include TimeSpan in Your Theme Files**

1. Head over to the TimeSpan menu under Settings
2. Fill out the options on that page
3. Place the ‘echo do_shortcode(‘[time-span]’)’ shortcode wherever you'd like the data to show up in your theme file (e.g. page-home.php).
4. Click the blue "Save Changes" button.

That's it!

**Automagic Setup**

The Automagic Setup will automatically insert the calculated time to read at the top of each of your posts. Here's how to do that:

1. Head over to the TimeSpan menu under Settings
2. Fill out the options on that page
3. Check the box at the bottom labeled "Automatically insert the time to read at the top of Posts".
4. Click the blue "Save Changes" button.

That's it!

**Are you guys for hire?**

We sure are. We're a custom design & WordPress development shop. If WordPress can do it, we can do it. <a href="http://www.paper-leaf.com" target=“_blank”>Drop us a line!</a>

== Installation ==

1. Upload the timespan folder to the /wp-content/plugins/ directory
2. Activate the TimeSpan plugin through the 'Plugins' menu in WordPress
3. Configure the plugin by going to the TimeSpan menu that appears in your admin menu (under Settings).


== Frequently Asked Questions ==

= How are you calculating the time to read the post? =

We grab the word count of the post, provided by WordPress, and divide that by an average words per minute (WPM). The plugin defaults to 250wpm, which we got from this Wikipedia entry on reading rate and reading for comprehension.

= My audience has a unique reading rate / reads at a different WPM. Can I change this? =

You sure can – just enter the WPM of your average reader in the "Average Reading Words per Minute" field, found in the TimeSpan menu under settings.

= Can I style the text TimeSpan spits out? =

Yep. Just target the .timespan class to target the type, and the .ts-time class to target & style the numeral itself.

= Are you guys for hire? =

We sure are. We're a custom design & WordPress development shop. If WordPress can do it, we can do it. <a href="http://www.paper-leaf.com" target=“_blank”>Drop us a line!</a>

== Changelog ==

= 1.10 = Account for posts which are greater than one minute, and less than two minutes, as per request from @florushj
= 1.0.2 = Account for prebuilt themes using custom content filters
= 1.0 = Initial Plugin Launch (September 30, 2014)
* Plugin First Launches 

