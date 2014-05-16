<?php /* Template Name: Project-diary */

get_header(); ?>

<article class="m-article" role="main">
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
		
		<?php get_template_part( 'parts/page_body_diary');
		
	}} // end main-loop ?>
	
	<aside class="m-projectdiary-list" id="projectdiary-list" role="complementary">
		<div class="l-container">
			<div class="l-span-A12">
				<h2 class="t-small-title">Projektdagbok</h2>
			</div>
		</div>
		<?php $kategorinamn = get_post_meta($post->ID, 'kategori-namn', true);
	  if ( $kategorinamn ) {
			echo do_shortcode('[postlist cat="'.$kategorinamn.'"]');
		} ?>
	</aside>
</article>

<?php get_footer(); ?>