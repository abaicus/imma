<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imma
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$imma_blog_single_header_hide = get_theme_mod( 'imma_blog_single_header_hide', false );
	?>

	<div class="entry-content col-sm-12 col-xs-12 blog-post-content">
		<?php
		if ( (bool) $imma_blog_single_header_hide === true ) { ?>
			<h2 class="post-title"><?php the_title(); ?></a></h2>
			<?php imma_get_post_meta();
		}
		the_content( sprintf(
		/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'imma' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'imma' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
