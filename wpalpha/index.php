<?php
/**
 * The main template
 *
 * @author     FunnyWP
 * @package    WP Alpha
 * @subpackage Theme
 * @since      1.0
 */

defined( 'ABSPATH' ) || die;

if ( alpha_doing_ajax() && isset( $_GET['only_posts'] ) ) {

	// Page content for ajax filtering in blog pages.
	alpha_print_title_bar();
	alpha_get_template_part( 'posts/archive' );

} else {

	get_header();

	do_action( 'alpha_before_content' );

	?>
	<?php

	do_action( 'alpha_after_content' );

	get_footer();

}
