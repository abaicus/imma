<?php
/**
 * Hero Area Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_hero_section' ) ) {
	function imma_hero_section() { ?>

		<section id="cover">

			<div id="cover-caption">
				<div class="container">
					<div class="col-sm-10 col-sm-offset-1">
						<h1 class="display-3">Welcome to our website!</h1>

						<br>

						<br>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio dolorum beatae, ullam ab
							similique quia vitae vel cum, assumenda quod totam quisquam pariatur mollitia quam
							laudantium quos rerum, culpa, aperiam.</p>

						<br>
						<br>

						<form class="form-inline">
							<div class="form-group">
								<label class="sr-only" for="exampleInputName2">Name</label>
								<input type="text" class="form-control" id="exampleInputName2" placeholder="Name">
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail2">Email</label>
								<input type="email" class="form-control " id="exampleInputEmail2" placeholder="E-mail">
							</div>
							<button type="submit" class="btn btn-yellow ">Okay, Go!</button>
						</form>
					</div>
				</div>
			</div>

		</section>

	<?php }
}
add_action( 'imma_sections', 'imma_hero_section' );