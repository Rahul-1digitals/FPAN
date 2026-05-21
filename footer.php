<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FPAN_Theme
 */

// Pull Customizer values once — fallback to empty string if not set
$footer_description = get_theme_mod( 'fpan_footer_description', '' );
$footer_address     = get_theme_mod( 'fpan_footer_address', '' );
$footer_phone       = get_theme_mod( 'fpan_footer_phone', '' );
$footer_email       = get_theme_mod( 'fpan_footer_email', '' );
?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<!-- =================================================================
		     FOOTER BODY — org | nav | contact
		     ================================================================= -->
		<div class="footer__body">
			<div class="container">
				<div class="footer__grid">

					<!-- ---------------------------------------------------
					     COLUMN 1: Organisation
					     Logo/name + description from Customizer + newsletter
					     --------------------------------------------------- -->
					<div class="footer__col footer__col--org">

						<div class="footer__brand">
							<?php if ( has_custom_logo() ) : ?>
								<?php the_custom_logo(); ?>
							<?php else : ?>
								<p class="footer__site-name">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<?php bloginfo( 'name' ); ?>
									</a>
								</p>
							<?php endif; ?>
						</div>

						<?php if ( $footer_description ) : ?>
							<p class="footer__description">
								<?php echo esc_html( $footer_description ); ?>
							</p>
						<?php endif; ?>

						<form
							class="footer__newsletter"
							action="#"
							method="post"
							aria-label="<?php esc_attr_e( 'Newsletter signup', 'fpan-theme' ); ?>"
						>
							<label for="footer-newsletter-email" class="sr-only">
								<?php esc_html_e( 'Your email address', 'fpan-theme' ); ?>
							</label>
							<div class="footer__newsletter-row">
								<input
									type="email"
									id="footer-newsletter-email"
									name="footer_newsletter_email"
									class="footer__newsletter-input"
									placeholder="<?php esc_attr_e( 'Your email', 'fpan-theme' ); ?>"
									autocomplete="email"
								>
								<button type="submit" class="footer__newsletter-btn">
									<?php esc_html_e( 'Subscribe', 'fpan-theme' ); ?>
								</button>
							</div>
						</form>

					</div><!-- .footer__col--org -->

					<!-- ---------------------------------------------------
					     COLUMN 2: Footer Navigation
					     wp_nav_menu renders the menu assigned to 'footer-menu'
					     in WP Admin → Appearance → Menus.
					     Wrapped in has_nav_menu() so nothing renders if no
					     menu is assigned yet.
					     --------------------------------------------------- -->
					<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<div class="footer__col footer__col--nav">
						<h2 class="footer__heading">
							<?php esc_html_e( 'Network', 'fpan-theme' ); ?>
						</h2>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'container'      => false,
								'menu_class'     => 'footer-nav__list',
								'depth'          => 1,        // flat list — no dropdowns in footer
								'fallback_cb'    => false,
							)
						);
						?>
					</div><!-- .footer__col--nav -->
					<?php endif; ?>

					<!-- ---------------------------------------------------
					     COLUMN 3: Contact
					     Values come from Appearance → Customize →
					     Footer Information (set in inc/customizer.php).
					     The whole column is suppressed if all three are empty.
					     --------------------------------------------------- -->
					<?php if ( $footer_address || $footer_phone || $footer_email ) : ?>
					<div class="footer__col footer__col--contact">
						<h2 class="footer__heading">
							<?php esc_html_e( 'Contact', 'fpan-theme' ); ?>
						</h2>

						<?php if ( $footer_address ) : ?>
							<p class="footer__contact-item footer__contact-item--address">
								<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0z"/>
									<circle cx="12" cy="10" r="3"/>
								</svg>
								<address class="footer__address">
									<?php echo nl2br( esc_html( $footer_address ) ); ?>
								</address>
							</p>
						<?php endif; ?>

						<?php if ( $footer_phone ) : ?>
							<p class="footer__contact-item">
								<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.62 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
								</svg>
								<a href="tel:<?php echo esc_attr( $footer_phone ); ?>">
									<?php echo esc_html( $footer_phone ); ?>
								</a>
							</p>
						<?php endif; ?>

						<?php if ( $footer_email ) : ?>
							<p class="footer__contact-item">
								<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<rect x="2" y="4" width="20" height="16" rx="2"/>
									<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
								</svg>
								<a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
									<?php echo esc_html( $footer_email ); ?>
								</a>
							</p>
						<?php endif; ?>

					</div><!-- .footer__col--contact -->
					<?php endif; ?>

				</div><!-- .footer__grid -->
			</div><!-- .container -->
		</div><!-- .footer__body -->

		<!-- =================================================================
		     UTILITY BAR — copyright + legal navigation
		     ================================================================= -->
		<div class="footer__bar">
			<div class="container footer__bar-inner">

				<p class="footer__copyright">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
					<?php bloginfo( 'name' ); ?>.
					<?php esc_html_e( 'All rights reserved.', 'fpan-theme' ); ?>
				</p>

				<nav
					class="footer__legal"
					aria-label="<?php esc_attr_e( 'Legal', 'fpan-theme' ); ?>"
				>
					<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">
						<?php esc_html_e( 'Privacy Policy', 'fpan-theme' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/accessibility' ) ); ?>">
						<?php esc_html_e( 'Accessibility', 'fpan-theme' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">
						<?php esc_html_e( 'Terms', 'fpan-theme' ); ?>
					</a>
				</nav>

			</div><!-- .footer__bar-inner -->
		</div><!-- .footer__bar -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
