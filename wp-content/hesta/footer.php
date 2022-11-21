<footer class="footer footer-2">
	<div class="container">
		<?php
			/* 
			* Functions hooked into hesta_footer_widget_area action
			*
			* @hooked hesta_footer_widget
			*/
			do_action( 'hesta_footer_widget_area' );
		?>
		<div class="row info-footer">
		<?php $hesta_footer_align = get_theme_mod( 'hesta_footer_align','center' ); ?>
			<div class="col-md-12 text-<?php echo esc_attr( $hesta_footer_align ); ?>">
			<?php
			/* 
			* Functions hooked into hesta_footer_copyright_area action
			*
			* @hooked hesta_footer_copyright
			*/
			do_action( 'hesta_footer_copyright_area' );
			?>
			</div>
		</div>
	</div>
</footer>
<!-- scroll top icon -->
<a href="#" id="scrollup" class="move-top text-center scrollup" style="">
    <div class="circle"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
</a>
<?php get_template_part( 'dynamic', 'css' ); ?>
<?php wp_footer(); ?>
</body>
</html>