<?php
/**
 * "The universe is vast and we are so small. There is only one thing we can ever truly control...Whether 
 * we are good or evil." ~ Oma Desala (Stargate SG-1)
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Stargazer
 * @subpackage Functions
 * @version    1.2.1
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013 - 2014, Justin Tadlock
 * @link       http://themehybrid.com/themes/stargazer
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get the template directory and make sure it has a trailing slash. */
$stargazer_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and launch it. */
require_once( $stargazer_dir . 'library/hybrid.php' );
new Hybrid();

/* Load theme-specific files. */
require_once( $stargazer_dir . 'inc/custom-background.php'     );
require_once( $stargazer_dir . 'inc/custom-colors.php'         );

/* Set up the theme early. */
add_action( 'after_setup_theme', 'stargazer_theme_setup', 5 );

/**
 * The theme setup function.  This function sets up support for various WordPress and framework functionality.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function stargazer_theme_setup() {

	/* Load files. */
	require_once( trailingslashit( get_template_directory() ) . 'inc/stargazer.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/customize.php' );

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Theme layouts. */
	add_theme_support( 
		'theme-layouts', 
		array(
			'1c'        => __( '1 Column Wide',                'stargazer' ),
			'1c-narrow' => __( '1 Column Narrow',              'stargazer' ),
			'2c-l'      => __( '2 Columns: Content / Sidebar', 'stargazer' ),
			'2c-r'      => __( '2 Columns: Sidebar / Content', 'stargazer' )
		),
		array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) 
	);

	/* Load stylesheets. */
	add_theme_support(
		'hybrid-core-styles',
		array( 'stargazer-fonts', 'one-five', 'gallery', 'stargazer-mediaelement', 'parent', 'style' )
	);

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Breadcrumbs. Yay! */
	add_theme_support( 'breadcrumb-trail' );

	/* Pagination. */
	add_theme_support( 'loop-pagination' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Whistles plugin. */
	add_theme_support( 'whistles', array( 'styles' => true ) );

	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);

	/* Editor styles. */
	add_editor_style( stargazer_get_editor_styles() );

	/* Handle content width for embeds and images. */
	// Note: this is the largest size based on the theme's various layouts.
	hybrid_set_content_width( 1025 );
}

/** Overwrite theme layout options **/
add_filter( 'theme_mod_theme_layout', 'my_mod_theme_layout', 99 );
function my_mod_theme_layout( $layout ) {

	if ( is_bbpress() )
		$layout = '1c';

	return $layout;
}

add_filter('bbp_no_breadcrumb', function($arg) { return true; } );

function add_extra_contactmethod( $contactmethods ) {
// Add new ones
$contactmethods['twitter'] = 'Twitter';
$contactmethods['facebook'] = 'Facebook';
$contactmethods['googleplus'] = 'Google Plus';
$contactmethods['youtube'] = 'Youtube Channel';
 
// remove unwanted
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
 
return $contactmethods;
}
add_filter('user_contactmethods', 'add_extra_contactmethod');

function short_freshness_time( $output) {
$output = preg_replace( '/, .*[^ago]/', ' ', $output );
return $output;
}
add_filter( 'bbp_get_time_since', 'short_freshness_time' );
add_filter('bp_core_time_since', 'short_freshness_time');