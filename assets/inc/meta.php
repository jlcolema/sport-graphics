<footer class="meta">
	<time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F jS, Y') ?></time>
	<span class="separator">//</span>
	<span class="byline author vcard">
		<i>Posted by</i> <span class="fn"><?php the_author() ?></span> in <span class="category"><?php the_category(', ') ?></span>
	</span>
</footer>