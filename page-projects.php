<?php

/* Template Name: Projects Template */
				
	/* get work samples */
	$args = array(
		'numberposts'=>-1,
		'post_type'=>'projects',
		'orderby'=>'menu_order',
		'order'=>'ASC',
		'post_status'=>'publish'
	);
	$items = get_posts($args);

?>
<?php get_header(); ?>

	<div id="section">

		<h2 id="page-title"><?php the_title(); ?></h2>
		<div id="categories">

			<ul class="group option-set" data-option-key="filter">
				<li class="active"><a href="#filter" data-option-value="*">All Work</a></li>
				<?php
					$terms = get_terms( 'project_type' );
					foreach($terms as $term):
						echo '<li><a href="#filter" data-option-value=".' . $term->slug . '">' . $term->name . '</a></li>';
					endforeach;
					
				?>
			</ul>

		</div>

	</div>

	<div id="primary">

		<article class="post" id="post-<?php the_ID(); ?>">

			<div class="entry">

				<?php wp_reset_query(); the_content(); ?>

			</div>

		</article>

		<!-- Project List -->

		<div id="container" class="projects main">

			<ul class="group">

				<?php
					foreach($items as $item):
						
						$imageName = '_project_thumbnail';
						if( MultiPostThumbnails::has_post_thumbnail('projects', $imageName, $item->ID) ){
							$image_id = MultiPostThumbnails::get_post_thumbnail_id('projects',$imageName,$item->ID);
							$image_url = wp_get_attachment_url($image_id, 'full');
						} else {
							$image_url = '';
						};
						

						echo '<li class="element ';
						
						$terms = wp_get_post_terms($item->ID, 'project_type');
						foreach($terms as $term):
							echo ' ' . $term->slug . ' ';
						endforeach;
						echo 'data-category="' . $term->slug . '"';
						echo '">';

							echo '<a href="' . get_permalink($item->ID) . '">';

								echo '<div class="thumbnail">';

									echo '<img src="' . $image_url . '" />';

								echo '</div>';

								echo '<h3 class="project-title">' . $item->post_title . '</h4>';

							echo '</a>';

						echo '</li>';
						
					endforeach;
				?>

			</ul>

		</div>

	</div>

<?php get_footer(); ?>
