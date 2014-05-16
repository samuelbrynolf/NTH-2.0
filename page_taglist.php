<?php /* Template Name: Taglist */ 
get_header(); ?>
	
	<article id="m-postlist">
		
		<?php $tags = get_tags();
		if ($tags) {
			foreach ($tags as $tag) { ?>

				<div class="l-container m-listitem tag no-thumb">
					<a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php echo sprintf( __( "Se allt inom &auml;mnet %s" ), $tag->name ); ?>" rel="nofollow">
						<section class="l-span-A12 m-entry">
			
							<h2 class="t-medium"><?php echo $tag->name ?> <span>(<?php echo $tag->count ?>)</span></h2>
						
							<p class="t-small">
								<?php echo $tag->description ?>
							</p>
						</section>
					</a>
				</div>
				
			<?php }
		} ?>
		
	</article>

<?php get_footer(); ?>