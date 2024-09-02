<?php
				
	/* get work samples */
	$args = array(
		'numberposts'=>-1,
		'post_type'=>'homepage_slideshow',
		'orderby'=>'menu_order',
		'order'=>'desc',
		'post_status'=>'publish'
	);
	$items = get_posts($args);
?>

<div class="slideshow featured">

	<ul class="slides group">

		<?php
			foreach($items as $item):
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'full');
				$image_url = $image_url[0];
				
				echo '<li class="slide">';
			
					echo '<a href="' . get_post_meta($item->ID, 'link_url', true) . '"><img src="' . $image_url . '" alt="' . $item->post_title . '" /></a>';	
											
					echo '<div class="details group">';

						echo '<div class="date">';
							echo '<span class="day">01</span>';
							echo '<span class="sep">/</span>';
							echo '<span class="year">12</span>';
						echo '</div>';

						echo '<div class="caption">';

							echo wpautop($item->post_content);
							
							echo '<p class="more"><a href="' . get_post_meta($item->ID, 'link_url', true) . '">' . get_post_meta($item->ID, 'link_text', true) . '</a></p>';

						echo '</div>';

					echo '</div>';
					
				echo '</li>';
				
			endforeach;
		
		?>

	</ul>
	
</div>