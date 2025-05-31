<?php
/**
 * Plugin Name: Reading Time Block
 * Description: A simple block that displays estimated reading time.
 * Version: 1.2.2
 * Author: Noah Stewart
 * Text Domain: reading-time-block
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.2
 * License: GPLv2 or later
 */

namespace ReadingTimeBlock;

defined('ABSPATH') || exit;

define( 'READING_TIME_BLOCK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'READING_TIME_BLOCK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once plugin_dir_path(__FILE__) . 'includes/class-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-render.php';

class Plugin {

    /**
     * Initializes the plugin.
     */
    public function __construct() {
        new Settings();
        add_action('init', [$this, 'register_block']);
    }

    /**
     * Registers the Gutenberg block and its assets.
     */
    public function register_block() {
        $script_handle = 'reading-time-block-script';
    
        wp_register_script(
            $script_handle,
            plugin_dir_url(__FILE__) . 'block.js',
            ['wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'],
            filemtime(plugin_dir_path(__FILE__) . 'block.js'),
            true
        );
    
        register_block_type_from_metadata(
            __DIR__,
            [
                'render_callback' => [new Render(), 'render_block'],
            ]
        );
    }    
}

new Plugin();
