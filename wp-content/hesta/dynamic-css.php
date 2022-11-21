<?php
$hesta_menu_align = get_theme_mod( 'hesta_menu_align' );
$hesta_theme_skin = get_theme_mod( 'hesta_theme_skins' );
?>
<style>
.header__menu {
    float: <?php echo esc_attr( $hesta_menu_align ); ?>;
}
<?php if ( $hesta_theme_skin == 'dark' ) { ?>
	body,.footer-2,.blog_right_sidebar .single_sidebar_widget,.header,.header__logo::before,.header-info,.services,.hero-overlay,.hero-wrap.hero-wrap-2 .overlay,.blog_right_sidebar .search_widget .input-group button,.search_widget .input-group button,.left,.right,.post-btn{
	background: #212223fa !important;}.heading-section h2,.heading-section p,.blog_item_date1 h3,.blog_item_date1 h3 a,.circle i,.blog_single_area .navigation-area h4 a,.comments-area h4,h4.logged-in-as a,.desc,.comments-area h5,h1.no_found_title {color: #fff;}.about-area.pt-100.pb-100 {background: #252627 !important;}'; 
<?php } ?>

<?php if ( has_header_image() ) { ?>
.header__logo::before {
    background: transparent;
}
<?php } ?>
</style>