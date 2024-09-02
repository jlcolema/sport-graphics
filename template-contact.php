<?php

/* Template Name: Contact Template */

?>

<?php get_header(); ?>

	<div id="section" class="description">

		<h2 id="page-title">The world is a signage opportunity, let's turn some heads.</h2>

	</div>

	<div id="primary">

		<div class="map">

			<div class="map-wrap">

				<div id="map_canvas"></div>

			</div>

		</div>

		<div class="columns">

			<h3 class="section-title">Hello There!</h3>

			<div class="columns group">

				<div class="column form">

					<div class="container">

						<?php gravity_form(2, $display_title=false, $display_description=false, $display_inactive=false, $field_values=null, $ajax=false, $tabindex=1); ?>

					</div>

				</div>

				<div class="column address">

					<div class="container">

						<div class="vcard">
						
							<div class="fn org">Sport Graphics</div>
						
							<div class="adr">
						
								<div class="street-address">3423 Park Davis Circle</div>
						
								<span class="locality">Indianapolis</span>, 
								<abbr title="Indiana" class="region">IN</abbr>, 
								<span class="postal-code">46235</span>
						
							</div>
						
							<div><em>Phone</em> <span class="tel">317.899.7000</span></div>
						
							<div><em>Fax</em> <span class="fax">317.899.7010</span></div>
						
							<div><em>Email</em> <a class="email" href="mailto:hello@sportg.com">hello@sportg.com</a></div>

						</div>

					</div>

				</div>

				<div class="column details">

					<div class="container">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
						<article>
		
							<div class="entry">
				
								<?php the_content(); ?>
				
							</div>
				
						</article>
				
						<?php endwhile; endif; ?>

					</div>

				</div>

			</div>

		</div>

		<!-- Current Relationships -->

		<?php include('-/inc/client-carousel.php'); ?>

	</div>

<?php get_footer(); ?>
