<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Avery Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'avery-lite' ); ?></a>

	<header id="masthead" class="site-header site-header-top container-fluid clearfix">
		<div class="site-branding pull-left">		

			<?php avery_lite_the_custom_logo(); ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php $description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */  ?></p>
			<?php endif; ?>

		</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle pull-right icon-menu"></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<div class="site-search-modal">
			<button class="site-search-toggle pull-right icon-search"></button>
			<div class="site-search-form hide">
				<?php echo get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php if ( ( is_single() || is_page() ) && has_post_thumbnail() ): ?>
    <div class="site-featured-image container-fluid padding-top-30 animsition site-header-top">
        <?php echo get_the_post_thumbnail($post->ID, 'avery_lite_1920', array('class' => 'img-responsive img-center')); ?>
    </div><!-- .site-featured-image -->
    <?php endif; ?>

	<div id="content" class="site-content animsition <?php if ( !has_post_thumbnail() || is_front_page() || is_home() || is_archive() || is_search() ): ?>padding-top-30<?php endif; ?> site-header-top">
		<div id="primary" class="content-area container-fluid">
			<main id="main" class="site-main row">
				<div class="<?php if( is_active_sidebar( 'sidebar-1' ) ): ?>xs-no-float col-md-9 pull-left<?php else: ?>col-md-12<?php endif; ?> site-wrapper">
                <div class="theiaStickySidebar">

