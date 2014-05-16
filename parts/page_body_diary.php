<?php $preamble = get_secondary_content( 'Ingress' );
$appendix = get_secondary_content( 'Appendix' ); ?>

<div class="l-container">
	<div class="l-span-A12 m-article-meta">
		<p class="t-small<?php if (in_category( 27 )) { ?> item-type link<?php } ?>">
			Sammanfattning av projektet<br/>
			<a class="jumper" href="#projectdiary-list" rel="nofollow">Visa anteckningar</a>
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
			<div class="t-small">
				<?php echo $appendix; ?>
			</div>
		</div>
	<?php } ?>
</div>