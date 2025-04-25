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
        register_setting(
            'reading',
            self::OPTION_NAME,
            [
                'type' => 'integer',
                'description' => __('Adjust the average reading speed in words per minute.', 'reading-time-block'),
                'default' => self::DEFAULT_SPEED,
                'sanitize_callback' => 'intval',
            ]
        );

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
        ?>
        <input
            type="number"
            id="reading_time_speed"
            name="<?php echo esc_attr(self::OPTION_NAME); ?>"
            value="<?php echo esc_attr($value); ?>"
            min="125"
            max="300"
            step="5"
        />
        <p class="description">
            <?php echo esc_html__('Adjust the average reading speed (words per minute).', 'reading-time-block'); ?>
        </p>

        <ul id="reading_speed_options">
            <li><a href="#" data-value="125"><?php echo esc_html__('125 WPM:', 'reading-time-block'); ?></a> <?php echo esc_html__('Technical or dense content', 'reading-time-block'); ?></li>
            <li><a href="#" data-value="150"><?php echo esc_html__('150 WPM:', 'reading-time-block'); ?></a> <?php echo esc_html__('Technical or dense content', 'reading-time-block'); ?></li>
            <li><a href="#" data-value="200"><?php echo esc_html__('200 WPM:', 'reading-time-block'); ?></a> <?php echo esc_html__('Average web content', 'reading-time-block'); ?></li>
            <li><a href="#" data-value="250"><?php echo esc_html__('250 WPM:', 'reading-time-block'); ?></a> <?php echo esc_html__('Average web content', 'reading-time-block'); ?></li>
            <li><a href="#" data-value="300"><?php echo esc_html__('300 WPM:', 'reading-time-block'); ?></a> <?php echo esc_html__('Fiction or light reading', 'reading-time-block'); ?></li>
        </ul>

        <script>
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
        </script>
        <?php
    }
}
