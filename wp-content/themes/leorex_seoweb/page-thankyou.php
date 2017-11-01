<?php
/* Template Name: Thank you */




get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

                ?>
                <h1 class="h1_ty" style="font-size:55px; color: #d6b488; text-transform: uppercase; margin-bottom: 0;">
                    Thank You!
                </h1>
                <h4 class="h4_ty" style="color:#686868; font-size: 30px; font-weight: bold; margin:0; margin-top:-3px;">Your order is accepted</h4>
                <div class="page_content thankyou_page" style="font-size: 25px;"><?php the_content() ?></div>
                <?php
            endwhile;


        else :


        endif;
        ?>
        <div class="content_header_image"></div>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
