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
	<div class="tabs_container">
		<div class="reviews_tab one_tab">
			<div class="one_tab_header">
				<div class="title">reviews:</div>
				<div class="stars"></div>
			</div>
			<div class="one_tab_body one_tab_body_hidden">
				<div class="reviews_body_stars"></div>
				<div class="reviews_date_time">September 12, 2017</div>
				<div class="reviews_title">Immediate apperance of flatte</div>
				<div class="reviews_text">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer odio nulla, blandit vitae augue at, venenatis tincidunt mi. Aenean mollis tempus tincidunt. In consectetur nisl sit amet dui aliquet laoreet. Ut quis libero nulla. Vestibulum porta eget mauris vitae vestibulum. Etiam vulputate vehicula orci luctus convallis. Donec iaculis pharetra ligula, id gravida eros vestibulum eget. Ut ultrices iaculis mi, vitae bibendum odio posuere non. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque accumsan dolor sit amet lectus cursus feugiat.

					Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus quis lectus sodales, ultrices nunc eu, lobortis massa. Nunc sed ligula laoreet nisi egestas elementum eu et odio. Vivamus quis leo eu felis tempus euismod. Integer molestie egestas mauris. Nam accumsan magna diam, quis pellentesque purus porta eu. Integer velit sapien, auctor sit amet elit eget, rhoncus ultrices arcu. Ut volutpat nunc molestie felis tincidunt, ac pretium eros posuere. Aliquam porttitor, velit eget vehicula fermentum, ex tortor rhoncus ipsum, ac facilisis augue orci vitae arcu. Nulla accumsan, tellus sed scelerisque commodo, mauris massa auctor purus, a eleifend ante diam elementum metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
				</div>

			</div>
		</div>
		<div class="description_tab one_tab">
			<div class="one_tab_header">
				<div class="title">description</div>
			</div>

			<div class="one_tab_body one_tab_body_hidden">
				kkkkkkkk
			</div>
		</div>
		<div class="advantages_tab one_tab">
			<div class="one_tab_header">
				<div class="title">advantages</div>
			</div>
			<div class="one_tab_body one_tab_body_hidden">
				gggggggggg
			</div>
		</div>
		<div class="delivery_tab one_tab">
			<div class="one_tab_header">
				<div class="title">delivery info</div>
			</div>
			<div class="one_tab_body one_tab_body_hidden">
gfhgfhgf
			</div>
		</div>
	</div>
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
