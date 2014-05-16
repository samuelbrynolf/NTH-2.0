<!DOCTYPE html>
<html class="no-js">

	<head>
		<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	  <meta charset="utf-8"/>
	  <meta name="HandheldFriendly" content="True"/>
	  <meta name="MobileOptimized" content="320"/>
	  <meta name="viewport" content="width=device-width,initial-scale=1"/>
	  
	  <!--[if lt IE 9]><script>(function(l,f){function m(){var a=e.elements;return"string"==typeof a?a.split(" "):a}function i(a){var b=n[a[o]];b||(b={},h++,a[o]=h,n[h]=b);return b}function p(a,b,c){b||(b=f);if(g)return b.createElement(a);c||(c=i(b));b=c.cache[a]?c.cache[a].cloneNode():r.test(a)?(c.cache[a]=c.createElem(a)).cloneNode():c.createElem(a);return b.canHaveChildren&&!s.test(a)?c.frag.appendChild(b):b}function t(a,b){if(!b.cache)b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag();
a.createElement=function(c){return!e.shivMethods?b.createElem(c):p(c,a,b)};a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){b.createElem(a);b.frag.createElement(a);return'c("'+a+'")'})+");return n}")(e,b.frag)}function q(a){a||(a=f);var b=i(a);if(e.shivCSS&&!j&&!b.hasCSS){var c,d=a;c=d.createElement("p");d=d.getElementsByTagName("head")[0]||d.documentElement;c.innerHTML="x<style>article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}</style>";
c=d.insertBefore(c.lastChild,d.firstChild);b.hasCSS=!!c}g||t(a,b);return a}var k=l.html5||{},s=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,r=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,j,o="_html5shiv",h=0,n={},g;(function(){try{var a=f.createElement("a");a.innerHTML="<xyz></xyz>";j="hidden"in a;var b;if(!(b=1==a.childNodes.length)){f.createElement("a");var c=f.createDocumentFragment();b="undefined"==typeof c.cloneNode||
"undefined"==typeof c.createDocumentFragment||"undefined"==typeof c.createElement}g=b}catch(d){g=j=!0}})();var e={elements:k.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:"3.7.0",shivCSS:!1!==k.shivCSS,supportsUnknownElements:g,shivMethods:!1!==k.shivMethods,type:"default",shivDocument:q,createElement:p,createDocumentFragment:function(a,b){a||(a=f);
if(g)return a.createDocumentFragment();for(var b=b||i(a),c=b.frag.cloneNode(),d=0,e=m(),h=e.length;d<h;d++)c.createElement(e[d]);return c}};l.html5=e;q(f)})(this,document);</script><![endif]-->
	  
	  <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">    
	  <noscript><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/no-js.css"></noscript>

	  <!--[if lte IE 8]>
			<style>body{font-family:georgia,serif}</style>
	  <![endif]-->
		
	  <link href="<?php bloginfo('template_directory'); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
		<link href="<?php bloginfo('template_directory'); ?>/assets/img/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
		<link href="<?php bloginfo('template_directory'); ?>/assets/img/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
		<link href="<?php bloginfo('template_directory'); ?>/assets/img/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
		
		<link rel="author" href="https://plus.google.com/107967375248827213440/posts" />
	  
	  <title></title>
	  
	  <?php wp_head(); 
	  if (!current_user_can( 'manage_options' )) { ?>
		 <!-- <script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', 'UA-46517954-1', 'note-to-helf.com');
			  ga('send', 'pageview');
			</script> -->
		<?php } ?>
			
		
	</head>
	
	<body <?php body_class(); ?>>
		
		<header class="l-container m-global-header" id="global-header" role="banner">
			<div class="l-span-A12">
				<?php if (is_home()) { ?>
					<h1><a class="ir tappilyTap" id="blogname" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('blogtitle'); ?>"><?php bloginfo('blogtitle'); ?></a></h1>
				<?php } else { ?>
					<a class="ir tappilyTap" id="blogname" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('blogtitle'); ?>"><?php bloginfo('blogtitle'); ?></a>
				<?php }?>
				
				<a id="menu-button" class="m-menu-button jumper" href="#m-global-nav" rel="nofollow">
					<p class="front"><span class="visuallyhidden">Meny</span></p>
				</a>
				
			</div>
		</header>
		
		<?php UA_desktop_part('editable_aside'); ?>