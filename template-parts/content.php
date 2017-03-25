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
	if ( ! has_post_thumbnail() ) {
		$class_to_add = 'col-md-12 full-width-entry';
	}

	if ( has_post_thumbnail() ) {
		?>
		<header class="entry-header col-md-5 col-sm-12 col-xs-12 blog-post-image">
			<a href="<?php the_permalink(); ?>">
				<div class="post-thumbnail-wrap">
					<img src="<?php the_post_thumbnail_url( 'imma-blog-size' ); ?>" alt="">
				</div>
			</a>
		</header><!-- .entry-header -->
		<?php
	} ?>
	<div class="entry-content col-sm-12 col-xs-12 blog-post-content <?php echo esc_attr( $class_to_add ); ?>">
		<?php

		$title = get_the_title();
		if ( ! empty( $title ) ) {
			?>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a></h2>
		<?php }

		imma_get_post_meta();
		?>

		<?php if ( ! empty( get_the_excerpt() ) ) { ?>
			<div class="text-content">
				<?php the_excerpt(); ?>
			</div>
		<?php }

		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
