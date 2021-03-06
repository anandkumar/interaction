<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container">

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'stargazer' ); ?></a>
		</div><!-- .skip-link -->

		<header <?php hybrid_attr( 'header' ); ?>>

				<div id="branding">
					<?php hybrid_site_title(); ?>
					<?php // hybrid_site_description(); ?>
				</div><!-- #branding -->

			<?php hybrid_get_sidebar( 'header' ); // Loads the sidebar/header.php template. ?>

		</header><!-- #header -->

		<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

		<?php hybrid_get_sidebar( 'home' ); // Loads the sidebar/home.php template. ?>

		<div class="wrap">

			<div id="main" class="main">

				<?php hybrid_get_menu( 'breadcrumbs' ); // Loads the menu/breadcrumbs.php template. ?>
