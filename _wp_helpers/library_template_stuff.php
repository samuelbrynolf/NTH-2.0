<?php 
// ---------------------------------------------------------------------------------------------------
// CONDITIONALS
// =================================================================================================== ?>

<?php if(is_front_page()) { ?>
<?php } ?>

<?php if(is_home()) { ?>
<?php } ?>

<?php if(!is_404()) { ?>
<?php } ?>

<?php if (current_user_can( 'manage_options' )) { 
<?php } ?>

<?php if (has_post_thumbnail()) {?>
<?php } ?>

<?php $detect = new Mobile_Detect; // en gång
if ($detect->isMobile()) { ?>
<?php } ?>

<?php if ($detect->isMobile() && !$detect->isTablet()) { ?>
<?php } ?>

<?php if (post_is_in_descendant_category(63)) { // kräver funktion i functions.php ?>
<?php } ?>

<?php if (!post_is_in_descendant_category(9) || current_user_can('delete_users')) { ?>
<?php } ?>

<?php if(is_single() || is_page() && !is_front_page()) { ?>
<?php } ?>

<?php if(get_field('pick_a_post')) { // om ett fält finns i flexible content plugin ?>
<?php } ?>

<?php if (!$detect->isMobile() && is_search() && !have_posts()) { ?>
<?php } ?>



<?php 
// ---------------------------------------------------------------------------------------------------
// LOOPAR
// =================================================================================================== 



// Wp_query / Leta efter en template--------------------------------------------------------------------------------------------------- ?>

<?php $contactpage = new WP_Query( array( 'post_type'  => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'page-contact.php' ) );
while( $contactpage->have_posts() ) { 
	$contactpage->the_post();
	get_template_part( 'exempel');
} wp_reset_postdata(); ?>



<?php // Loopa Custom post type och sortera hiarkiskt (obs justera i functions.php så att att custom post type är hiarkisk isf) ---------------------------------------- ?>

<?php $args = array(
	'post_type' => 'adventurers',
	'orderby' => 'menu_order',
	'order' => 'ASC'
);

$loopadventurers = new WP_Query( $args );
if( $loopadventurers->have_posts() ) { while( $loopadventurers->have_posts() ) { $loopadventurers->the_post(); 
	get_template_part( 'parts/contact-vcard');
}} wp_reset_postdata(); ?>



<?php // Get pages / hämta en enstaka post --------------------------------------------------------------------------------------------------- ?>

<?php global $post;
$args = array('posts_per_page' => 1); 
$custom_posts = get_posts($args);
foreach($custom_posts as $post) { 
	setup_postdata($post);  
} ?>



<?php // Query posts / Paginera inte vanlig loop --------------------------------------------------------------------------------------------------- ?>

<?php query_posts('showposts=-1');
if (have_posts()) { while (have_posts()) { the_post();
	get_template_part( 'exempel'); 
}} ?>



<?php 
// ---------------------------------------------------------------------------------------------------
// CUSTOM MENYER
// =================================================================================================== 



// Kör ut en vanlig meny
// --------------------------------------------------------------------------------------------------- ?>

<?php wp_nav_menu(array('container' => '', 'items_wrap' => '%3$s')); ?>



<?php // Strippa en meny totalt, endast länkar utan klasser körs ut --------------------------------------------------------------------------------------------------- ?>

<?php $menuParameters = array(
	'container'       => false,
	'echo'            => false,
	'items_wrap'      => '%3$s',
	'depth'           => 0,);

echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); ?>



<?php 
// ---------------------------------------------------------------------------------------------------
// SIDEBAR
// =================================================================================================== 



// Skapa en widgetarea --------------------------------------------------------------------------------------------------- ?>

<?php if ( !function_exists('register_sidebar') || !dynamic_sidebar('footer') ) {} ?>



<?php // När man skapat en bloggsida som blir index.php, skriv ut namnet på sidan --------------------------------------------------------------------------------------------------- ?>

