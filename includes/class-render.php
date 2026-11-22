<?php
/**
 * Frontend rendering for the reading-time block and shortcode.
 *
 * @package ReadingTimeBlock
 */

namespace ReadingTimeBlock;

defined( 'ABSPATH' ) || exit;

/**
 * Renders the estimated reading time for the current post.
 */
class Render {

	/**
	 * Renders the block content on the frontend.
	 *
	 * @return string Block HTML content.
	 */
	public function render_block() {
		return $this->render_reading_time( __( 'Estimated Reading Time', 'reading-time-block' ) );
	}

	/**
	 * Renders the [reading_time] shortcode.
	 *
	 * @param array|string $attributes Shortcode attributes.
	 * @return string Shortcode HTML content.
	 */
	public function render_shortcode( $attributes ) {
		$attributes = shortcode_atts(
			array(
				'show_label' => 'true',
				'label'      => __( 'Estimated Reading Time', 'reading-time-block' ),
			),
			$attributes,
			'reading_time'
		);

		$label = filter_var( $attributes['show_label'], FILTER_VALIDATE_BOOLEAN ) ? $attributes['label'] : '';
		return $this->render_reading_time( $label );
	}

	/**
	 * Renders the current post's reading time with an optional label.
	 *
	 * @param string $label Label displayed before the estimate.
	 * @return string Reading time HTML content.
	 */
	private function render_reading_time( $label ) {
		global $post;

		if ( ! isset( $post->post_content ) ) {
			return '';
		}

		$reading_speed = (int) get_option( Settings::OPTION_NAME, Settings::DEFAULT_SPEED );
		if ( $reading_speed <= 0 ) {
			$reading_speed = Settings::DEFAULT_SPEED;
		}
		// Exclude the reading-time shortcode itself from the estimate.
		$pattern = get_shortcode_regex( array( 'reading_time' ) );
		$content = preg_replace( '/' . $pattern . '/s', '$1 $5 $6', $post->post_content );
		$word_count = str_word_count( wp_strip_all_tags( $content ) );
		$reading_time = $this->calculate_reading_time( $word_count, $reading_speed );

		$label_html = '' === $label ? '' : sprintf( '<span>%s:</span> ', esc_html( $label ) );
		$output = sprintf( '<div class="reading-time-block">%s%s</div>', $label_html, esc_html( $reading_time ) );

		return apply_filters( 'reading_time_block_output', $output, $reading_time, $word_count );
	}

	/**
	 * Calculates the estimated reading time.
	 *
	 * @param int $word_count Number of words in the post.
	 * @param int $speed      Reading speed in words per minute.
	 * @return string Estimated reading time.
	 */
	private function calculate_reading_time( $word_count, $speed ) {
		$minutes = floor( $word_count / $speed );
		$seconds = floor( ( $word_count % $speed ) / ( $speed / 60 ) );

		if ( $minutes < 1 ) {
			return esc_html__( 'Less than a minute', 'reading-time-block' );
		}

		if ( $seconds > 30 ) {
			++$minutes;
		}

		/* translators: %d is time in minutes */
		return esc_html( sprintf( _n( '%d minute', '%d minutes', $minutes, 'reading-time-block' ), $minutes ) );
	}
}
