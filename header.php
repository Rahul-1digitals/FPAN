<?php
/**
 * The header for our theme
 *
 * Displays the <head> section and the site header up to the main content area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FPAN_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<!-- Skip link: keyboard / screen-reader users jump straight to content -->
	<a class="skip-link sr-only" href="#primary">
		<?php esc_html_e( 'Skip to content', 'fpan-theme' ); ?>
	</a>

	<!-- =====================================================================
	     SITE HEADER
	     .site-header            – full-width sticky bar
	     .header__inner          – flex row: brand | nav | actions
	     ===================================================================== -->
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="header__inner">

				<!-- ---------------------------------------------------------
				     BRAND
				     Shows custom logo when set, otherwise falls back to the
				     site name. On the front page the title is an <h1>;
				     everywhere else a <p> to keep heading hierarchy correct.
				     --------------------------------------------------------- -->
				<div class="header__brand">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="header__site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<?php
						else :
							?>
							<p class="header__site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</p>
							<?php
						endif;
					endif;
					?>
				</div><!-- .header__brand -->

				<!-- ---------------------------------------------------------
				     PRIMARY NAVIGATION
				     wp_nav_menu() renders the menu assigned to 'primary-menu'
				     in WP Admin → Appearance → Menus.
				     container="false" — we own the <nav> wrapper ourselves so
				     we control the landmark and aria-label directly.
				     fallback_cb="false" — output nothing if no menu assigned.
				     --------------------------------------------------------- -->
				<nav
					id="primary-navigation"
					class="header__nav"
					aria-label="<?php esc_attr_e( 'Primary', 'fpan-theme' ); ?>"
				>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-menu',
							'container'      => false,
							'menu_id'        => 'primary-menu-list',
							'menu_class'     => 'nav__list',
							'items_wrap'     => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav><!-- #primary-navigation -->

				<!-- ---------------------------------------------------------
				     HEADER ACTIONS
				     Contains the CTA button (always visible) and the
				     hamburger toggle (shown only on mobile via CSS).
				     --------------------------------------------------------- -->
				<div class="header__actions">

					<!-- CTA — visible on all breakpoints -->
					<a
						href="<?php echo esc_url( home_url( '/member-login' ) ); ?>"
						class="btn btn--primary header__cta"
					>
						<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
							<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
							<polyline points="10 17 15 12 10 7"/>
							<line x1="15" y1="12" x2="3" y2="12"/>
						</svg>
						<?php esc_html_e( 'Member Login', 'fpan-theme' ); ?>
					</a>

					<!-- Hamburger — hidden on desktop via CSS, shown on mobile -->
					<button
						class="header__toggle"
						id="menu-toggle"
						aria-controls="primary-navigation"
						aria-expanded="false"
						aria-label="<?php esc_attr_e( 'Open navigation menu', 'fpan-theme' ); ?>"
					>
						<span class="header__toggle-bar" aria-hidden="true"></span>
						<span class="header__toggle-bar" aria-hidden="true"></span>
						<span class="header__toggle-bar" aria-hidden="true"></span>
					</button>

				</div><!-- .header__actions -->

			</div><!-- .header__inner -->
		</div><!-- .container -->
	</header><!-- #masthead -->
