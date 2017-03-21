<?php
/**
 * Stats Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_stats' ) ) {
	function imma_stats_section() {
		$imma_stats_hide = get_theme_mod( 'imma_stats_hide' );
		if( (bool) $imma_stats_hide === true ){
			return;
		}?>

		<section id="stats" class="stats">
			<?php
			if ( is_customize_preview() ) { ?>
				<div class="stats-css"></div>
				<?php
			} ?>
			<div class="container">
				<div class="row section-content">
					<?php imma_get_stats_content(); ?>
				</div>
			</div>
		</section>

	<?php }
}

if ( function_exists( 'imma_stats' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 50, 'imma_stats' );
	add_action( 'imma_sections', 'imma_stats', absint( $section_priority ) );
}
/**
 * Get stats content
 */
function imma_get_stats_content(){
	$default = imma_get_stats_content_default();
	$imma_stats_content = get_theme_mod( 'imma_stats_content', $default );
	if( !empty( $imma_stats_content ) ){
		$imma_stats_content = json_decode( $imma_stats_content, true );
		if( !empty( $imma_stats_content ) ){
			foreach ( $imma_stats_content as $stat){
				$icon = isset($stat['icon_value']) ?  $stat['icon_value'] : '';
				$title = isset($stat['title']) ? $stat['title'] : '';
				$text = isset($stat['subtitle']) ? $stat['subtitle'] : '';
				$link = isset($stat['link']) ? $stat['link'] : '';
				$color = isset($stat['color']) ? $stat['color'] : '';

				if( !empty( $color ) ){
					$color = 'style="color:'.esc_attr($color).'"';
				}?>

				<div class="col-md-3 col-sm-6 col-xs-12 stat-col">
					<?php
					if( !empty( $icon ) ){
						if( !empty( $link ) ){ ?>
							<a href="<?php echo esc_url( $link ); ?>">
							<?php
						}?>
						<i class="fa <?php echo esc_attr( $icon ); ?>" <?php echo $color; ?>></i>
						<?php
						if( !empty( $link ) ){ ?>
							</a>
							<?php
						}
					}
					if( !empty( $title ) ){
						if( !empty( $link ) ){ ?>
							<a href="<?php echo esc_url( $link ); ?>">
							<?php
						}?>
						<span class="counter"><?php echo esc_html( $title ); ?></span>
						<?php
						if( !empty( $link ) ){ ?>
							</a>
							<?php
						}
					}
					if( !empty( $text ) ){ ?>
						<div class="lead stat-title"><?php echo wp_kses_post( $text ); ?></div>
						<?php
					}?>
				</div>
				<?php
			}
		}
	}
}