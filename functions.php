<?php // INITS, REGISTER AND SUPPORT
//====================================================================

function register_my_menu(){
	register_nav_menu('navigation', __('Huvudnavigation'));
}
add_action('init', 'register_my_menu');

//-------------------------------------------------------------------

if ( function_exists('register_sidebar')){
	register_sidebar(array(
		'name'=>'Footer',
		'description' => 'Footerinfo',
		'before_title' => '<h2 class="t-medium">',
		'after_title' => '</h2>',
		'before_widget' => '<li class="l-span-A12 m-footerwidget">',
		'after_widget' => '</li>',
	));
}
		
//-------------------------------------------------------------------
		
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	//add_theme_support( 'post-formats', array('aside'));
}

//-------------------------------------------------------------------

require_once 'parts/Mobile_Detect.php';

//-------------------------------------------------------------------

function script_handler(){
	
	//register and enqueue specific jquery version
	if( !is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, true);
		wp_enqueue_script('jquery');
	}
	
	//register scripts
	wp_register_script('scripts', get_template_directory_uri() . '/js/bundled.min.js', array('jquery'), null, true);
	
	//enqueue scripts along with condiotionals
	
	wp_enqueue_script('scripts');
}

add_action( 'wp_enqueue_scripts', 'script_handler' );

//yarpp bugfix
function dequeue_footer_styles() {
  wp_dequeue_style('yarppRelatedCss');
  wp_deregister_style('yarppRelatedCss');
}

add_action('get_footer','dequeue_footer_styles');

//-------------------------------------------------------------------

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



//FILTER-FUNCTIONS
//====================================================================

function complete_version_removal() {
	return '';
}
add_filter('the_generator', 'complete_version_removal');

//-------------------------------------------------------------------

remove_filter('term_description','wpautop');

//-------------------------------------------------------------------

function add_custom_body_class($classes) {
	if (is_single() && has_post_thumbnail()) $classes[] = 'has-thumb';
	return $classes;
}
add_filter('body_class', 'add_custom_body_class');

//-------------------------------------------------------------------

function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

//-------------------------------------------------------------------

function trim_private_titles($string) {
$string = str_replace("Privat: ", "&#126; ", $string);
return $string;
}
add_filter('the_title', 'trim_private_titles');



// FUNCTIONS
//====================================================================

if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}

//-------------------------------------------------------------------

function fixed_img_caption_shortcode($attr, $content = null) {
	// New-style shortcode with the caption inside the shortcode with the link and image tags.
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');

//-------------------------------------------------------------------

function this_page_children($postID){
	$children = get_pages( array( 'child_of' => $postID, 'sort_column' => 'post_date', 'sort_order' => 'asc' ) );
	echo '<ul class="l-container m-listitem-figure-list">';
		foreach( $children as $page ) {		
			$excerpt = $page->post_excerpt;
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
			if ( ! $excerpt ) // Check for empty page
			continue;
			$excerpt = apply_filters( 'the_content', $excerpt );
			echo '<li class="l-span-A12 l-span-B6 m-listitem-figure"><a href="'.get_page_link( $page->ID ).'">';
				if ( $thumbnail ) {
					echo '<figure><img src="'.$thumbnail[0].'" alt="" /></figure>'; 
				} 
			echo '<div class="heightcontrol"><h2 class="t-medium">'.$page->post_title.'</h2>'.$excerpt.'</div><p class="itembreak"><br/>&mdash;</p></a></li>';
		}
	echo '</ul>';
}

//-------------------------------------------------------------------

function sc_list($atts, $content = null) {
  extract(shortcode_atts(array(
          "cat" => ''
  ), $atts));
  
	$custom_query = new WP_Query('nopaging=true&order=ASC&category_name='.$cat); 
	if (!post_is_in_descendant_category(9) || current_user_can('delete_users')) {
		while($custom_query->have_posts()) : $custom_query->the_post();
			get_template_part('parts/listitem_diary');
		endwhile;
		wp_reset_postdata(); // reset the query 
	}
 
} add_shortcode('postlist', 'sc_list');

//-------------------------------------------------------------------

function related_diaryposts($postID){
	$related = get_posts( array( 'category__in' => wp_get_post_categories($postID), 'numberposts' => -1, 'order' => 'ASC', 'post__not_in' => array($postID) ) );
	$wpcats = wp_get_post_categories($postID);
	global $post;
	setup_postdata($post);
	$cats = array();
	foreach ($wpcats as $c) {
		$cats[] = get_cat_name( $c );
	}
	echo '<aside class="m-projectdiary-list" id="projectdiary-list" role="complementary">';
	echo '<div class="l-container"><div class="l-span-A12"><h2 class="t-small-title">Projektdagbok: '.$lister = implode(",", $cats).'</h2></div></div>';
	
	if( $related ) foreach( $related as $post ) {
		get_template_part('parts/listitem_diary'); 
	}
	echo '</aside>';
	wp_reset_postdata();
}

//-------------------------------------------------------------------

function my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'my_add_excerpts_to_pages' );

//-------------------------------------------------------------------

function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

//-------------------------------------------------------------------

function UA_desktop_part($partial){
	$detect = new Mobile_Detect;
	
	if (!$detect->isMobile()) {
		get_template_part('parts/'.$partial);
	}
}

function new_excerpt_more($more) {
       global $post;
	return '&hellip; <span class="t-small highlight">Hela inl&auml;gget &#8594;</span>';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>