<div class="l-container m-listitem no-thumb">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'L&auml;nk till: ', 'after' => '' ) ); ?>">
		<section class="l-span-A12">
			<div class="l-container">
				
				<div class="l-span-D5">
					<h2 class="t-medium"><?php the_title(); ?></h2>
					<p class="t-small">
						<?php echo get_the_time('l j F, Y').'<br/>';
						if (has_tag()) {
			  			echo strip_tags(get_the_tag_list('',' + ','')); 
			  		} ?>
					</p>
				</div>
				
				<div class="l-span-D7">
					<p class="m-excerpt"><?php echo (get_the_excerpt()); ?></p>
				</div>
			</div>
		</section>
	</a>
</div>