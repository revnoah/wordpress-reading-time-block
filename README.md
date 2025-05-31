# Reading Time Block

**Contributors:** Noah Stewart  
**Tags:** gutenberg, block, reading time, estimated time, block editor, shortcode
**Requires at least:** 6.0
**Tested up to:** 6.8
**Requires PHP:** 7.2  
**Stable tag:** 1.1.0
**License:** GPL-2.0-or-later
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

A simple WordPress plugin that adds a Gutenberg block to display the estimated reading time for the current post.

---

## Description

The **Reading Time Block** plugin calculates and displays an estimated reading time based on the content of the current post. It uses the average adult reading speed of 200 words per minute to determine the reading time.

### Features:
- Calculates estimated reading time dynamically.
- Simple and lightweight, built with plain JavaScript and PHP.
- Fully compatible with the WordPress block editor (Gutenberg).
- Server-rendered block for dynamic and accurate content output.
- Shortcode support: [reading_time]
- Translation-ready.

---

## Installation

1. Download the plugin ZIP file.
2. Upload the ZIP file to your WordPress site's plugins directory via FTP or the WordPress admin dashboard.
3. Activate the plugin through the "Plugins" menu in WordPress.

---

## Usage

1. Open any post or page in the WordPress block editor.
2. Add the **Reading Time** block from the "Widgets" category.
3. Save and view the post/page to see the dynamically calculated reading time.

### Shortcode

You can also insert the estimated reading time manually anywhere using the shortcode:
[reading_time]


**Optional shortcode attributes:**
- `show_label="true"` (default: true) – whether to display the label text.
- `label="Custom Label"` – custom label to display instead of the default.

Example:
[reading_time show_label="true" label="Approximate Read Time"]


---

## FAQ

### **How is the reading time calculated?**
The plugin calculates reading time using an average reading speed of 200 words per minute. It analyzes the word count of the post content and outputs the estimated time.

### **Can I customize the average reading speed?**
Currently, the average reading speed is fixed at 200 words per minute. Future versions may allow customization.

### **Can I use this plugin with classic editors or templates?**
Yes.  
The included shortcode `[reading_time]` can be used inside classic editors, widgets, or PHP templates (`do_shortcode('[reading_time]')`).

---

## Changelog

### 1.1.0
- Added shortcode `[reading_time]` support.
- Added admin option to customize reading speed (WPM).
- Improved translation support (i18n).
- Added filter `reading_time_block_output` for customizing output.

### 1.0
- Initial release.
- Added the Gutenberg block to display estimated reading time.

---

## License

This plugin is licensed under the GPLv2 or later.
