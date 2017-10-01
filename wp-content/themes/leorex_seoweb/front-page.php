<?php
/*
 * The main template file
 *

 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

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
<div class="before_after_container">
    <div class="after_image">
<img src="../wp-content/themes/leorex_seoweb/images/after-1920.jpg">
    </div>
    <div class="before_image_container">
        <div class="before_image">
            <div class="slider_button">
            </div>
            <img src="../wp-content/themes/leorex_seoweb/images/before-1920.jpg"" alt="">
        </div>
        <div class="slider_button">
        </div>
    </div>
</div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>