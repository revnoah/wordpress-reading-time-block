<?php
/**
 * Plugin Name: Reading Time Block
 * Description: A simple block that displays estimated reading time.
 * Version: 1.2.3
 * Author: Noah Stewart
 * Text Domain: reading-time-block
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.2
 * License: GPLv2 or later
 *
 * @package ReadingTimeBlock
 */

namespace ReadingTimeBlock;

defined( 'ABSPATH' ) || exit;

define( 'READING_TIME_BLOCK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'READING_TIME_BLOCK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once plugin_dir_path( __FILE__ ) . 'includes/class-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-render.php';

require_once READING_TIME_BLOCK_PLUGIN_DIR . 'includes/class-plugin.php';

new Plugin();
