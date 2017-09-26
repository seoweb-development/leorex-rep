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
<div id="page" class="site pure-g">
	<header class="header pure-u" id="main-header">
        <div class="pure-g container_res">
            <div>
                <?php wp_nav_menu( array(
                'theme_location' => 'header-menu',
                'container_class' => 'main-menu',
                'menu_class' => 'main-menu-list',
                'container' => 'nav',
                'container_id' => 'main-nav',
                ) ); ?>
            </div>
        </div><!--    -->
	</header>


	<div id="content" class="site-content">
