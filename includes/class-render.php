<?php

namespace ReadingTimeBlock;

defined('ABSPATH') || exit;

class Render {

    /**
     * Renders the block content on the frontend.
     *
     * @param array $attributes Block attributes.
     * @return string Block HTML content.
     */
    public function render_block($attributes) {
        global $post;

        if (!isset($post->post_content)) {
            return '';
        }

        $reading_speed = get_option(Settings::OPTION_NAME, Settings::DEFAULT_SPEED);
        $reading_time = $this->calculate_reading_time($post->post_content, $reading_speed);

        return sprintf(
            '<div class="reading-time-block"><span>%s:</span> %s</div>',
            esc_html__('Estimated Reading Time', 'reading-time-block'),
            esc_html($reading_time)
        );
    }

    /**
     * Calculates the estimated reading time.
     *
     * @param string $content The content to calculate reading time for.
     * @param int $speed Words per minute speed.
     * @return string Estimated reading time.
     */
    private function calculate_reading_time($content, $speed) {
        $word_count = str_word_count(strip_tags($content));
        $minutes = floor($word_count / $speed);
        $seconds = floor(($word_count % $speed) / ($speed / 60));

        if ($minutes < 1) {
            return __('Less than a minute', 'reading-time-block');
        }

        if ($seconds > 30) {
            $minutes++;
        }

        return sprintf(
            _n('%d minute', '%d minutes', $minutes, 'reading-time-block'),
            $minutes
        );
    }
}
