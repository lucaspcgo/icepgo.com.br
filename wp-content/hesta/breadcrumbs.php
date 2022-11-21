<section class="hero-wrap hero-wrap-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/images/inner.jpg);">
	<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 text-center">	
			<?php if ( have_posts() ) { ?>
                <ul class="breadcrumbs d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'hesta' ); ?></a>
                    </li>

					<?php if ( is_page() || is_single() ) { ?>
                        <li class="breadcrumb-item " aria-current="page"><?php the_title(); ?></li> <?php } ?>

					<?php if ( is_category() || is_tag() ) { ?>
                        <li class="breadcrumb-item " aria-current="page"><?php echo single_cat_title(); ?></li>
					<?php } ?>

					<?php if ( is_archive() ) {
						if ( is_day() ) : ?>
						<li class="breadcrumb-item " aria-current="page">
						<?php    /* translators: %s: date. */
							printf( esc_html__( 'Daily Archives: %s', 'hesta' ), '<span>' . get_the_date() . '</span>' ); ?>    
						</li>
						<?php elseif ( is_month() ) :?>
						<li class="breadcrumb-item " aria-current="page">
						<?php    /* translators: %s: month. */
							printf( esc_html__( 'Monthly Archives / %s', 'hesta' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'hesta' ) ) . '</span>' ); ?>    
						</li>
						<?php elseif ( is_year() ) :?>
						<li class="breadcrumb-item " aria-current="page">
							<?php    /* translators: %s: year. */
								printf( esc_html__( 'Yearly Archives: %s', 'hesta' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'hesta' ) ) . '</span>' ); ?>
						</li>
						<?php endif; } ?>

					<?php if ( is_search() ) { ?>
                        <li class="breadcrumb-item "
                            aria-current="page"><?php
							/* translators: %s: search term. */
							printf( esc_html__( 'Search Results for: %s', 'hesta' ), '<span>' . get_search_query() . '</span>' ); ?></li>
					<?php } ?>

					<?php if ( is_author() ) { ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo get_the_author(); ?></li>
					<?php } ?>

                </ol>
			<?php } elseif ( is_404() ) { ?>

                <ul class="breadcrumbs d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'hesta' ); ?></a>
                    </li>

                    <li class="breadcrumb-item"><?php esc_html_e( '404 Error', 'hesta' ); ?></li>
                </ul>
			<?php } ?>
		</div>
	</div>
</section>