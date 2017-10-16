<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 */
 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<header class="fixed header flex aligncenter container_res_100 justify-center z_1" id="main-header">
        <div class="absolute mobile_menu_panel z_3">
            <div class="nav_container">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'main-menu',
                        'menu_class' => 'main-menu-list',
                        'container' => 'nav',
                        'container_id' => 'main-nav-mobile',
                    ) );
                ?>

            </div>
        </div>
        <div class="container_res_100 flex space-between aligncenter z_4" id="header_inner">
            <div class="hamburger flex justify-center">
                <div class="hamburger_line"></div>
            </div>
            <div class="logo_container" id="logo_header">
                <img src="/wp-content/themes/leorex_seoweb/images/Layer-1.png" class="image">
                <img src="/wp-content/themes/leorex_seoweb/images/Layer-2.png" class="image">
            </div>
            <div class="desktop_menu_panel z_3">
                <div class="nav_container">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'main-menu',
                        'menu_class' => 'main-menu-list',
                        'container' => 'nav',
                        'container_id' => 'main-nav-mobile',
                    ) );
                    ?>
                </div>
            </div>
            <div class="icon_header" id="cart_icon">
                <span class="flaticon-business desktop">
                    cart

                    <div class="header-cart-count "><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                </span>
                <span class="flaticon-business mobile">


                    <div class="header-cart-count "><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                </span>
            </div>
        </div><!--  #header_inner  -->
	</header>


	<div id="content" class="site-content">
