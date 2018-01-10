<?php

class WP_Easy_Notices_Front_End {

	function __construct() {

		$this->hooks();

	}

	/**
	 * The actions and filters for this class
	 */
	public function hooks() {

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'wp_footer', array( $this, 'markup' ) );
		add_action( 'wp_head', array( $this, 'head_css' ) );

	}

	/**
	 * Register scripts for the front end
	 */
	public function scripts() {

		wp_register_style(
			WP_EASY_NOTICES_SLUG,
			WP_EASY_NOTICES_DIST_URL . 'frontend.css',
			array(),
			WP_EASY_NOTICES_VERSION,
			'all'
		);

		wp_register_script(
			WP_EASY_NOTICES_SLUG,
			WP_EASY_NOTICES_DIST_URL . 'frontend.js',
			array(),
			WP_EASY_NOTICES_VERSION,
			true
		);

	}

	/**
	 * Insert dynamic CSS into the head from the Customizer
	 */
	public function head_css() {

		$padding_top_bottom = intval( get_option( 'wp_easy_notices_padding_top_bottom', '10' ) );
		$padding_left_right = intval( get_option( 'wp_easy_notices_padding_left_right', '10' ) );
		$font_size = intval( get_option( 'wp_easy_notices_font_size', 16 ) );

		?>
			<style>
				#wp-easy-notices {
					background-color: <?php echo esc_html( get_option( 'wp_easy_notices_background', '#000' ) ); ?>;
					color: <?php echo esc_html( get_option( 'wp_easy_notices_text_color', '#fff' ) ); ?>;
					font-size: <?php echo $font_size; ?>px;
					padding-bottom: <?php echo $padding_top_bottom; ?>px;
					padding-top: <?php echo $padding_top_bottom; ?>px;
					padding-left: <?php echo $padding_left_right; ?>px;
					padding-right: <?php echo $padding_left_right; ?>px;
				}

				#wp-easy-notices .dismiss {
					height: <?php echo $font_size; ?>px;
					width: <?php echo $font_size; ?>px;
				}

				#wp-easy-notices .dismiss svg {
					fill: <?php echo esc_html( get_option( 'wp_easy_notices_text_color', '#fff' ) ); ?>;
				}
			</style>
		<?php

	}

	/**
	 * Output the notice markup
	 */
	public function markup() {

		// Get out of here is notices are disabled
		$enabled = get_option( WP_EASY_NOTICES_SLUG . '_enabled' ) === 'enabled';
		if ( ! $enabled ) {
			return;
		}

		// Enqueue the required scripts and styles
		wp_enqueue_style( WP_EASY_NOTICES_SLUG );
		wp_enqueue_script( WP_EASY_NOTICES_SLUG );

		$dismissable = get_option( 'wp_easy_notices_dismissable' ) !== 'persistent' ? true : false;
		$dismissal_time = get_option( 'wp_easy_notices_clear_dimissals', 0 );

		// Localize some options for dismissals
		wp_localize_script( WP_EASY_NOTICES_SLUG, 'WP_EASY_NOTICES_VARS', array(
			'dismissable'     => $dismissable,
			'dismissal_cache' => $dismissal_time,
			'is_customizer'   => is_customize_preview(),
		) );

		$position = get_option( 'wp_easy_notices_position', 'top-static' );

		do_action( 'wp_easy_notices_before_outside_bar' );
		printf( '<div id="wp-easy-notices" class="%s" role="banner">',
			esc_attr( $position )
		);
		do_action( 'wp_easy_notices_before_inside_bar' );

		// Print the text
		echo wp_kses_post( get_option( 'wp_easy_notices_text', __( 'Hello Dolly!', 'wp-easy-notices' ) ) );

		if ( $dismissable ) {
			printf( '<button class="dismiss" aria-label="%s">',
				esc_attr( 'Dismiss This Notice', 'wp-easy-notices' )
			);
			?>
			
			<?php
				$dismiss_icon = get_option( 'wp_easy_notices_dismiss_icon', 'close' );
				echo file_get_contents( sprintf( '%s%s.svg',
					WP_EASY_NOTICES_SVG_PATH,
					$dismiss_icon
				) );
			?>

			</button>
			<?php
		}

		do_action( 'wp_easy_notices_after_inside_bar' );
		echo '</div>';
		do_action( 'wp_easy_notices_after_outside_bar' );

	}

}

if ( ! isset( $wp_easy_notices_front_end ) ) {
	$wp_easy_notices_front_end = new WP_Easy_Notices_Front_End();
}
