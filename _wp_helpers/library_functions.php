<?php 

// Best practice: wrap custom functions inside conditionals. They should be able to get overidden by child themes:

//if (!function_exists('example')) {
	//function example(){
	
	//}
//}


// INITS, REGISTER AND SUPPORT
//====================================================================

function register_my_menu(){
	register_nav_menu('navigation', __('Huvudnavigation'));
}
add_action('init', 'register_my_menu');

//-------------------------------------------------------------------

if ( function_exists('register_sidebar')){
	register_sidebar(array(
		'name'=>'Sidebar',
		'before_title' => '<h3 class="t-small">',
		'after_title' => '</h3>',
		'before_widget' => '<li class="m-sidebar__widget">',
		'after_widget' => '</li>',
	));
	
	register_sidebar(array(
		'name'=>'Footer',
		'before_title' => '<h3 class="t-small">',
		'after_title' => '</h3>',
		'before_widget' => '<div class="m-footer__widget">',
		'after_widget' => '</div>',
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
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, true);
		wp_enqueue_script('jquery');
	}
	
	//register scripts
	//wp_register_script('plugins', get_template_directory_uri() . '/scripts/plugins.js', array('jquery'), null, true);
	wp_register_script('scripts', get_template_directory_uri() . '/scripts/bundled.min.js', array('jquery'), null, true);
	
	//enqueue scripts along with condiotionals
	//wp_enqueue_script('plugins');
	wp_enqueue_script('scripts');
}

add_action( 'wp_enqueue_scripts', 'script_handler' );

//-------------------------------------------------------------------

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// CUSTOM POST TYPE ADVENTURERS
//====================================================================

// Custom taxonomy for custom post type ------------------------------

function build_taxonomies() {
	register_taxonomy(
    'superpowers',
    'adventurers',
    array(
	   'hierarchical' => true,
	   'label' => 'Super power',
	   'query_var' => true,
	   'rewrite' => array('slug' => 'adventurers-superpowers')
    )
	);
}

add_action('init', 'build_taxonomies', 0);

// Init post type ----------------------------------------------------

add_action('init', 'my_custom_init');
function my_custom_init(){
  $labels = array(
    'name' => _x('adventurers', 'post type general name'),
    'singular_name' => _x('adventurers', 'post type singular name'),
		'add_new' => _x('Add adventurer', 'adventurers'),
    'add_new_item' => __('Create new adventurer'),
    'edit_item' => __('Edit adventurer'),
    'new_item' => __('New adventurer'),
    'view_item' => __('View adventurer'),
    'search_items' => __('Search adventurers'),
    'not_found' =>  __('No adventurers found'),
    'not_found_in_trash' => __('No adventurers in the bin'), 
    'parent_item_colon' => '',
    'menu_name' => 'Adventurers'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    '_builtin' => false,
    'show_in_menu' => true, 
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'page',
    'has_archive' => true, 
    'hierarchical' => true, // To work with Simple page order plugin (http://wordpress.org/plugins/simple-page-ordering/)
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'taxonomies' => array('post_tag') // this is IMPORTANT
  ); 
  register_post_type('adventurers',$args);
}

function post_type_tags_fix($request) {
  if ( isset($request['tag']) && !isset($request['post_type']) )
  $request['post_type'] = 'any';
  return $request;
} 

add_filter('request', 'post_type_tags_fix');

