<aside class="single_sidebar_widget search_widget">
<form method="get" role="search" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<div class="input-group mb-3">
			<input id="s" type="text" name="s" class="form-control" placeholder="<?php echo esc_attr_e( 'Search...', 'hesta' ); ?>" value="<?php the_search_query(); ?>">
			<div class="input-group-append">
				<button class="btns" type="button"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</div>
</form>
</aside>