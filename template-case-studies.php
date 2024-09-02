<?php

/* Template Name: Case Studies Template */

/* Get Questions */

$args = array(
	'numberposts'=>-1,
	'post_type'=>'case_studies',
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

		<article>

			<div class="entry">

				<?php the_content(); ?>

			</div>

		</article>

		<!-- FAQs -->

		<div class="case-studies">

			<ul class="group">

				<li class="group">

					<h3 class="client">Client</h3>

					<div class="details">
	
						<div class="detail">
	
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in ipsum sit amet orci adipiscing luctus et at mi. Morbi ornare, nulla in tristique hendrerit, ante nunc interdum elit, ac luctus tortor est facilisis arcu. Nam placerat felis non velit luctus elementum. Proin sapien mauris, bibendum vel cursus at, tincidunt quis mi. Morbi mattis blandit magna a condimentum. Donec adipiscing ipsum sit amet magna tincidunt vitae commodo nunc bibendum. Quisque mattis tempus dui, non sodales risus viverra ut. Quisque placerat fringilla ipsum sed hendrerit. Fusce at sem lectus. Maecenas tincidunt consectetur tortor cursus varius. Quisque velit nunc, congue sed lacinia vel, mollis et arcu. Quisque hendrerit mi sagittis ante convallis quis rhoncus nisi tincidunt.</p>
							
							<p>Aenean in nisi augue. Nam vel nisl eget nulla volutpat fringilla. In elementum consequat tempus. Mauris in lacus tellus, eget bibendum ligula. Suspendisse lacus augue, egestas posuere aliquet nec, placerat pretium metus. Donec lacinia purus ac metus accumsan eu sagittis eros accumsan. In pulvinar mi hendrerit sem luctus in auctor libero vehicula. Morbi varius tempor nunc eu elementum.</p>
	
						</div>

						<p class="pdf"><a href="#">Download our client Case Study</a></p>

					</div>

					<div class="thumbnails">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

					</div>

				</li>

				<li class="group">

					<h3 class="client">Client</h3>

					<div class="details">
	
						<div class="detail">
	
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in ipsum sit amet orci adipiscing luctus et at mi. Morbi ornare, nulla in tristique hendrerit, ante nunc interdum elit, ac luctus tortor est facilisis arcu. Nam placerat felis non velit luctus elementum. Proin sapien mauris, bibendum vel cursus at, tincidunt quis mi. Morbi mattis blandit magna a condimentum. Donec adipiscing ipsum sit amet magna tincidunt vitae commodo nunc bibendum. Quisque mattis tempus dui, non sodales risus viverra ut. Quisque placerat fringilla ipsum sed hendrerit. Fusce at sem lectus. Maecenas tincidunt consectetur tortor cursus varius. Quisque velit nunc, congue sed lacinia vel, mollis et arcu. Quisque hendrerit mi sagittis ante convallis quis rhoncus nisi tincidunt.</p>
							
							<p>Aenean in nisi augue. Nam vel nisl eget nulla volutpat fringilla. In elementum consequat tempus. Mauris in lacus tellus, eget bibendum ligula. Suspendisse lacus augue, egestas posuere aliquet nec, placerat pretium metus. Donec lacinia purus ac metus accumsan eu sagittis eros accumsan. In pulvinar mi hendrerit sem luctus in auctor libero vehicula. Morbi varius tempor nunc eu elementum.</p>
	
						</div>

						<p class="pdf"><a href="#">Download our client Case Study</a></p>

					</div>

					<div class="thumbnails">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

					</div>

				</li>

				<li class="group">

					<h3 class="client">Client</h3>

					<div class="details">
	
						<div class="detail">
	
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in ipsum sit amet orci adipiscing luctus et at mi. Morbi ornare, nulla in tristique hendrerit, ante nunc interdum elit, ac luctus tortor est facilisis arcu. Nam placerat felis non velit luctus elementum. Proin sapien mauris, bibendum vel cursus at, tincidunt quis mi. Morbi mattis blandit magna a condimentum. Donec adipiscing ipsum sit amet magna tincidunt vitae commodo nunc bibendum. Quisque mattis tempus dui, non sodales risus viverra ut. Quisque placerat fringilla ipsum sed hendrerit. Fusce at sem lectus. Maecenas tincidunt consectetur tortor cursus varius. Quisque velit nunc, congue sed lacinia vel, mollis et arcu. Quisque hendrerit mi sagittis ante convallis quis rhoncus nisi tincidunt.</p>
							
							<p>Aenean in nisi augue. Nam vel nisl eget nulla volutpat fringilla. In elementum consequat tempus. Mauris in lacus tellus, eget bibendum ligula. Suspendisse lacus augue, egestas posuere aliquet nec, placerat pretium metus. Donec lacinia purus ac metus accumsan eu sagittis eros accumsan. In pulvinar mi hendrerit sem luctus in auctor libero vehicula. Morbi varius tempor nunc eu elementum.</p>
	
						</div>

						<p class="pdf"><a href="#">Download our client Case Study</a></p>

					</div>

					<div class="thumbnails">

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

						<img src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/tab-image-example.jpg" title="Title" />

					</div>

				</li>

				<!-- <?php

					foreach($items as $item):

					echo '<li class="group">';

						echo '<h3 class="client">' . $item->post_title . '</h3>';

						echo '<div class="detail">' . wpautop($item->post_content) . '</div>';

					echo '</li>';

					endforeach;

				?> -->

			</ul>

		</div>

		<!-- Current Relationships -->

		<?php include('-/inc/client-carousel.php'); ?>

	</div>

<?php get_footer(); ?>
