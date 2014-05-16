<?php $category = get_the_category(); ?>

<div class="m-listitem has-thumb">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'L&auml;nk till: ', 'after' => '' ) ); ?>">
		<figure>
			<?php the_post_thumbnail('large', array('class' => 'm-listitem-thumbnail')); ?>
		</figure>
		<section class="m-entry">
			<h2 class="t-medium"><?php if(!is_category() && post_is_in_descendant_category( 63 )){?><span><?php echo $category[0]->cat_name ?></span><?php } ?> <?php the_title(); ?></h2>
			<p class="t-small">
				<?php echo get_the_time('l j F, Y').'<br/>';
		  	echo strip_tags(get_the_tag_list('',' + ','')); ?>
			</p>
		</section>
	</a>
</div>