<?php echo get_the_title(get_option('page_for_posts')); ?>



<?php 
// ---------------------------------------------------------------------------------------------------
// FUNKTIONSANROP
// =================================================================================================== 



// Hämta children för aktuell sida, om wp_query är bäst -- functions.php --------------------------------------------------------------------------------------------------- ?>

<?php this_page_children2($post->ID); ?>



<?php // Hämta children för aktuell sida, om get_pages är bäst (att föredra) -- functions.php --------------------------------------------------------------------------------------------------- ?>

<?php this_page_children2($post->ID); ?>



<?php // Get part... bara om desktop. Modifiera i functions för mobil och läsplattespecifika templateparts -- functions.php ---------------------------- ?>

<?php UA_desktop_part('bookmark'); ?>



<?php 
// ---------------------------------------------------------------------------------------------------
// IN THE LOOP
// =================================================================================================== 



// När more-taggen inte fungerar... --------------------------------------------------------------------------------------------------- ?>

<?php global $more;
$more = 0; ?>



<?php // Thumbnail URL --------------------------------------------------------------------------------------------------- ?>

<?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" ); ?>
<div style="background-image: url(<?php echo $thumbnail_src; ?>)">
</div>



<?php // Thumbnail + Caption --------------------------------------------------------------------------------------------------- ?>

<figure>
	<?php the_post_thumbnail('large', array('class' => 'l-forcewidth m-blogpost__thumb'));
	echo '<p class="t-fineprint credentials">'.get_post(get_post_thumbnail_id())->post_excerpt.'</p>'; ?>
</figure>



<?php // Custom more-skrift --------------------------------------------------------------------------------------------------- ?>

<?php the_content("[&hellip;] &rarr; " . the_title('', '', false)); ?>



<?php // Bara the content utan formatering --------------------------------------------------------------------------------------------------- ?>

<p><?php echo (get_the_content()); ?></p>



<?php // Bara excerpt utan formatering --------------------------------------------------------------------------------------------------- ?>

<p><?php echo (get_the_excerpt()); ?></p>



<?php // ge mig kategorinamnet utan länk --------------------------------------------------------------------------------------------------- ?>

<?php $category = get_the_category(); 
if ( $category ) {
	echo 'Kategori: '.$category[0]->cat_name.'<br/>';
}

<?php // Utanför loopen... --------------------------------------------------------------------------------------------------- ?>

<?php $kategorinamn = get_post_meta($post->ID, 'kategori-namn', true);
if ( $kategorinamn ) {
	echo do_shortcode('[postlist cat="'.$kategorinamn.'"]');
} ?>

<?php // Taggarna...  --------------------------------------------------------------------------------------------------- ?>

<?php echo strip_tags(get_the_tag_list('',' + ','')); ?>
<?php the_tags('Tags', ' + ', ''); ?>
<?php the_terms( $post->ID, 'superpowers', '', ', ', ' ' ); ?>




<?php 
// ---------------------------------------------------------------------------------------------------
// PLUGINS
// =================================================================================================== 



// Flexible content: templates (http://www.advancedcustomfields.com/add-ons/flexible-content-field/) --------------------------------------------------------------------------------------------------- ?>

