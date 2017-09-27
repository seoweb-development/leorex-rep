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
    <div class="footer_wrapper">
        <div class="footer_menu_container">
            <div class="accordion_container">
                <?php echo build_futer_nav_menu_html('footer about' );
//                    'theme_location'  => 'footer_menu_about',
////                    'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',
//                    'container_class' => 'footer_menu',
//                    'menu_class'      => 'footer_menu_list',
//                    'container'       => 'div',
//                    'container_id'    => 'about_footer',
//                    'depth'           => 2,
//                    'echo'            =>false
                /*) ));*/ ?>
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
