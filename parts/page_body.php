<?php $preamble = get_secondary_content( 'Ingress' );
$appendix = get_secondary_content( 'Appendix' ); ?>

<div class="l-container">
	<div class="l-span-A12 m-article-meta">
		<p class="t-small">
			Publicerad <?php the_time('l j F, Y'); ?>
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
	<div class="l-span-A12 m-the-content" id="the-content">
		<?php the_content(); ?>
		<p>&mdash;</p>
	</div>
	
	<?php if( $appendix ) { ?>
		<div class="l-span-A12 m-appendix" id="resources">
			<h2 class="t-small-title">Appendix</h2>
			<div class="t-small">
				<?php echo $appendix; ?>
			</div>
		</div>
	<?php } ?>
</div>