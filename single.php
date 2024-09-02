<?php get_header(); ?>

	<div id="section">

		<h1 id="article-title"><?php the_title(); ?></h1>

	</div>

	<div id="primary">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<div class="entry">

				<?php include (TEMPLATEPATH . '/-/inc/meta.php' ); ?>

				<h1 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

				<?php the_tags( 'Tags: ', ', ', ''); ?>

			</div>

			<div class="share">

				<span class='st_facebook_hcount' displayText='Facebook'></span>
				<span class='st_twitter_hcount' displayText='Tweet'></span>

			</div>

		</article>

		<?php endwhile; endif; ?>

	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>