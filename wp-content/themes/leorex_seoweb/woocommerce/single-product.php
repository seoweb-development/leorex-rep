<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>


	<div class="tabs_container mobile">
        <div class="reviews_tab one_tab">
            <div class="one_tab_header">
                <div class="title">reviews:</div>
                <div class="stars"></div>
            </div>
            <div class="one_tab_body one_tab_body_hidden">
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Immediate apperance of flatte</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                        <p>I was really impressed with how quickly my skin started to show less wrinkles and more smoothness.
                            Leorex Active is highly effective! I will definitely be purchasing this again.  Ann bridges, Los Angeles CA.
                        </p>
                        </div>
                        <div class="reviews_text_read_less"></div>
                    </div>

                    <div class="one_review_read_more">Read more ></div>
                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Immediate apperance of flatte</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                        <p>Leorex booster gold is awesome! While nothing is magic and erases all wrinkles, this is just great!
                            It minimizes the lines & wrinkles in just minutes. loved this product and would recommend to all my friends. Diane stein, clifton NJ.
                        </p>

                        </div>
                        <div class="reviews_text_read_less"></div>
                    </div>
                    <div class="reviews_short_text "></div>
                    <div class="one_review_read_more">Read more ></div>
                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Immediate apperance of flatte</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                        <p>After applying Booster gold (3 pea size amount for the entire face) and letting it set for 15-20 minutes, my face felt very tight. Deep and visible lines improved a lot. Pores in my cheeks appeared smaller also. Instant facelift in 20 minutes! Janet thomas, Brooklyn NY.</p>

                    </div>
                        <div class="reviews_text_read_less"></div>
                    </div>

                    <div class="one_review_read_more">Read more ></div>
                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Immediate apperance of flatte</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>You must try Leorex Booster Active! This wonderful smoothing cream mask provides visible results.
                                a radiant smooth complexion and instant wrinkle reduction that will last for at least 10 hours! Elaine O'connor, boston MA
                            </p>

                        </div>
                        <div class="reviews_text_read_less"></div>
                    </div>

                    <div class="one_review_read_more">Read more ></div>
                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Immediate apperance of flatte</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>I'm 53 years old and I've tried a lot of skin care products over the years, Including high end products.
                                I don't waste time with worthless products. I'm big into products that perform but don't cost a fortune and Leorex is one of those special finds. Doris Roberts, Naples FL
                            </p>

                        </div>
                        <div class="reviews_text_read_less"></div>
                    </div>

                    <div class="one_review_read_more">Read more ></div>
                </div>
            </div>
        </div>
        <div class="description_tab one_tab">
            <div class="one_tab_header">
                <div class="title">description</div>
            </div>

            <div class="one_tab_body one_tab_body_hidden">
                <div class="descriptions_text one_tab_body_text">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_field('description'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
        <div class="advantages_tab one_tab">
            <div class="one_tab_header">
                <div class="title">advantages</div>
            </div>
            <div class="one_tab_body one_tab_body_hidden">
                <div class="advantages_text one_tab_body_text">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_field('advantages'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
        <div class="delivery_tab one_tab">
            <div class="one_tab_header">
                <div class="title">delivery info</div>
            </div>
            <div class="one_tab_body one_tab_body_hidden">
                <div class="delivery_text one_tab_body_text">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_field('delivery_info'); ?>

                    <?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
    </div>













    <div class="tabs_container desktop">

        <div class="description_tab one_tab" id="description">
            <div class="one_tab_header">
                <div class="title">description</div>
            </div>

            <div class="one_tab_body ">
                <div class="descriptions_text one_tab_body_text">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_field('description'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
        <div class="advantages_tab one_tab" id="advantages">
            <div class="one_tab_header">
                <div class="title">advantages</div>
            </div>
            <div class="one_tab_body one_tab_body_hidden">
                <div class="advantages_text one_tab_body_text">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_field('advantages'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
        <div class="delivery_tab one_tab" id="delivery">
            <div class="one_tab_header">
                <div class="title">delivery info</div>
            </div>
            <div class="one_tab_body one_tab_body_hidden">
                <div class="delivery_text one_tab_body_text">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_field('delivery_info'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
        <div class="reviews_tab one_tab" id="reviews">
            <div class="one_tab_header">
                <div class="title">reviews:</div>
                <div class="overall">Overall rating:</div>
                <div class="stars"></div>
            </div>
            <div class="one_tab_body one_tab_body_hidden">
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Leorex Active is highly effective!</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>I was really impressed with how quickly my skin started to show less wrinkles and more smoothness.
                                Leorex Active is highly effective! I will definitely be purchasing this again.  Ann bridges, Los Angeles CA.
                            </p>

                        </div>

                    </div>


                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Leorex booster gold is awesome!</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>Leorex booster gold is awesome! While nothing is magic and erases all wrinkles, this is just great!
                                It minimizes the lines & wrinkles in just minutes. loved this product and would recommend to all my friends. Diane stein, clifton NJ.
                            </p>

                        </div>

                    </div>
                    <div class="reviews_short_text "></div>

                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Instant facelift in 20 minutes!</div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>After applying Booster gold (3 pea size amount for the entire face) and letting it set for 15-20 minutes, my face felt very tight. Deep and visible lines improved a lot. Pores in my cheeks appeared smaller also. Instant facelift in 20 minutes! Janet thomas, Brooklyn NY.</p>

                        </div>

                    </div>


                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">You must try Leorex Booster Active! </div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>You must try Leorex Booster Active! This wonderful smoothing cream mask provides visible results.
                                a radiant smooth complexion and instant wrinkle reduction that will last for at least 10 hours! Elaine O'connor, boston MA
                            </p>

                        </div>

                    </div>


                </div>
                <div class="one_review">
                    <div class="reviews_body_stars"></div>
                    <div class="reviews_date_time">September 12, 2017</div>
                    <div class="reviews_title">Leorex is one of those special finds. </div>
                    <div class="reviews_text one_tab_body_text">

                        <div class="reviews_text_inner">
                            <p>I'm 53 years old and I've tried a lot of skin care products over the years, Including high end products.
                                I don't waste time with worthless products. I'm big into products that perform but don't cost a fortune and Leorex is one of those special finds. Doris Roberts, Naples FL
                            </p>

                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
