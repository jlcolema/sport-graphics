<?php
				
	/* get work samples */
	$args = array(
		'numberposts'=>4,
		'post_type'=>'featured_projects',
		'orderby'=>'menu_order',
		'post_status'=>'publish'
	);
	$items = get_posts($args);
	
	echo '<div class="projects featured">';
	echo '<h3 class="section-title">Featured Projects</h3>';
	echo '<ul class="group">';
	
	foreach($items as $item):
	
		// get the id of the project
		$the_id = get_post_meta($item->ID, 'project', true);
		$imageName = '_project_thumbnail';
		if( MultiPostThumbnails::has_post_thumbnail('projects', $imageName, $the_id) ){
			$image_id = MultiPostThumbnails::get_post_thumbnail_id('projects',$imageName,$the_id);
			$image_url = wp_get_attachment_url($image_id);
			
			// get attachment info
			$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		} else {
			$image_url = '';
			$alt = '';
		};
		echo '<li>';
			echo '<a href="' . get_permalink($the_id) . '">';
				echo '<img src="' . $image_url . '" alt="' . $alt . '" />';
				echo '<h3 class="project-title">' . get_the_title($the_id) . '</h3>';
			echo '</a>';
		echo '</li>';
	endforeach;
	echo '</ul>';
	echo '</div>';
	
	
	
	
	
?>