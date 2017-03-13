<?php
/**
 * Stats Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_stats_section' ) ) {
	function imma_stats_section() { ?>

		<section id="stats" class="stats">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12 stat-col">
						<i class="fa fa-bar-chart"></i>
						<span class="counter">1.300+</span>
						<span class="lead stat-title">Satisfied Clients</span>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 stat-col">
						<i class="fa fa-clipboard"></i>
						<span class="counter">100+</span>
						<span class="lead stat-title">Projects Done</span>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 stat-col">
						<i class="fa fa-clock-o"></i>
						<span class="counter">20.000+</span>
						<span class="lead stat-title">Hours of Work</span>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12 stat-col">
						<i class="fa fa-pencil"></i>
						<span class="counter">300+</span>
						<span class="lead stat-title">Positive Feedbacks</span>
					</div>
				</div>
			</div>
		</section>

	<?php }
}
add_action( 'imma_sections', 'imma_stats_section' );