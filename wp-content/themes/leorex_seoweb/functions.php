<?php


//Styles for the theme /////////////////////////////////////////////////////////////////////////////////////////////////
function add_theme_styles() {
	wp_enqueue_style( 'slick', '/wp-content/themes/leorex_seoweb/css/slick.css', $media='all' );
	wp_enqueue_style( 'pure', '/wp-content/themes/leorex_seoweb/css/pure-min.css', $media='all' );
	wp_enqueue_style( 'fonts', '/wp-content/themes/leorex_seoweb/fonts/stylesheet.css', $media='all' );
	wp_enqueue_style( 'iconfont', '/wp-content/themes/leorex_seoweb/fonts/flaticon.css', $media='all' );
	wp_enqueue_style( 'style', '/wp-content/themes/leorex_seoweb/style.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'header', '/wp-content/themes/leorex_seoweb/css-c/header.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'footer', '/wp-content/themes/leorex_seoweb/css-c/footer.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'beforeafter', '/wp-content/themes/leorex_seoweb/css-c/before_after.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'topslider', '/wp-content/themes/leorex_seoweb/css-c/top_slider.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'special', '/wp-content/themes/leorex_seoweb/css-c/special_offers.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'testomanials', '/wp-content/themes/leorex_seoweb/css-c/testomanials.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'advantages', '/wp-content/themes/leorex_seoweb/css-c/advantages.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'single', '/wp-content/themes/leorex_seoweb/css-c/single.css', $deps = array(), $ver=null  ,$media = 'all');
	wp_enqueue_style( 'content', '/wp-content/themes/leorex_seoweb/css-c/home_page_content.css', $deps = array(), $ver=null  ,$media = 'all');
}


//Scripts for the theme ////////////////////////////////////////////////////////////////////////////////////////////////
function add_theme_scripts() {
	wp_enqueue_script( 'slick',  $src = '/wp-content/themes/leorex_seoweb/js/slick.min.js', $deps = array('jquery'),$ver = false,  $in_footer = true );
	wp_enqueue_script( 'waypoints',  $src = '/wp-content/themes/leorex_seoweb/js/jquery.waypoints.min.js', $deps = array('jquery'),$ver = false,  $in_footer = true );
	wp_enqueue_script( 'controller',  $src = '/wp-content/themes/leorex_seoweb/js/controller.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
	wp_enqueue_script( 'model',  $src = '/wp-content/themes/leorex_seoweb/js/model.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
	wp_enqueue_script( 'ui',  $src = '/wp-content/themes/leorex_seoweb/js/ui.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
	wp_enqueue_script( 'gerryscript',  $src = '/wp-content/themes/leorex_seoweb/js/gerryscript.js', $deps = array('jquery','waypoints','slick'), $ver = false, $in_footer = true );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
add_action( 'wp_enqueue_scripts', 'add_theme_styles' );


// menu theme support //////////////////////////////////////////////////////////////////////////////////////////////////
function register_my_menu() {
     register_nav_menus( array(
        'header-menu' => 'Header Menu',
        'footer_menu_about' => 'Footer Menu About',

    ) );
}

//Parse footer menu ////////////////////////////////////////////////////////////////////////////////////////////////////
function parse_footer_nav_menu($menu_name){

    $array_menu = wp_get_nav_menu_items($menu_name);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      =   $m->ID;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['url']         =   $m->url;
            $menu[$m->ID]['children']    =   array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID']       =   $m->ID;
            $submenu[$m->ID]['title']    =   $m->title;
            $submenu[$m->ID]['url']  =   $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}

//Build footer nav-menu/////////////////////////////////////////////////////////////////////////////////////////////////
function build_futer_nav_menu_html($menu_name)
{
    $menu_array = parse_footer_nav_menu($menu_name);
    $html = '';
    foreach ($menu_array as $title_key => $title_val) {
        $html .= ' <div class="accordion_one_box">
                    <div class="accordion_oppener">
                        <div class="oppener_title">' . $title_val["title"] . '</div>
                        <div class="accordion_arrow"></div>
                    </div>
                    <div class="accordion_one_box_body">';
        foreach ($title_val['children'] as $sub_key => $sub_val) {
            $html .=  '<div class="one_menu_element"><a class="one_menu_element_link" href="'.$sub_val['url'].'">'.$sub_val['title'].'</a></div>';
        }
        $html .= ' </div>
                </div><!--<div class="clearfix"></div>-->';
    }
    return $html;
}
add_action( 'init', 'register_my_menu' );

//Register our sidebars and widgetized areas //////////////////////////////////////////////////////////////////////////
function footer_contact_us_init() {
    register_sidebar( array(
        'name'          => 'futer area widget',
        'id'            => 'futer_contact_us',
        'class'         => 'contact_us_futer_container',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="comtact_us_title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => 'footer area copyrights widget',
        'id'            => 'foofter_copyrights',
        'class'         => 'foofter_copyrights',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<div class="copyrights_title">',
        'after_title'   => '</div>',
    ) );
}
add_action( 'widgets_init', 'footer_contact_us_init' );



