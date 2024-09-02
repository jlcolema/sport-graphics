<?php
				
	/* get work samples */
	$args = array(
		'numberposts'=>-1,
		'post_type'=>'clients',
		'orderby'=>'rand',
		'post_status'=>'publish'
	);
	$items = get_posts($args);
?>

<div class="carousel relationships">

	<h3 class="section-title">Current Relationships</h3>

	<ul class="slides group">

		<?php
			foreach($items as $item):
				echo '<li>';
			
					$imageName = 'client_thumbnail';
					if( MultiPostThumbnails::has_post_thumbnail('clients', $imageName, $item->ID) ){
						$image_id = MultiPostThumbnails::get_post_thumbnail_id('clients',$imageName,$item->ID);
						$image_url = wp_get_attachment_url($image_id, 'large_featured');
					
						// find out if there is a project for this client that we can link to
						$Q = new GetPostsQuery();
						$Q->post_type = 'projects';
						$Q->client = $item->ID;
						$results = $Q->get_posts();
	
						// output client
						if ( count($results) > 0 ) {
							echo '<a href="' . get_permalink($item->ID) . '"><img src="' . $image_url . '" alt="' . $item->post_title . '" /></a>';	
						} else {
							echo '<a href="javascript:;"><img src="' . $image_url . '" alt="' . $item->post_title . '" /></a>';
						}
						
					}
					
				echo '</li>';
				
			endforeach;
		
		?>

	</ul>

</div>