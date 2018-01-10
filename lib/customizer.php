<?php

class WP_Easy_Notices_Customizer {

	function __construct() {

		$this->hooks();

	}

	/**
	 * The actions and filters for this class
	 */
	public function hooks() {

		add_action( 'customize_register', array( $this, 'notice_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts' ), 1 );
		add_action( 'wp_ajax_wp_easy_notices_clear_dimissals', array( $this, 'clear_dismissals' ) );

	}

	/**
	 * Add all necessary fields to the Customizer
	 */
	public function notice_register( $wp_customize ) {

		// Adds the section
		$wp_customize->add_section( 'wp_easy_notices', array(
			'title'    => WP_EASY_NOTICES_NAME,
			'priority' => 1000,

		) );

		// Enable or Disable the notice
		$wp_customize->add_setting( 'wp_easy_notices_enabled', array(
			'type'       => 'option',
			'capability' => 'manage_options',
			'default'    => 'disabled',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_enabled', array(
			'label'   => __( 'Enabled', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'radio',
			'choices' => array(
				'enabled'  => __( 'Enabled', 'wp-easy-notices' ),
				'disabled' => __( 'Disabled', 'wp-easy-notices' ),
			),
		) );

		// The text of the notice
		$wp_customize->add_setting( 'wp_easy_notices_text', array(
			'default'    => __( 'Hello Dolly!', 'wp-easy-notices' ),
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_text', array(
			'label'   => __( 'Text', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'textarea',
		) );

		// Position
		$wp_customize->add_setting( 'wp_easy_notices_position', array(
			'type'       => 'option',
			'capability' => 'manage_options',
			'default'    => 'top-static',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_position', array(
			'label'   => __( 'Banner Position', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'radio',
			'choices' => array(
				'top-static'   => __( 'Top, Static', 'wp-easy-notices' ),
				'top-fixed'    => __( 'Top, Fixed', 'wp-easy-notices' ),
				'bottom-fixed' => __( 'Bottom, Fixed', 'wp-easy-notices' ),
			),
		) );

		// Font Size
		$wp_customize->add_setting( 'wp_easy_notices_font_size', array(
			'default'    => 16,
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_font_size', array(
			'label'   => __( 'Font Size (px)', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'number',
		) );

		// The background color of the notice
		$wp_customize->add_setting( 'wp_easy_notices_background', array(
			'default'    => '#000000',
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'wp_easy_notices_background',
			array(
				'label'    => __( 'Background Color', 'wp-easy-notices' ),
				'section'  => 'wp_easy_notices',
				'settings' => 'wp_easy_notices_background',
			)
		) );

		// The text color of the notice
		$wp_customize->add_setting( 'wp_easy_notices_text_color', array(
			'default'    => '#ffffff',
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'wp_easy_notices_text_color',
			array(
				'label'    => __( 'Text Color', 'wp-easy-notices' ),
				'section'  => 'wp_easy_notices',
				'settings' => 'wp_easy_notices_text_color',
			)
		) );

		// Padding left and right
		$wp_customize->add_setting( 'wp_easy_notices_padding_left_right', array(
			'default'    => 10,
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_padding_left_right', array(
			'label'   => __( 'Padding Left and Right (px)', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'number',
		) );

		// Padding top and bottom
		$wp_customize->add_setting( 'wp_easy_notices_padding_top_bottom', array(
			'default'    => 10,
			'type'       => 'option',
			'capability' => 'manage_options',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_padding_top_bottom', array(
			'label'   => __( 'Padding Top and Bottom (px)', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'number',
		) );

		// Is this notice dismissable?
		$wp_customize->add_setting( 'wp_easy_notices_dismissable', array(
			'type'       => 'option',
			'capability' => 'manage_options',
			'default'    => 'dismissable',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_dismissable', array(
			'label'   => __( 'Dismissable?', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'radio',
			'choices' => array(
				'dismissable'  => __( 'Dismissable', 'wp-easy-notices' ),
				'persistent'   => __( 'Persistent', 'wp-easy-notices' ),
			),
		) );

		// The dismiss icon
		$wp_customize->add_setting( 'wp_easy_notices_dismiss_icon', array(
			'type'       => 'option',
			'capability' => 'manage_options',
			'default'    => 'close',
			'transport'  => 'refresh',
		) );

		$wp_customize->add_control( 'wp_easy_notices_dismiss_icon', array(
			'label'   => __( 'Dismiss Icon', 'wp-easy-notices' ),
			'section' => 'wp_easy_notices',
			'type'    => 'radio',
			'choices' => array(
				'close'               => __( 'Normal', 'wp-easy-notices' ),
				'close-circle'        => __( 'Circle', 'wp-easy-notices' ),
				'close-circle-invert' => __( 'Circle Inverted', 'wp-easy-notices' ),
				'close-square'        => __( 'Square', 'wp-easy-notices' ),
				'close-square-invert' => __( 'Square Inverted', 'wp-easy-notices' ),
			),
		) );

		// Add a button to clear dismissals
		$wp_customize->add_control( 'wp_easy_notices_clear_dimissals', array(
			'label'       => __( 'Clear Dismissals', 'wp-easy-notices' ),
			'description' => __( 'Users who have previously dismissed your notice will see it again.' ),
			'settings'    => array(),
			'section'     => 'wp_easy_notices',
			'type'        => 'button',
			'input_attrs' => array(
				'value' => __( 'Clear Dismissals Now', 'wp-easy-notices' ),
				'class' => 'button button-primary',
			),
		) );

	}

	/**
	 * Enqueue scripts specific to the customizer
	 */
	public function scripts() {

		wp_enqueue_script(
			WP_EASY_NOTICES_SLUG,
			WP_EASY_NOTICES_DIST_URL . 'customizer.js',
			array( 'jquery' ),
			WP_EASY_NOTICES_VERSION,
			true
		);

	}

	/**
	 * Ajax endpoint to clear the dismissal cache
	 */
	public function clear_dismissals() {

		update_option( 'wp_easy_notices_clear_dimissals', time() );
		wp_send_json_success();

	}

}

if ( ! isset( $wp_easy_notices_customizer ) ) {
	$wp_easy_notices_customizer = new WP_Easy_Notices_Customizer();
}
