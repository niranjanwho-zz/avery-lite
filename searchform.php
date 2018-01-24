<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The template for displaying search form
 *
 * @package Avery Lite
 */
?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<h5 class="widget-title"><?php echo esc_attr__( 'What are you looking for?', 'avery-lite' ); ?></h5>
	<label for="<?php echo esc_attr( uniqid( 'search-form-' )); ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'avery-lite' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( uniqid( 'search-form-' )); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Enter a Keyword Here', 'placeholder', 'avery-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="glyphicon glyphicon-search"></span><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'avery-lite' ); ?></span></button>
	<p><?php echo esc_attr__('And press enter.', 'avery-lite') ?></p>
</form>
