<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TsvCountryMusic
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
	<a class="skip-link screen-reader-text"
	   href="#primary"><?php esc_html_e( 'Skip to content', 'tsvcountrymusic' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<h1 class="site-title">
				<?php
				the_custom_logo();
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				   rel="home" class="site-title-text"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			$tsvcountrymusic_description = get_bloginfo( 'description', 'display' );
			if ( $tsvcountrymusic_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $tsvcountrymusic_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu"
					aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'tsvcountrymusic' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
