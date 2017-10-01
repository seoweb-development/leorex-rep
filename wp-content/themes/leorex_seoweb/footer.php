<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *

 */
?>

</div><!-- .site-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer_wrapper container_res_100 mauto">
        <div class="footer_menu_container">
            <div class="accordion_container">
                <?php echo build_futer_nav_menu_html('footer about' ); ?>

            </div>

        </div>
        <div class="contact_us_futer_container">
            <?php dynamic_sidebar( 'futer_contact_us' ); ?>


            <div class="logo_image"></div>
        </div>
<!--        <div class="logo_image"></div>-->
        <div class="clearfix"></div>
        <div class="sub_footer">
<div class="copyrights_box">
            <?php dynamic_sidebar( 'foofter_copyrights' ); ?>
        </div>
            <div class="cards_images_box">

            </div>
        </div>
        <div class="secured_by_container">
                <div class="secured_by_title">SECURED BY:</div>
                <div class="secured_by_image"></div>
        </div>
    </div>

</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
