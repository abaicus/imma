<?php
if ( ! function_exists( 'imma_slider_section' ) ) {
	function imma_slider_section() {
		$imma_slider_hide = get_theme_mod('imma_slider_hide');
		if( (bool) $imma_slider_hide === true ){
			return;
		}
$imma_slider_inidicators_hide = get_theme_mod( 'imma_slider_inidicators_hide' );
$imma_slider_arrows_link = get_theme_mod( 'imma_slider_arrows_link', '#' );
$imma_slider_content = get_theme_mod( 'imma_slider_content', '' );
		?>

		<section id="header-carousel">
			<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php if( is_customize_preview() ) {
						echo '<div class="slider-customizer-wrap">';
					}

					imma_get_slider_content();

					if( is_customize_preview() ) {
						echo '</div>';
					} ?>

					<?php if( ! empty( $imma_slider_arrows_link ) ) { ?>
						<div class="row text-center arrows-wrap">
							<a href="<?php echo esc_url( $imma_slider_arrows_link ); ?>"><i class="scroll-invite animated bounce fa fa-3x  fa-angle-double-down"></i></a>
						</div>
					<?php } ?>
				</div>

				<?php if( (bool) $imma_slider_inidicators_hide === false ) {  ?>
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
				</ol>
				<?php } ?>
				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="fa fa-angle-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</section>
		<?php
	}
}

remove_action( 'imma_hero_section', 'imma_big_title_section' );
add_action( 'imma_hero_section', 'imma_slider_section' );

/**
 * Display main content of slider section
 */
function imma_get_slider_content(){
	$default = imma_get_slider_content_default();
	$imma_slider_content  = get_theme_mod( 'imma_slider_content', $default);
	if( !empty($imma_slider_content) ){
		$imma_slider_content = json_decode($imma_slider_content, true);
		$count = 0;
		foreach ( $imma_slider_content as $slider_item){
			$count ++;
			$image_url = isset($slider_item['image_url']) ?  $slider_item['image_url'] : '';
			$title = isset($slider_item['title']) ? $slider_item['title'] : '';
			$text = isset($slider_item['subtitle']) ? $slider_item['subtitle'] : '';
			$button_text = isset($slider_item['text']) ? $slider_item['text'] : '';
			$button_link = isset($slider_item['link']) ? $slider_item['link'] : ''; ?>
			<div class="item <?php if( $count === 1  ) { echo 'active'; }  ?>">
					<?php
					if( !empty($image_url) ) { ?>
						<div class="item-content-wrap" style="background: url('<?php echo esc_url( $image_url ) ?>') no-repeat center">
						<?php
					} else { ?>
						<div class="item-content-wrap">
					<?php }

					if( ! empty( $title ) || ! empty( $text ) || ( ! empty( $button_link ) && ! empty( $button_text ) ) ) { ?>
						<div class="cover-caption">
							<div class="container">
								<div class="col-sm-10 col-sm-offset-1">

									<?php if ( ! empty( $title ) ) { ?>
									<h1 class="display-3"><?php echo wp_kses_post( $title ); ?></h1>
							<?php }
									if ( ! empty ( $text ) ) { ?>
									<p><?php echo wp_kses_post( $text ); ?></p>
							<?php }
									if ( ! empty ( $button_link ) && ! empty( $button_text ) ) { ?>
									<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-yellow btn-lg"><?php echo esc_html( $button_text ); ?></a>
							<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
						</div>
			</div>
			<?php
		}
	}
} ?>
