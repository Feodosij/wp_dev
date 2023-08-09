<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_dev
 */

?>

	<footer id="colophon" class="site-footer">
		<!-- <div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wp_dev' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'wp_dev' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'wp_dev' ), 'wp_dev', '<a href="http://underscores.me/">Feodosii</a>' );
				?>
		</div> -->

		<div class="panel-footer">Panel footer</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
