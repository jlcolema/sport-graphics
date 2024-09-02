<?php get_header(); ?>

	<div id="section">

		<h1 id="page-title">SG BLOG - Big projects. Even bigger ideas.</h1>

	</div>

	<div id="primary" class="right-column">
		
		<p>When you do work on a huge scale, it?s bound to get noticed. Here on the SG blog, we like to talk about the projects and ideas that are currently creating a buzz in the industry.</p>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<?php include (TEMPLATEPATH . '/-/inc/meta.php' ); ?>

			<h1 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</article>

		<?php endwhile; ?>

		<?php include (TEMPLATEPATH . '/-/inc/nav.php' ); ?>

		<?php else : ?>
	
			<h2>Not Found</h2>
	
		<?php endif; ?>

	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
