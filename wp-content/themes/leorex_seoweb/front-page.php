<?php
/*
 * The main template file
 *

 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/product-slider.php') ?>
            <?php if ( have_posts() ) : ?>

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    ?><h1><?php the_title() ?></h1>
                    <div><?php the_content() ?></div>
                    <?php
                endwhile;


            else :


            endif;
            ?>

            <?php require_once('./wp-content/themes/leorex_seoweb/tamplate-parts/beforeafter.php') ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>