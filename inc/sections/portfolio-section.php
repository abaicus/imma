<?php
/**
 * Portfolio Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_portfolio' ) ) {
	function imma_portfolio() { ?>


		<section id="portfolio" class="portfolio">
			<div class="container">
				<div class="row">
					<div class=" col-md-12">
						<h2 class="text-center">Our Work</h2>
						<p class="text-center lead section-subtitle">Learn more about what we do on a day to day
							basis</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="card card-inverse">
							<img class="card-img" src="<?php echo get_template_directory_uri() . '/img/portfolio1.jpg' ?>" alt="Card image">
							<div class="card-img-overlay text-center">
								<div class="card-caption-wrapper">
									<h4 class="card-title lead">Street Photography</h4>
									<p class="card-text">Adventures on the streets of new york.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="card card-inverse">
							<img class="card-img" src="<?php echo get_template_directory_uri() . '/img/portfolio2.jpg' ?>" alt="Card image">
							<div class="card-img-overlay text-center">
								<div class="card-caption-wrapper">
									<h4 class="card-title lead">Static Photography</h4>
									<p class="card-text">Static photography in my apartment.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="card card-inverse">
							<img class="card-img" src="<?php echo get_template_directory_uri() . '/img/portfolio3.jpg' ?>" alt="Card image">
							<div class="card-img-overlay text-center">
								<div class="card-caption-wrapper">
									<h4 class="card-title lead">Night Photography</h4>
									<p class="card-text">Adventures in the night.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="card card-inverse">
							<img class="card-img" src="<?php echo get_template_directory_uri() . '/img/portfolio4.jpg' ?>" alt="Card image">
							<div class="card-img-overlay text-center">
								<div class="card-caption-wrapper">
									<h4 class="card-title lead">Sport Photography</h4>
									<p class="card-text">Competitions and athletes compeeting.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="card card-inverse">
							<img class="card-img" src="<?php echo get_template_directory_uri() . '/img/portfolio5.jpg' ?>" alt="Card image">
							<div class="card-img-overlay text-center">
								<div class="card-caption-wrapper">
									<h4 class="card-title lead">Nature Photography</h4>
									<p class="card-text">Adventures in the unkown.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="card card-inverse">
							<img class="card-img" src="<?php echo get_template_directory_uri() . '/img/portfolio6.jpg' ?>" alt="Card image">
							<div class="card-img-overlay text-center">
								<div class="card-caption-wrapper">
									<h4 class="card-title lead">Fashion Photography</h4>
									<p class="card-text">Outfits and people.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	<?php }
}

if ( function_exists( 'imma_portfolio' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 40, 'imma_portfolio' );
	add_action( 'imma_sections', 'imma_portfolio', absint( $section_priority ) );
}