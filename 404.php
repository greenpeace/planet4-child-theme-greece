<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

/**
 * Add custom css class for body element hook.
 *
 * @param array $classes Array of css classes passed by the hook.
 *
 * @return array
 */
function add_body_classes( $classes ) {
	$classes[] = 'brown-bg page-404-page';

	return $classes;
}
add_filter( 'body_class', 'add_body_classes' );

$context = Timber::get_context();

$context['page_notfound_image']       = esc_url( get_stylesheet_directory_uri() . '/images/404-header-el.jpg' );
$context['page_notfound_title']       = __( 'Sorry, we can\'t find that page!', 'planet4-master-theme' );
$context['page_notfound_subheader']   = __( 'The page might be extinct...', 'planet4-master-theme' );
$context['page_notfound_description'] = __( 'Use the search tool and try your luck again.', 'planet4-master-theme' );
$context['page_notfound_help']        = __( 'Enter your search term below', 'planet4-master-theme' );
$context['page_category']             = __( '404 Page', 'planet4-master-theme' );

Timber::render( '404.twig', $context );
