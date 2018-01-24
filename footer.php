<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Avery Lite
 */

?>

				</div><!-- .site-wrapper -->
                </div><!-- .theiaStickySidebar -->
                <?php get_sidebar(); ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<a href="#" class="scrollup"><span class="glyphicon glyphicon-menu-up"></span></a>

	<footer id="colophon" class="site-footer">
  
		<div class="site-info">
	        <div class="site-copyright">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'avery-lite' ) ); ?>" class="site-copyright"><?php printf( esc_html__( 'Proudly powered by %s', 'avery-lite' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'avery-lite' ), 'Avery Lite', 'ThemingBad' ); ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
