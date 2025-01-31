<?php

namespace ReadingTimeBlock;

defined('ABSPATH') || exit;

class Settings {
    const OPTION_NAME = 'reading_time_speed';
    const DEFAULT_SPEED = 200;

    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Registers the setting and adds it to the "Reading" settings page.
     */
    public function register_settings() {
        // Register the setting
        register_setting(
            'reading', // The settings group
            self::OPTION_NAME,
            [
                'type' => 'integer',
                'description' => __('Adjust the average reading speed in words per minute.', 'reading-time-block'),
                'default' => self::DEFAULT_SPEED,
                'sanitize_callback' => 'intval',
            ]
        );

        // Add the settings field
        add_settings_field(
            'reading_time_speed',
            __('Reading Speed (WPM)', 'reading-time-block'),
            [$this, 'render_speed_field'],
            'reading',
            'default'
        );
    }

    /**
     * Renders the input field for the setting.
     */
    public function render_speed_field() {
        $value = get_option(self::OPTION_NAME, self::DEFAULT_SPEED);
        echo '<input 
                type="number" 
                id="reading_time_speed" 
                name="' . esc_attr(self::OPTION_NAME) . '" 
                value="' . esc_attr($value) . '" 
                min="125" 
                max="300" 
                step="5">';
        echo '<p class="description">' . esc_html__('Adjust the average reading speed (words per minute).', 'reading-time-block') . '</p>';
        echo '<ul id="reading_speed_options">
                <li><a href="#" data-value="125">125 WPM:</a> Technical or dense content</li>
                <li><a href="#" data-value="150">150 WPM:</a> Technical or dense content</li>
                <li><a href="#" data-value="200">200 WPM:</a> Average web content</li>
                <li><a href="#" data-value="250">250 WPM:</a> Average web content</li>
                <li><a href="#" data-value="300">300 WPM:</a> Fiction or light reading</li>
              </ul>';
    
        echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    const speedInput = document.getElementById("reading_time_speed");
                    const options = document.querySelectorAll("#reading_speed_options a");
                    
                    options.forEach(option => {
                        option.addEventListener("click", function (event) {
                            event.preventDefault();
                            const value = this.dataset.value;
                            speedInput.value = value;
                        });
                    });
                });
              </script>';
    }
}
