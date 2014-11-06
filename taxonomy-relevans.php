<?php get_header(); 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$termDiscription = term_description( '', get_query_var( 'taxonomy' ) ); ?>
	
	<article id="m-postlist">
		<header class="l-container m-taxonomy-header">
				<div class="l-span-A12">
					<h1 class="t-xlarge">Komponent: <?php echo $term->name; ?></h1>
					<?php if($termDiscription != '') { ?>
						<p class="t-small"><?php echo $termDiscription; ?> <a href="http://note-to-helf.com/komponenter/" title="Se alla komponenter" rel="nofollow">Se &ouml;vriga komponenter</a></p>
					<?php } ?>
				</div>
			</header>
		
		<?php if ( have_posts()) { while ( have_posts() ) { the_post(); 
			$html = get_secondary_content( 'Html', get_the_ID());
			$css = get_secondary_content( 'Sass', get_the_ID());
			$js = get_secondary_content( 'Js', get_the_ID()); 
			$ref = get_secondary_content( 'Referenser', get_the_ID()); ?>

				<div class="l-container m-listitem tag comp no-thumb">
					<section class="l-span-A12 m-entry">
						<h2 class="t-medium"><?php the_title(); ?><span class="sectionToggler">+</span></h2>
					
						<p class="t-small">
							<?php the_terms( $post->ID, 'relevans', '', ' + ' ); ?> <?php echo get_the_content(); ?>
						</p>
						
						<div class="l-container o-code sectionToggled s-is-hidden">
							<div class="l-span-A12">
								<div class="a-code__divider"></div>
							</div>
							<?php if ($html) { ?>
								<div class="l-span-D6">
									<h3>Markup/Backend</h3>
									<div class="m-code__box">
										<?php echo $html; ?>
									</div>
								</div>
							<?php } if ($css) { ?>
								<div class="l-span-D6">
									<h3>Css</h3>
									<div class="m-code__box">
										<?php echo $css; ?>
									</div>
								</div>
							<?php } if ($js && $css) { ?>
									<div class="l-clear l-span">
							<?php } if($js && !$css) { ?>
									<div class="l-span-D6">
							<?php } if($js) { ?>
									<h3>Js</h3>
									<div class="m-code__box">
										<?php echo $js; ?>
									</div>
								</div>
							<?php } if ($ref) { ?>
								<div class="l-clear l-span-A12">
									<h3>Referenser</h3>
									<div class="t-small a-code__ref"><?php echo $ref; ?></div>
								</div>
							<?php } ?>
						</div>
					</section>
				</div>
				
		<?php }} ?>
		
	</article>

<?php get_footer(); ?>