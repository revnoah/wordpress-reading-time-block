<?php

namespace ReadingTimeBlock;

defined('ABSPATH') || exit;

class Settings {
    const OPTION_NAME = 'reading_time_speed';
    const DEFAULT_SPEED = 200;

    public function __construct() {
        add_action('admin_init', [$this, 'register_settings']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    /**
     * Enqueue admin assets, js and css
     */
	public function enqueue_admin_assets($hook_suffix) {
		$screen = get_current_screen();

		if ($screen && $screen->id === 'options-reading') {
            wp_enqueue_script(
                'reading-time-block-settings',
                READING_TIME_BLOCK_PLUGIN_URL . 'assets/js/settings.js',
                [],
                filemtime( READING_TIME_BLOCK_PLUGIN_DIR . 'assets/js/settings.js' ),
                true
            );
        }
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
            min="50"
            max="400"
            step="5"
        />
        <p class="description">
            <?php echo esc_html__('Adjust the average reading speed (words per minute).', 'reading-time-block'); ?>
        </p>

        <?php
        $speed_options = [
            125 => __('Very dense or academic content', 'reading-time-block'),
            150 => __('Technical or professional content', 'reading-time-block'),
            200 => __('Average web content', 'reading-time-block'),
            250 => __('Fast-paced blogs or light articles', 'reading-time-block'),
            300 => __('Fiction or casual reading', 'reading-time-block'),
        ];

        $wpm_label = __('WPM', 'reading-time-block');
        ?>

        <ul id="reading_speed_options">
            <?php foreach ($speed_options as $wpm => $label) : ?>
                <li>
                    <a href="#" data-value="<?php echo esc_attr($wpm); ?>">
                        <?php echo esc_html(sprintf('%d %s:', $wpm, $wpm_label)); ?>
                    </a>
                    <?php echo esc_html($label); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}
