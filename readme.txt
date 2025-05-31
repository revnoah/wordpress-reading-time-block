=== Reading Time Block ===
Contributors: revnoah  
Tags: gutenberg, block, reading time, estimated time, block editor  
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.2  
Stable tag: 1.2.2
Tags: reading time, reading speed
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Adds a Gutenberg block to display the estimated reading time of the current post. Reading speed is customizable from the Settings → Reading screen.

== Description ==

The **Reading Time Block** plugin calculates and displays an estimated reading time based on the post content.

It uses a configurable reading speed (default: 200 words per minute) and outputs a clean, server-rendered block to the frontend.

This is ideal for blogs, documentation, or any content where you want to set expectations about how long it will take a visitor to read the page.

= Features =
* Adds a block to the Gutenberg editor for reading time.
* Automatically calculates based on post content.
* Supports customizable reading speed (WPM) via **Settings → Reading**.
* Lightweight and fast—no JS build step required.
* Fully translatable and namespace-isolated.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/reading-time-block/` directory, or install the plugin through the WordPress plugin screen directly.
2. Activate the plugin through the "Plugins" screen in WordPress.
3. Open a post in the block editor and insert the **Reading Time** block from the **Widgets** category.
4. Adjust the reading speed (optional) by visiting **Settings → Reading**.

== Frequently Asked Questions ==

= How is the reading time calculated? =
The plugin counts the number of words in the post content and divides by the configured reading speed in words per minute (WPM). It then rounds up to the nearest minute if necessary.

= Can I change the reading speed? =
Yes. You can adjust the reading speed via a numeric input or preset values in **Settings → Reading**.

= Does this plugin require JavaScript building or Node.js? =
No, the block is written in plain JavaScript and PHP, so there's no build step or asset compilation required.

== Screenshots ==

1. The block as it appears in the editor.
2. The estimated reading time on the frontend.
3. The WPM setting in Settings → Reading.

== Changelog ==

= 1.2.2 =
- Moved javascript to separate file, enqueued file
- Removed load_plugin_textdomain function call

= 1.2.1 =
- Added shortcode [reading_time].

= 1.2.0 =
- Added language support.

= 1.1.0 =
* Added settings under Settings → Reading for customizing WPM.
* Refactored render logic into a dedicated class.
* Improved block code structure.

= 1.0 =
* Initial release.
* Added a Gutenberg block to display estimated reading time.

== Upgrade Notice ==

= 1.1.0 =
Custom reading speed setting now available. Recommended update.

== License ==

This plugin is licensed under the GNU General Public License v2.0 or later.  
See https://www.gnu.org/licenses/gpl-2.0.html for full license text.
