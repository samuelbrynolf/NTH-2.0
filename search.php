<?php get_header(); ?>
	
	<article id="m-postlist">
	
		<header class="l-container m-taxonomy-header">
			<div class="l-span-A12">
				<h1 class="t-xlarge">S&ouml;ktresultat f&ouml;r <?php echo '&#145;'; the_search_query();echo '&#146;'; ?></h1>
				<p class="t-small">Visar <?php echo $wp_query->found_posts ?> tr&auml;ffar</p>
			</div>
		</header>
			
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			if (!post_is_in_descendant_category(9) || current_user_can('delete_users')) {
				get_template_part( 'parts/listitem_full');
			}
			
		endwhile; 
		else : ?>

			<div class="l-container m-listitem s-no-hit">
				<section class="l-span-A12 m-entry">
					<h2 class="t-medium">Pr&ouml;va att stava ditt s&ouml;kord annorlunda...</h2>
					<p class="t-small">
					<a href="<?php bloginfo('url'); ?>" title="Till startsidan f&ouml;r <?php bloginfo('blogtitle'); ?>">Till startsidan</a>
					</p>
					<div class="m-global-search">
						<?php get_search_form(); ?>
					</div>
				</section>
			</div>
		<?php endif; ?>
		
	</article>
	
	<?php get_template_part( 'parts/pagination');
	
get_footer(); ?>