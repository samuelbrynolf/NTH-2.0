<?php /* Template Name: Project-diaries */ 

get_header(); ?>

<article class="m-article diaries" role="main">

	<?php if ( have_posts() ) { while ( have_posts() ) { the_post();
		
		if (has_post_thumbnail()) { ?>
			<figure class="m-article-figure">
				<?php the_post_thumbnail('large', array('class' => 'm-single-thumbnail')); ?>
			</figure>
		<?php } ?>
		
		<header class="l-container m-article-header<?php if (has_post_thumbnail()) { ?> has-thumb<?php } ?>">
			<?php UA_desktop_part('bookmark'); ?>
			<div class="l-span-A12">
				<h1 class="t-large"><?php the_title(); ?></h1>
			</div>
		</header>
		
		<?php get_template_part( 'parts/page_body_diaries');
		
	}} // end main-loop ?>
</article>

<?php this_page_children($post->ID); ?>

<?php get_footer(); ?>