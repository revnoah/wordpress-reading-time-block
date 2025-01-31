<?php
/**
 * Plugin Name: Reading Time Block
 * Description: Adds a Gutenberg block to display the estimated reading time of the current post.
 * Version: 1.1.0
 * Author: Noah Stewart
 * Text Domain: reading-time-block
 */

namespace ReadingTimeBlock;

defined('ABSPATH') || exit;

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/class-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-render.php';

class Plugin {

    /**
     * Initializes the plugin.
     */
    public function __construct() {
        new Settings(); // Initialize settings
        add_action('init', [$this, 'register_block']);
    }

    /**
     * Registers the Gutenberg block and its assets.
     */
    public function register_block() {
        $render = new Render();

        // Register the block's script.
        wp_register_script(
            'reading-time-block-script',
            plugins_url('block.js', __FILE__),
            ['wp-blocks', 'wp-element', 'wp-editor'],
            '1.0',
            true
        );

        // Register the block with server-side rendering.
        register_block_type('reading-time-block/block', [
            'editor_script' => 'reading-time-block-script',
            'render_callback' => [$render, 'render_block'],
        ]);
    }
}

new Plugin();
