<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_dev
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
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp_dev' ); ?></a>

	 <header id="masthead" class="site-header">
		

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="header-nav" aria-expanded="false"><?php esc_html_e( 'header-nav', 'wp_dev' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'Primary',
					'menu'        => 'header-nav',
				)
			);
			?>
		</nav>
	</header>
