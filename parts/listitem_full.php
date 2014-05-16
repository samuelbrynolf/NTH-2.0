<?php $category = get_the_category(); ?>

<div class="l-container m-listitem no-thumb">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'L&auml;nk till: ', 'after' => '' ) ); ?>">
		<section class="l-span-A12">
			<div class="l-container">
				
				<div class="l-span-D5">
					<h2 class="t-medium"><?php if (post_is_in_descendant_category( 63 )) { ?><span><?php echo $category[0]->cat_name ?></span><?php } ?> <?php the_title(); ?></h2>
					<p class="t-small">
						<?php if(is_search()){
							echo 'Publicerad '.get_the_time('l j F, Y').'<br/>';
							if ( $category ) {
								echo 'Kategori: '.$category[0]->cat_name.'<br/>';
							} if (has_tag()) {
				  			echo '&Auml;mnen: '.strip_tags(get_the_tag_list('',' + ','')); 
				  		} 
				  		
			  		} else {
			  			echo get_the_time('l j F, Y').'<br/>';
					  	echo strip_tags(get_the_tag_list('',' + ',''));
			  		} // end if search ?>
					</p>
				</div>
				
				<div class="l-span-D7">
					<p class="m-excerpt"><?php echo (get_the_excerpt()); ?></p>
				</div>
				
			</div>
		</section>
	</a>
</div>