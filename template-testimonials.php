<?php

/* Template Name: Testimonials Template */

/* Get Testimonials */

$args = array(
	'numberposts'=>-1,
	'post_type'=>'testimonials',
	'orderby'=>'menu_order',
	'post_status'=>'publish'
);
$items = get_posts($args);

?>

<?php get_header(); ?>

	<div id="section">

		<h1 id="page-title"><?php the_title(); ?> <em class="return"><a href="/about">Back to About</a></em></h1>

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

			<div class="testimonials">

				<ul class="group">
	
					<?php

						foreach($items as $item):

						echo '<li>';

							echo '<q class="testimonial">' . wpautop($item->post_content) . '</q>';

							echo '<cite>';
							
								echo '<span class="author">' . get_post_meta($item->ID, 'testimonial_author', true) . '</span>';

								echo '<span class="join">, </span>';

								echo '<span class="source">' . get_post_meta($item->ID, 'testimonial_source', true) . '</span></cite>';

							echo '</cite>';

						echo '</li>';
							
						endforeach;
					?>
	
				</ul>
	
			</div>

		</article>
		
		<?php endwhile; endif; ?>

		<!-- Horizontal Widgets -->
		<?php dynamic_sidebar( 'page-widgets' ); ?>

	</div>

<?php get_footer(); ?>
