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
<!--                <div class="accordion_one_box">-->
<!--                    <div class="accordion_oppener">-->
<!--                        <div class="oppener_title">ABOUT US</div>-->
<!--                        <div class="accordion_arrow"></div>-->
<!--                    </div>-->
<!--                    <div class="accordion_one_box_body">-->
<!--                        -->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="accordion_one_box">-->
<!--                    <div class="accordion_oppener">-->
<!--                        <div class="oppener_title">LOREM IPSUM</div>-->
<!--                        <div class="accordion_arrow"></div>-->
<!--                    </div>-->
<!--                    <div class="accordion_one_box_body">-->
<!--                        <div class="one_menu_element">LOREM IPSUM</div>-->
<!--                        <div class="one_menu_element">LOREM IPSUM</div>-->
<!--                        <div class="one_menu_element">LOREM IPSUM</div>-->
<!--                        <div class="one_menu_element">LOREM IPSUM</div>-->
<!--                        <div class="one_menu_element">LOREM IPSUM</div>-->
<!--                        <div class="one_menu_element">LOREM IPSUM</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="clearfix"></div>-->
            </div>

        </div>
        <div class="contact_us_futer_container">
            <?php dynamic_sidebar( 'futer_contact_us' ); ?>
<!--            <div class="comtact_us_title">CONTACT US:</div>-->
<!--            <div class="contact_us_futer_body">-->
<!--                <div class="phone">1-914-343-1894</div>-->
<!--                <div class="email_link">click to email</div>-->
<!--                <div class="logo_image"></div>-->
<!--            </div>-->
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
