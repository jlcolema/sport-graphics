<?php get_header(); ?>

	<div id="section">

		<h1 id="page-title"><?php the_title(); ?></h1>

		<?php

		global $wp_query;

			if( empty($wp_query->post->post_parent) ) {
				$parent = $wp_query->post->ID;
			} 
			else {
				$parent = $wp_query->post->post_parent;
			} ?>
		
		<?php if(wp_list_pages("title_li=&child_of=$parent&echo=0" )): ?>

		<div id="secondary-pages">

			<ul class="group">
				<?php wp_list_pages("title_li=&child_of=$parent" ); ?>
			</ul>

		</div>

		<?php endif; ?>

	</div>

	<div id="primary">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article>

			<div class="entry">

				<?php the_content(); ?>

			</div>

		</article>

		<?php endwhile; endif; ?>
	
		<?php dynamic_sidebar( 'page-widgets' ); ?>

		<?php /*
			<h3 class="section-title">Featured Projects</h3>

			<ul class="group">

				<li>

					<a href="#">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/related-project-thumb.jpg" alt="Related Project" />

						<h3 class="project-title">Indianapolis Super Bowl XLVI</h3>

					</a>

				</li>

				<li>

					<a href="#">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/related-project-thumb.jpg" alt="Related Project" />

						<h3 class="project-title">Indianapolis Super Bowl XLVI</h3>

					</a>

				</li>

				<li>

					<a href="#">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/related-project-thumb.jpg" alt="Related Project" />

						<h3 class="project-title">Indianapolis Super Bowl XLVI</h3>

					</a>

				</li>

				<li>

					<a href="#">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/related-project-thumb.jpg" alt="Related Project" />

						<h3 class="project-title">Indianapolis Super Bowl XLVI</h3>

					</a>

				</li>

			</ul>
			
			*/ ?>

	</div>

<?php get_footer(); ?>
