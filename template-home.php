<?php

/* Template Name: Home Template */

?>

<?php get_header(); ?>

	<div id="section" class="description">

		<h2 id="page-title">Turning our creativity and experience into your results, <strong>the SG way.</strong></h2>

	</div>

	<div id="primary">

		<!-- Slideshow -->

		<div class="slideshow featured loading">

			<?php
			
				$args = array(
			
					'numberposts'=>-1,
					'post_type'=>'homepage_slideshow',
					'orderby'=>'menu_order',
					'post_status'=>'publish'
			
				);
				
				$items = get_posts($args);
			
			?>

			<ul class="slides group">

				<?php

					foreach($items as $item):
						
						echo '<li class="slide">';

							echo '<img class="photo" src="' . wp_get_attachment_url( get_post_thumbnail_id($item->ID) ) . '" />';
								
							echo '<div class="details group">';
								
								echo '<div class="date">';
								
									echo '<span class="day">' . mysql2date('m', $post->post_date) . '</span>';
									echo '<span class="sep">/</span>';
									echo '<span class="year">' . mysql2date('y', $post->post_date) . '</span>';

								echo '</div>';

								echo '<div class="caption">';

									echo '<h3>' . $item->post_title . '</h3>';

									echo '<p>' . $item->post_content . '</p>';

									echo '<p class="more"><a href="' . get_post_meta($item->ID, link_url, true) . '">' . get_post_meta($item->ID, link_text, true) . '</a></p>';

								echo '</div>';

							echo '</div>';
									
						echo '</li>';
						
					endforeach;

				?>

			</ul>

		</div>

		<!-- Expertise -->

		<div class="tabs expertise group">

			<h3 class="section-title">Expertise <a href="/blog">Visit Blog</a></h3>

			<div id="tab_horizontal" class="tab_horizontal group">                                                

				<!-- Tabs -->

				<div class="tab_tabs_container">                                                                                                                                          

					<a href="#prev" class="tab_prev"></a>

					<div class="tab_slide_container">
		
						<?php

							$args = array(
								'numberposts'=>5,
								'post_type'=>'homepage_tabs',
								'orderby'=>'menu_order',
								'post_status'=>'publish'
							);
							$items = get_posts($args);
							
							$counter = 0;
							
						?>

						<ul class="tab_tabs group">
	
						<?php foreach($items as $item): $counter++; ?>
						
							<li><a href="#tab-0<?php echo $counter; ?>" rel="tab_<?php echo $counter; ?>" class="tab_tab <?php if( $counter == 1 ) { echo 'tab_first_tab tab_tab_active'; } ?>"><?php echo $item->post_title; ?></a></li>
							
						<?php endforeach; $counter = 0; ?>
			
						</ul>

					</div>

					<a href="#next" class="tab_next"></a>                                                                                                

				</div>

				<!-- Slides -->

				<div class="tab_view_container">                    
            
					<div class="tab_view"> 
		
						<?php 
							foreach($items as $item):
								$counter++;
								$image_id = get_post_thumbnail_id($item->ID);
								$image_url = wp_get_attachment_url($image_id, 'full'); ?>
						
						<div id="tab-0<?php echo $counter; ?>" class="tab_tab_view <?php if( $counter == 1 ) { echo 'tab_first_tab_view'; } ?>">
                    
							<div class="text">

								<img class="alignleft" src="<?php echo $image_url; ?>" alt="" />
								<?php /* echo get_the_post_thumbnail($item->ID, 'full'); */ ?>

								<?php echo wpautop($item->post_content); ?>

								<p class="more"><a href="<?php echo get_post_meta($item->ID, link_url, true); ?>">Read More</a></p>

							</div>                            

						</div>
						
						<?php endforeach; ?>  
						
					</div>
                                
				</div>
				
				<?php /*
				
				<div class="tab_view_container">                    
            
					<div class="tab_view">                 
                        
						<div id="tab-01" class="tab_tab_view tab_first_tab_view">
                    
							<div class="text">

								<img class="alignleft" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p class="more"><a href="/">Read More</a></p>

							</div>                            

						</div>

						<div id="tab-02" class="tab_tab_view">
                    
							<div class="text">

								<img class="alignright" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p class="more"><a href="/">Read More</a></p>

							</div>                            

						</div>
                
						<div id="tab-03" class="tab_tab_view">
                    
							<div class="text">

								<img class="alignleft" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p class="more"><a href="/">Read More</a></p>

							</div>                            

						</div>
                
						<div id="tab-04" class="tab_tab_view">
                    
							<div class="text">

								<img class="alignright" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p class="more"><a href="/">Read More</a></p>

							</div>                            

						</div>

						<div id="tab-05" class="tab_tab_view">
                    
							<div class="text">

								<img class="alignleft" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus scelerisque nulla luctus placerat. Vivamus posuere aliquet pellentesque. Etiam iaculis, neque consequat imperdiet consequat, enim sapien commodo orci, ac dignissim elit purus sit amet nisi.</p>

								<p class="more"><a href="/">Read More</a></p>

							</div>                            

						</div>

					</div>
                                
				</div>
				
				*/ ?>
				
			</div>

		</div>

		<section class="columns group">

			<!-- SportG News Feed -->
	
			<div class="column feed">

				<h3 class="section-title">SportG News Feed <a href="/blog">Visit Blog</a></h3>

				<div class="container">

					<?php 

						$args = array( 'numberposts' => 4, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
						$postslist = get_posts( $args );

						foreach ($postslist as $post) : setup_postdata($post); ?>

						<article id="post-<?php the_ID(); ?>" class="post eq">

							<div class="inner-wrap">

								<h2 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

								<div class="excerpt"><?php the_excerpt('10') ?></div>

								<?php include (TEMPLATEPATH . '/-/inc/meta.php' ); ?>

							</div>

						</article>

					<?php endforeach; ?>

				</div>

			</div>

			<!-- Testimonials -->

			<div class="column testimonials">

				<h3 class="section-title">Testimonials <a href="/about/testimonials">Visit Archive</a></h3>

				<div class="container">

					<ul class="group">
		
						<?php

							$args = array(
								'numberposts'=>3,
								'post_type'=>'testimonials',
								'orderby'=>'menu_order',
								'post_status'=>'publish'
							);
							$items = get_posts($args);
	
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

			</div>

		</section>

		<!-- Current Relationships -->
		
		<?php dynamic_sidebar( 'page-widgets' ); ?>

	</div>

<?php get_footer(); ?>
