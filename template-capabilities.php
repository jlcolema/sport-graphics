<?php

/* Template Name: Capabilities Template */

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

		</article>
		
		<?php endwhile; endif; ?>

		<!-- Capabilities -->

		<div class="capabilities">

			<h3 class="section-title">Capabilities</h3>

			<ul class="group">
				<li><a href="#" class="basic">This is a really long capability</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">If there was ever a capability that could reach this far, boy, that would be one mighty capability.</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Just like the others before, this capability is unique.</a></li>
				<li><a href="#" class="basic">This is a capability that has the capability to be longer than all other capabilities.</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
				<li><a href="#" class="basic">Title</a></li>
			</ul>

			<!-- Modal -->
	
			<div id="modal">
	
				<!-- Slideshow -->
		
				<div class="slideshow project">
		
					<ul class="slides group">
		
						<li class="slide">
		
							<img class="photo" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/slide-example-01.jpg" />
		
							<div class="details group">
		
								<div class="date">
									<span class="day">01</span>
									<span class="sep">/</span>
									<span class="year">12</span>
								</div>
		
								<div class="caption">
		
									<h3>Super Bowl XLVI Indianapolis, JW Marriott Lombardi Trophy</h3>
		
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		
									<p class="more"><a href="#">Visit project</a></p>
		
								</div>
		
							</div>
		
						</li>
		
						<li class="slide">
		
							<img class="photo" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/slide-example-02.jpg" />
		
							<div class="details group">
		
								<div class="date">
									<span class="day">02</span>
									<span class="sep">/</span>
									<span class="year">12</span>
								</div>
		
								<div class="caption">
		
									<h3>Men&rsquo;s Lacrosse Championships 2012</h3>
		
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		
									<p class="more"><a href="#">Visit project</a></p>
		
								</div>
		
							</div>
		
						</li>
		
						<li class="slide">
		
							<img class="photo" src="http://sportg.tunedev.com/wp-content/themes/sg/-/media/slide-example-03.jpg" />
		
							<div class="details group">
		
								<div class="date">
									<span class="day">03</span>
									<span class="sep">/</span>
									<span class="year">12</span>
								</div>
		
								<div class="caption">
		
									<h3>Super Bowl XLVI Indianapolis, JW Marriott Lombardi Trophy</h3>
		
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		
									<p class="more"><a href="#">Visit project</a></p>
		
								</div>
		
							</div>
		
						</li>
		
					</ul>
		
				</div>
	
			</div>
	
			<!-- Preload the Images -->

			<div style="display: none">

				<img src="/wp-content/themes/sg/-/media/close.png" alt="" />

			</div>

		</div>

		<!-- Horizontal Widgets -->
		<?php dynamic_sidebar( 'page-widgets' ); ?>

	</div>

<?php get_footer(); ?>
