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
            <a href="/" class="link_h" style="font-weight: bold; color:#686868; text-decoration:none;">Back to Home Page > </a>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>