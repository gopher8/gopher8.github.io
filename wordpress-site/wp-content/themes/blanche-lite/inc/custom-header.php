<?php
/**
 *
 * @package Blanche
 */

/**
 * Setup the WordPress core custom header feature.
 */
function blanche_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'blanche_custom_header_args', array(
		'width'         => 2000,
		'height'        => 700,
		'uploads'       => true,
		'default-text-color'     => '000000',
		'wp-head-callback'       => 'blanche_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'blanche_custom_header_setup' );

if ( ! function_exists( 'blanche_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see blanche_custom_header_setup().
 */
function blanche_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		h1.site-title,
		h2.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;