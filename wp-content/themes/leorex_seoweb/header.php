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
	<header class="fixed header flex aligncenter container_res_100" id="main-header">
        <div class="absolute mobile_menu_panel">
            <?php
            if (wp_is_mobile()){
                wp_nav_menu( array(
                    'theme_location' => 'header-menu',
                    'container_class' => 'main-menu',
                    'menu_class' => 'main-menu-list',
                    'container' => 'nav',
                    'container_id' => 'main-nav',
                ) );
            }
            else{
                wp_nav_menu( array(
                    'theme_location' => 'header-menu',
                    'container_class' => 'main-menu',
                    'menu_class' => 'main-menu-list',
                    'container' => 'nav',
                    'container_id' => 'main-nav',
                ) );
            }
            ?>

        </div>
        <div class="container_res_100 flex space-between aligncenter z_1" id="header_inner">
            <div class="hamburger flex space-between">
                <div class="hamburger_line"></div>
            </div>
            <div class="logo_container" id="logo_header">
                <img src="" class="image">
            </div>
            <div class="icon_header" id="cart_icon">
                <span class="flaticon-business">

                </span>
            </div>
        </div><!--  #header_inner  -->
	</header>


	<div id="content" class="site-content">
