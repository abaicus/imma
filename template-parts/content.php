<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imma
 */

$has_sidebar = true;
$compare_with = false;
if( is_archive() ) {
	$compare_with = get_theme_mod( 'imma_archive_sidebar_hide', false );
}
if( is_home() ){
	$compare_with = get_theme_mod('imma_blog_index_sidebar_hide', true );
}
if( (bool)$compare_with === true ){
	$has_sidebar = false;
} else {
	if( is_active_sidebar('sidebar-1') === false ){
		$has_sidebar = false;
	}
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$class_to_add = 'col-md-5';
	if ( ! has_post_thumbnail() ) {
		$class_to_add = 'col-md-12 full-width-entry';
	}
	if( $has_sidebar === false){
		$class_to_add .= ' wo_sidebar';
	}


	if ( has_post_thumbnail() && $has_sidebar === false ) { ?>
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
		if ( has_post_thumbnail() && $has_sidebar === true ) { ?>
			<header class="entry-header col-xs-12 blog-post-image">
				<a href="<?php the_permalink(); ?>">
					<div class="post-thumbnail-wrap">
						<img src="<?php the_post_thumbnail_url( 'imma-blog-size' ); ?>" alt="">
					</div>
				</a>
			</header><!-- .entry-header -->
			<?php
		}

		$title = get_the_title();
		if ( ! empty( $title ) ) { ?>
			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a>
			</h2>
			<?php
		}

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
