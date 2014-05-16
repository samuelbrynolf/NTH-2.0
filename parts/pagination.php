<nav class="l-container m-pagination" id="m-pagination">
	<div class="l-span-A12">
		<?php if(function_exists('wp_pagenavi')) {
			wp_pagenavi();
		} ?>
	</div>
</nav>
