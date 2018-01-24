<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Avery Lite
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="site-sidebar <?php if( is_active_sidebar( 'sidebar-1' ) ): ?>xs-no-float col-md-3 pull-right<?php else: ?>col-md-12<?php endif; ?>">
    <div class="theiaStickySidebar">
	    <aside id="secondary" class="widget-area <?php if ( is_single() && has_post_thumbnail() ): ?>padding-top-30<?php endif; ?>">
	        <?php dynamic_sidebar( 'sidebar-1' ); ?>
	    </aside><!-- #secondary -->
    </div>
</div>
