<?php if ( is_active_sidebar( 'home' ) ) : // If the sidebar has widgets. ?>

	<aside <?php hybrid_attr( 'sidebar', 'home' ); ?>>

		<?php dynamic_sidebar( 'home' ); // Displays the home sidebar. ?>

	</aside><!-- #sidebar-home -->

<?php endif; // End widgets check. ?>