<?php if( have_rows('custom_build') ){ while ( have_rows('custom_build') ) { the_row();
 
		if( get_row_layout() == 'full_column' ){
			the_sub_field('full_column_output');
			
		} elseif( get_row_layout() == 'embed_media' ){
			echo '<div class="m-embed">';	
				the_sub_field('embed_media_code');
			echo '</div>';
		
		} elseif( get_row_layout() == 'column_2' ){
			the_sub_field('column_1of2_output');
			the_sub_field('column_2of2_output');
			
		} elseif( get_row_layout() == 'column_2_tipped_left' ){
			echo '<div class="l-container m-column_2_tipped_left">';
				echo '<div class="l-span-A12 l-span-B4 title">'.get_sub_field('column_1of2_tight_output').'</div>';
				echo '<div class="l-span-A12 l-span-B8 descr">'.get_sub_field('column_2of2_wide_output').'</div>';
			echo '</div>';
		
		} elseif( get_row_layout() == 'image_set_3' ){
			get_template_part( 'exempel');
	}
}

// template exempel...

$image_set_1of3 = get_sub_field('image_set_1of3');
$image_set_2of3 = get_sub_field('image_set_2of3');
$image_set_3of3 = get_sub_field('image_set_3of3');

echo '<img src="' . $image_set_1of3['sizes']['medium'] . '" alt="' . $image_set_1of3['alt'] . '" />';
the_sub_field('image_set_3_caption_1');
echo '<img src="' . $image_set_2of3['sizes']['medium'] . '" alt="' . $image_set_2of3['alt'] . '" />';
the_sub_field('image_set_3_caption_2');
echo '<img src="' . $image_set_3of3['sizes']['medium'] . '" alt="' . $image_set_3of3['alt'] . '" />';
the_sub_field('image_set_3_caption_3'); ?>



<?php // Wp pagenavi (http://wordpress.org/plugins/wp-pagenavi/) --------------------------------------------------------------------------------------------------- ?>

<?php if(function_exists('wp_pagenavi')) {
	wp_pagenavi();
} ?>



<?php // Secondary content (http://wordpress.org/plugins/secondary-html-content) --------------------------------------------------------------- ?>

<?php $preamble = get_secondary_content( 'Ingress' );
if ( $preamble ) { 
	echo $preamble;
} ?>



<?php // List pages at depth (http://wordpress.org/plugins/list-pages-at-depth/) 
// addera Simple page ordering för en enkel användarupplevelse för menyer (http://wordpress.org/plugins/simple-page-ordering/) -------------------------------- ?>

<?php list_pages_at_depth(array('startdepth' => 1,'depth' => 1, 'title_li' => '')); ?>
<?php list_pages_at_depth(array('startdepth' => 2,'depth' => 1, 'title_li' => '')); ?>
			
					
	



<?php 
// ---------------------------------------------------------------------------------------------------
// SINGLE+PAGE-GODIS
// =================================================================================================== 

<?php get_header(); ?>

<figure>
	<?php the_post_thumbnail('large', array('class' => 'l-forcewidth m-blogpost__thumb'));
	echo '<p class="t-fineprint credentials">'.get_post(get_post_thumbnail_id())->post_excerpt.'</p>'; ?>
</figure>

<article id="<?php the_ID()?>" class="">
	<header class="m-blogpost__header">
		<h1 class=""><?php the_title();?></h1>
	</header>
	
	<?php if (have_posts()) { while (have_posts()) { the_post();
		edit_post_link('Redigera inl&auml;gg ', '', '');
		echo get_the_time('Y.m.d').' by '.get_the_author();
			if(has_tag()){
				the_tags('Tags', ' + ', '');
			} 
		
		the_content();		
		disqus_embed('exempel'); // msåte finnas i functions
	}} ?>
</article>		

<aside role="complementary">
	<?php get_sidebar();
	if ( !function_exists('register_sidebar') || !dynamic_sidebar('sidebar') ) {} // widget area sidebar ?>
</aside>

<?php posts_related_by_cat($post->ID);

get_footer(); ?>



<?php 
// ---------------------------------------------------------------------------------------------------
// LISTA TAGGAR A-Ö
// ===================================================================================================

<?php $tags = get_tags();
if ($tags) {
	foreach ($tags as $tag) { ?>
	
		<a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php echo sprintf( __( "Se allt inom &auml;mnet %s" ), $tag->name ); ?>" rel="nofollow">
			<h2><?php echo $tag->name ?> <?php echo $tag->count ?></h2>
				<p><?php echo $tag->description ?></p>
		</a>
		
	<?php }
} ?>