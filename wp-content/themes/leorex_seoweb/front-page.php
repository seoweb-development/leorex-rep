<?php
/*
 * The main template file
 *

 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/product-slider.php') ?>
            <div class="main_page_posts_container" >
<!--                --><?php //if ( have_posts() ) : ?>
<!---->
<!--                    --><?php
//                    // Start the loop.
//                    while ( have_posts() ) : the_post();
//
//                        ?><!--<h1>--><?php //the_title() ?><!--</h1>-->
<!--                        <div>--><?php //the_content() ?><!--</div>-->
<!--                        --><?php
//                    endwhile;
//
//
//                else :
//
//
//                endif;
                require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/home_content.php')
//                ?>
            </div>
            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/advantages.php') ?>
            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/testomanials_slider.php') ?>
            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/beforeafter.php') ?>
            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/special_offers.php') ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>