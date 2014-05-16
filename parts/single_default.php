<?php $category = get_the_category();
$preamble = get_secondary_content( 'Ingress' );
$appendix = get_secondary_content( 'Appendix' ); ?>

<div class="l-container">
	<div class="l-span-A12 m-article-meta">
		<p class="t-small">
			<?php if (post_is_in_descendant_category( 63 )) {
				edit_post_link('Redigera inl&auml;gg ', '', '');
				echo 'Publicerad '.get_the_time('l j F, Y').'<br/>';
				echo 'Projektdagbok: <a href="'.get_bloginfo('url').'/projektdagbocker/'.$category[0]->cat_name.'" title="Se hela projektdagboken f&ouml;r '.$category[0]->cat_name.'">'.$category[0]->cat_name.'</a><br/>'; 
				if(has_tag()){ ?>
					&Auml;mnen: <?php the_tags('',' + ');
				} 
			} else { 
				edit_post_link('Redigera inl&auml;gg ', '', '');
				echo 'Publicerad '.get_the_time('l j F, Y').'<br/>';
				if(has_tag()){
					echo '&Auml;mnen: ';
					the_tags('',' + ');
				}
			} ?>
		</p>
	</div>
	
	<?php if ( $preamble ) { ?>
		<div class="l-span-A12 t-preamble">
			<?php echo $preamble; ?>
		</div>
	<?php } else { ?>
		<div class="l-span-A12">
			<div class="m-divider"></div>
		</div>
	<?php } ?>
</div>

<div class="l-container">
	<?php if( $appendix ) { ?>
		<div class="l-span-A12 l-span-D8 m-the-content" id="the-content">
	<?php } else { ?>
		<div class="l-span-A12 m-the-content" id="the-content">
	<?php }  
		the_content(); ?>
		<p>&mdash;</p>
	</div>
	
	<?php if( $appendix ) { ?>
		<div class="l-span-A12 l-span-D4 m-appendix" id="resources">
			<h2 class="t-small-title">Appendix</h2>
			<div class="t-small">
				<?php echo $appendix; ?>
			</div>
		</div>
	<?php } ?>
</div>