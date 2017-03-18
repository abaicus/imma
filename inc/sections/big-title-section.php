<?php
if( ! function_exists( 'imma_big_title_section' ) ) {
	function imma_big_title_section () { ?>
		<section id="cover">

			<div class="cover-caption">
				<div class="container">
					<div class="col-sm-10 col-sm-offset-1">
						<h1 class="display-3">Welcome to our website!</h1>


						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio dolorum beatae, ullam ab
							similique quia vitae vel cum, assumenda quod totam quisquam pariatur mollitia quam
							laudantium quos rerum, culpa, aperiam.</p>

						<a href="#" class="btn btn-yellow btn-lg">Click here</a>

					</div>
				</div>
			</div>

		</section>
		<?php
	}
}
add_action( 'imma_hero_section', 'imma_big_title_section' );
?>