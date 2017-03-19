<?php
if ( ! function_exists( 'imma_slider_section' ) ) {
	function imma_slider_section() {
		$imma_slider_hide = get_theme_mod('imma_slider_hide');
		if( (bool) $imma_slider_hide === true ){
			return;
		} ?>

		<section id="header-carousel">
			<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php imma_get_slider_content(); ?>

					<div class="row text-center arrows-wrap">
						<a href="#"><i class="scroll-invite animated bounce fa fa-3x  fa-angle-double-down"></i></a>
					</div>
				</div>
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php
//					TODO: COME BACK HERE NEXT TIME @andrei
					?>
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
				</ol>

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
	?>

	<div class="item active">
		<div class="item-content-wrap" style="background: url('<?php echo  get_template_directory_uri() . '/img/cover.jpg' ?>') no-repeat center">

			<div class="cover-caption">
				<div class="container">
					<div class="col-sm-10 col-sm-offset-1">
						<h1 class="display-3">This is the second slide!</h1>

						<p>Testing the slider</p>

						<a href="#" class="btn btn-yellow btn-lg">Click here</a>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php

}