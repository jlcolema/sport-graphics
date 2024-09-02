<?php get_header(); ?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="section">

		<h1 id="page-title"><?php the_title(); ?></h1>

		<p class="return"><a href="/projects">Back to Projects</a></p>

	</div>

	<div id="primary">

		<article class="post" id="post-<?php the_ID(); ?>">

			<!-- Slideshow -->
	
			<div class="slideshow project loading">
	
				<ul class="slides group">
					<?php
						
						for($i=1; $i < 11; $i++){
							$imageName = 'featured_image_'.$i;
							$imageNamePopup = 'featured_image_'.$i.'_popup';
							if( MultiPostThumbnails::has_post_thumbnail('projects', $imageName, $id) ){
								$image_id = MultiPostThumbnails::get_post_thumbnail_id('projects',$imageName,$id);
								$image_url = wp_get_attachment_url($image_id, 'full');
								
								// get attachment info
								$attachment = get_post($image_id);
								$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
								
								// if there is a popup image
								if( MultiPostThumbnails::has_post_thumbnail('projects', $imageNamePopup, $id) ){
									$image_id_popup = MultiPostThumbnails::get_post_thumbnail_id('projects',$imageNamePopup,$id);
									$image_url_popup = wp_get_attachment_url($image_id_popup, 'full');
								} else {
									$image_id_popup = '';
									$image_url_popup = '';
								}
								     
								echo '<li class="slide">';
								
									if ($image_url_popup && strlen($image_url_popup)) {
										
										echo '<a href="' . $image_url_popup . '" class="basic">';
									
									}

									echo '<img class="photo" src="' . $image_url . '" title="' . $attachment->post_title . '" alt="' . $alt . '" />';
								
									if ($image_url_popup && strlen($image_url_popup)) {
										
										echo '</a>';
									
									}

								echo '</li>';

							}
						}
					?>
				</ul>
	
			</div>
	
			<div class="entry">
	
				<?php the_content(); ?>
	
			</div>

			<!-- Modal -->
	
			<div id="modal">
	
				<div class="inner-content">
				
					<div class="content">
	
						<img class="photo" src="/assets/Red_Bull_Moto_GP_1_popup.jpg" />
	
						<a class="modalCloseImg simplemodal-close"></a>
						
					</div>
					
				</div>
	
			</div>

		</article>

		<!-- Preload the Images -->

		<div style="display: none">

			<img src="/wp-content/themes/sg/-/media/close.png" alt="" />

		</div>

		<!-- Featured Projects -->
	
		<div class="projects related">
		
			<?php
			
			$connected = new WP_Query( array(
			  'connected_type' => 'projects_to_projects',
			  'connected_items' => get_queried_object(),
			  'nopaging' => true
			) );
			
			// Display connected pages
			if ( $connected->have_posts() ) {
				echo '<h3 class="section-title">Related Projects</h3>';
				echo '<ul class="group">';
					while ( $connected->have_posts() ) : $connected->the_post();
						$imageName = '_project_thumbnail';
						if( MultiPostThumbnails::has_post_thumbnail('projects', $imageName, $post->ID) ){
							$image_id = MultiPostThumbnails::get_post_thumbnail_id('projects',$imageName,$post->ID);
							$image_url = wp_get_attachment_url($image_id, $imageName);
							
							// get attachment info
							$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
						} else {
							$image_url = '';
							$alt = '';
						};
						echo '<li>';
							echo '<a href="' . get_permalink() . '">';
								echo '<img src="' . $image_url . '" alt="' . $alt . '" />';
								echo '<h3 class="project-title">' . get_the_title() . '</h3>';
							echo '</a>';
						echo '</li>';
					endwhile;
				echo '</ul>';
				
				// Prevent weirdness
				wp_reset_postdata();
				
			}
			
			?>
	
			</ul>
	
		</div>
	
		<!-- Current Relationships -->
	
		<?php include('-/inc/client-carousel.php'); ?>

	</div>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
