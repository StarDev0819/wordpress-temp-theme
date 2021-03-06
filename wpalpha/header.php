<?php
/**
 * Header template
 *
 * @author     FunnyWP
 * @package    WP Alpha
 * @subpackage Theme
 * @since      1.0
 */

defined( 'ABSPATH' ) || die;
?>

<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php
		$preload_fonts = alpha_get_option( 'preload_fonts' );
		if ( ! empty( $preload_fonts ) ) {
			if ( in_array( 'alpha', $preload_fonts ) ) {
				echo '<link rel="preload" href="' . ALPHA_ASSETS . '/vendor/' . ALPHA_NAME . '-icons/fonts/' . ALPHA_NAME . '.ttf?5gap68" as="font" type="font/ttf" crossorigin>';
			}
			if ( in_array( 'fas', $preload_fonts ) ) {
				echo '<link rel="preload" href="' . ALPHA_ASSETS . '/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>';
			}
			if ( in_array( 'far', $preload_fonts ) ) {
				echo '<link rel="preload" href="' . ALPHA_ASSETS . '/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin>';
			}
			if ( in_array( 'fab', $preload_fonts ) ) {
				echo '<link rel="preload" href="' . ALPHA_ASSETS . '/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>';
			}
		}
		?>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<?php if ( is_customize_preview() || alpha_get_option( 'loading_animation' ) ) : ?>
			<?php
			echo apply_filters(
				'alpha_page_loading_animation',
				'<div class="loading-overlay">
					<div class="bounce-loader">
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>'
			);
			?>
		<?php endif; ?>

		<?php do_action( 'alpha_before_page_wrapper' ); ?>

		<div class="page-wrapper">

			<?php
			global $alpha_layout;
			if ( ! empty( $alpha_layout['top_bar'] ) && 'hide' != $alpha_layout['top_bar'] ) {
				echo '<div class="top-notification-bar">';
				alpha_print_template( $alpha_layout['top_bar'] );
				echo '</div>';
			}

			alpha_get_template_part( 'header/header' );

			alpha_print_title_bar();

			?>

			<?php do_action( 'alpha_before_main' ); ?>

			<main id="main" class="<?php echo apply_filters( 'alpha_main_class', 'main' ); ?>">
