<?php get_header(); 
$html = get_secondary_content( 'Html', get_the_ID());
$css = get_secondary_content( 'Sass', get_the_ID());
$js = get_secondary_content( 'Js', get_the_ID());
$ref = get_secondary_content( 'Referenser', get_the_ID());
if (have_posts()) { while (have_posts()) { the_post();?>
<article class="m-article" role="main">
	<div class="l-container">
		<header class="m-article-header">
			<?php UA_desktop_part('bookmark'); ?>
			<div class="l-span-A12">
				<h1 class="t-large"><?php the_title(); ?></h1>
			</div>
		</header>
		
		<div class="l-span-A12">
			<div class="m-article-meta">
				<p class="t-small">
					<?php edit_post_link('Redigera inl&auml;gg ', '', '');
					//echo 'Publicerad '.get_the_time('l j F, Y').'<br/>';
					echo 'Publicerad f&ouml;r '.human_time_diff(get_the_time('U'), current_time('timestamp')).' sedan<br/>';
					the_terms( $post->ID, 'komponent', '', ' + ' ); ?> + <a href="http://note-to-helf.com/komponenter/" title="Se alla komponenter" rel="nofollow">Se alla komponenter</a>
				</p>
			</div>
		</div>
		
		<div class="l-span-A12">
			<div class="m-divider"></div>
		</div>
		
		<div class="l-span-A12 m-the-content" id="the-content">
			<?php the_content(); ?>
			<div class="l-container o-code single">
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
		</div>
	</div>
</article>
<?php }}
get_footer(); ?>