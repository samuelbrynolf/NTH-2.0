		<footer class="l-container m-global-footer" id="global-footer" role="contentinfo">
			<ul class="l-clearfix footerwrapper" id="footerWrapper">					
				<?php if ( !function_exists('register_sidebar') || !dynamic_sidebar('Footer') ) {} ;?>
				<li class="l-span-A12 m-footerwidget goodbye">
					<a class="jumper" href="#global-header" rel="nofollow"><?php bloginfo('blogtitle'); ?> aka Samuel Larsson<br/>
					anno <?php echo date("Y"); ?></a>
				</li>
			</ul>
		</footer>
		
		<nav class="l-container m-global-nav s-is-hidden" id="m-global-nav" role="navigation">
			<ul id="menu-global-nav" class="l-span-A12 menu">
				<?php if (current_user_can('delete_users')) { 
					echo '<li class="menu-item"><a href="'.get_bloginfo('url').'/wp-admin">Admin</a></li>';
				}
				
				wp_nav_menu(array('container' => '', 'items_wrap' => '%3$s'));
					$detect = new Mobile_Detect; 
					if (!$detect->isMobile() && is_search() && !have_posts()) {
		
					} else { ?>
						<li class="m-global-search"><?php get_search_form(); ?></li>
					<?php } ?> 
			</ul>
		</nav>
		
		<?php wp_footer(); ?> 
	</body>
</html>