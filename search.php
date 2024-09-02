<?php get_header(); ?>

	<div id="section">

		<h1 id="page-title">Search Results</h1>

	</div>

	<div id="primary">

		<?php if (have_posts()) : ?>
	
			<?php while (have_posts()) : the_post(); ?>
	
				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<?php include (TEMPLATEPATH . '/-/inc/meta.php' ); ?>

					<h2 class="article-title"><?php the_title(); ?></h2>
		
					<div class="entry">
	
						<?php the_excerpt(); ?>
	
					</div>
	
				</article>
	
			<?php endwhile; ?>
	
			<?php include (TEMPLATEPATH . '/-/inc/nav.php' ); ?>
	
		<?php else : ?>
	
			<h2>No posts found.</h2>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<?php endif; ?>

	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
