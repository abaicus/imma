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
	$class_to_add = 'col-md-5';
	if( ! has_post_thumbnail() ){
		$class_to_add = 'col-md-12';
	}

	if( has_post_thumbnail() ){?>
		<header class="entry-header col-md-5 col-sm-12 col-xs-12 blog-post-image">
			<img src="<?php the_post_thumbnail_url('imma-blog-size'); ?>" alt="">
		</header><!-- .entry-header -->
		<?php
	}?>
	<div class="entry-content col-sm-12 col-xs-12 blog-post-content <?php echo esc_attr( $class_to_add ); ?>">
		<?php
		if ( is_single() ) { ?>
			<h2 class="post-title"><?php the_title(); ?></h2>
			<?php
			the_content( sprintf(
			/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'imma' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'imma' ),
				'after'  => '</div>',
			) );
		} else { ?>
			<h2 class="post-title"><?php the_title(); ?></h2>

			<p class="text-content">
				<?php the_excerpt(); ?>
			</p>
			<?php
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //imma_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
