<?php

/* Template Name: FAQ Template */

/* Get Questions */

$args = array(
	'numberposts'=>-1,
	'post_type'=>'faq',
	'orderby'=>'menu_order',
	'post_status'=>'publish'
);
$items = get_posts($args);

?>

<?php get_header(); ?>

	<div id="section">

		<h1 id="page-title"><?php the_title(); ?> <em class="return"><a href="/about">Back to SG Way</a></em></h1>

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

		<article>

			<div class="entry">

				<?php the_content(); ?>

			</div>

		</article>

		<!-- FAQs -->

		<div class="faqs">

			<ul class="group">

				<?php

					foreach($items as $item):

					echo '<li>';

						echo '<h3 class="question">' . $item->post_title . '</h3>';

						echo '<div class="answer">' . wpautop($item->post_content) . '</div>';

					echo '</li>';
						
					endforeach;
				?>

			</ul>

		</div>

		<!-- Horizontal Widgets -->
		<?php dynamic_sidebar( 'page-widgets' ); ?>

	</div>

<?php get_footer(); ?>
