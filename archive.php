<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	<div id="section">

		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 id="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 id="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 id="page-title">Archive for <?php the_time('F jS, Y'); ?></h2>

		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 id="page-title">Archive for <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 id="page-title" class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 id="page-title" class="pagetitle">Author Archive</h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 id="page-title" class="pagetitle">Blog Archives</h2>

		<?php } ?>

	</div>

	<div id="primary">

		<?php while (have_posts()) : the_post(); ?>
		
			<article <?php post_class() ?>>

				<?php include (TEMPLATEPATH . '/-/inc/meta.php' ); ?>
			
				<h1 class="article-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			
				<div class="entry">
					<?php the_content(); ?>
				</div>

			</article>

		<?php endwhile; ?>

		<?php include (TEMPLATEPATH . '/-/inc/nav.php' ); ?>
	
		<?php else : ?>
	
			<h2>Nothing found</h2>
	
		<?php endif; ?>

	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>