function adventurers_updated_messages( $messages ) {
	global $post, $post_ID;
  	$messages['adventurers'] = array(
    	0 => '', // Unused. Messages start at index 1.
    	1 => sprintf( __('Adventurer got hens new shape. <a href="%s">View adventurer</a>'), esc_url( get_permalink($post_ID) ) ),
    	2 => __('Custom field updated.'),
    	3 => __('Custom field erased.'),
    	4 => __('Adventurer is up to date.'),
    	/* translators: %s: date and time of the revision */
    	5 => isset($_GET['revision']) ? sprintf( __('Recreated adventurer from previous version %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    	6 => sprintf( __('Adventurer published. <a href="%s">View adventurer</a>'), esc_url( get_permalink($post_ID) ) ),
    	7 => __('Adventurer saved.'),
    	8 => sprintf( __('Adventurer posted. <a target="_blank" href="%s">View adventurer</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    	9 => sprintf( __('Adventurer scheduled to: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview adventurer</a>'),
      	// translators: Publish box date format, see http://php.net/date
      	date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    	10 => sprintf( __('Draft for adventurer is up to date. <a target="_blank" href="%s">Preview adventurer</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  	);
  return $messages;
}

add_filter('post_updated_messages', 'adventurers_updated_messages');


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

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');

//-------------------------------------------------------------------

function this_page_children($postID){
	$children = get_pages( array( 'child_of' => $postID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
	foreach( $children as $page ) {		
		$content = $page->post_content;
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
		if ( ! $content )
		continue;
		$content = apply_filters( 'the_content', $content );
		
		if ( $thumbnail ) {
			echo '<figure class="m-condensed__figure"><img class="l-forcewidth m-condensed__thumb" src="'.$thumbnail[0].'" alt="" /></figure>'; 
		} 
		
		echo '<section id="'.$page->ID.'" class="m-condensed"><div class="l-container"><div class="l-span-A12">';
			echo '<h2 class="t-large">'.$page->post_title.'</h2>';
			echo $content;
		echo '</div></div></section>';

	}
}

//-------------------------------------------------------------------

function this_page_children2($postID){
	$args = array(
    'post_type'      	=> 'page',
    'posts_per_page' 	=> -1,
    'post__not_in' 		=> array($postID),
    'order'          	=> 'ASC',
    'orderby'        	=> 'menu_order',
    'post_parent'    	=> $postID,
	);

	$this_children = new WP_Query( $args );
	
	if ( $this_children->have_posts()) { 
  	while ( $this_children->have_posts()) 
  		{ $this_children->the_post(); 
				get_template_part( 'parts/m-condensed'); 
    	} 
		} 
		wp_reset_postdata();
}

//-------------------------------------------------------------------

function posts_related_by_cat($postID){
	$related = get_posts( array( 'category__in' => wp_get_post_categories($postID), 'numberposts' => -1, 'order' => 'ASC', 'post__not_in' => array($postID) ) );
	$wpcats = wp_get_post_categories($postID);
	global $post;
	setup_postdata($post);
	$cats = array();
	foreach ($wpcats as $c) {
		$cats[] = get_cat_name( $c );
	}
	echo '<aside>';
	echo '<h3>'.$lister = implode(",", $cats).'</h3>';
	
	if( $related ) foreach( $related as $post ) {
		get_template_part('exempel'); 
	}
	echo '</aside>';
	wp_reset_postdata();
}

//-------------------------------------------------------------------

function textCol($atts, $content = null) {
	return '<div class="l-container"><div class="l-span-B4 gutter"><p class="t-fineprint">'.$content.'</p></div>';
}
add_shortcode('col-1', 'textCol');

function textColMiddle($atts, $content = null) {
	return '<div class="l-span-B4 gutter"><p class="t-fineprint">'.$content.'</p></div>';
}
add_shortcode('col-2', 'textColMiddle');

function textColLast($atts, $content = null) {
	return '<div class="l-span-B4 gutter"><p class="t-fineprint">'.$content.'</p></div></div>';
}
add_shortcode('col-3', 'textColLast');


//-------------------------------------------------------------------


//-------------------------------------------------------------------


//-------------------------------------------------------------------

function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/favicon.ico" />';
	// echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_url').'/favicon.ico" />'; IF we want to inehrit from parent
}
add_action('wp_head', 'blog_favicon');

//-------------------------------------------------------------------

function UA_desktop_part($partial){
	$detect = new Mobile_Detect;
	
	if (!$detect->isMobile()) {
		get_template_part('parts/'.$partial);
	}
}

//-------------------------------------------------------------------

function new_excerpt_more($more) {
       global $post;
	return ' ';
}
add_filter('excerpt_more', 'new_excerpt_more');

//-------------------------------------------------------------------

//GEOLOCATION SETTINGS
//Dependant on ip2country plugin
function getCountry() {
		global $wp_session;
	  if (isset($wp_session['iplang'])) return $wp_session['iplang'];
    if (!isset($_COOKIE['ipCountry'])) {
        $ip2country = ip2country();
        $country = $ip2country->country_code;
        setcookie('ipCountry', $country, strtotime('+30 days'));
        return $country;
    } else {
        return $_COOKIE['ipCountry'];
    }

}

function setCountry($code) {
		global $wp_session;
		$wp_session['iplang'] = $code;
    setcookie('ipCountry', $code, strtotime('+30 days'));
    
}
function resetCountry() {
		global $wp_session;
//		unset $wp_session['iplang'];
    //TODO FIX SO IT CLEARS!
    setcookie('ipCountry', '');

}
function redirectLanguage () {
	if(isset($_GET['lang'])) {
		setCountry($_GET['lang']);
		$country = $_GET['lang'];
		if($country == 'SE') {
			header("Location: /sv/");
		} else {
			header("Location: /");
		}
		die();
	} else {
		$country = getCountry();
	}
	$urlstart = substr($_SERVER['REQUEST_URI'],0,4);
	if($country == 'SE' && $urlstart != '/sv/' ) {
		//redirect till svensk sida
		header("Location: /sv/");
		die();
	}
}

//-------------------------------------------------------------------

function disqus_embed($disqus_shortname) {
  global $post;
  wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
  echo '<div id="disqus_thread"></div>
  <script type="text/javascript">
    var disqus_shortname = "'.$disqus_shortname.'";
    var disqus_title = "'.$post->post_title.'";
    var disqus_url = "'.get_permalink($post->ID).'";
    var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
  </script>';
}

//-------------------------------------------------------------------

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');
?>