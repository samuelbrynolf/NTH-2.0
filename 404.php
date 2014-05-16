<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]-->

	<head>
		<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	  <meta charset="utf-8"/>
	  <meta name="HandheldFriendly" content="True"/>
	  <meta name="MobileOptimized" content="320"/>
	  <meta name="viewport" content="width=device-width,initial-scale=1"/>
	  
	  <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	     
    <noscript>
    	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/CSS/no-js.css">
    </noscript>
	  
	  <!--[if lt IE 9]>
	  	<script src="<?php bloginfo('template_directory'); ?>/scripts/browsersupport/ie9/html5shiv.js"></script>
	  <![endif]-->
	  
	  <!--[if lte IE 8]>
			<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/CSS/IE8.css">
	  <![endif]-->
    
    <title>404&mdash;Sidan kunde inte hittas</title>

	</head>
	
	<body <?php body_class(); ?>>
		<header class="l-container m-global-header" id="global-header" role="banner">
			<div class="l-span-A12">
				<a class="ir" id="blogname" href="<?php bloginfo('url'); ?>" title=""><?php bloginfo('blogtitle'); ?></a>
			</div>
		</header>

		<article>	
		
			<a href="<?php bloginfo('url'); ?>" title="">
				<header class="l-container msg404">
					<div class="l-span-A12">
						<h1 class="t-xlarge cough">Compu&#8217;er<br/>says no (404)</h1>
					</div>
				</header>
			</a>
			
			<p class="error404-paragraph">
				Din URL &auml;r felstavad eller s&aring; har sidan upph&ouml;rt.<br/><a href="<?php bloginfo('url'); ?>" title="">Till startsidan</a>
			</p>
			
		</article>

		<?php wp_footer(); ?> 
	</body>
</html>