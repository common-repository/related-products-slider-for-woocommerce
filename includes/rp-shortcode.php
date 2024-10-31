<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**
 * Enqueue js files
 */

function rp_adding_scripts() {
	wp_enqueue_script('rp-wl-carousel', RP_URL.'/assets/js/owl.carousel.js',array('jquery'),'1.3.2', false);
}
add_action( 'wp_enqueue_scripts', 'rp_adding_scripts' );



/**
 * Enqueue CSS files
 */

function rp_adding_style() {
	wp_enqueue_style( 'rp_google_fonts', '//fonts.googleapis.com/css?family=Titillium+Web', false );
	wp_enqueue_style('rp_owl_carousel', RP_URL.'/assets/css/owl.carousel.css','','1.3.2', false);
	wp_enqueue_style('rp_main_style', RP_URL.'/assets/css/main.css','','1.0', false);
}
add_action( 'wp_enqueue_scripts', 'rp_adding_style',11 );


if( !function_exists('get_option_value') ){

	function get_option_value( $key='', $default = '' ) {

	    if ( isset( $key) ) {
	        return $key;
	    }
	    return $default;
	}

}



/**
 * Related Product Function
 */

if( !function_exists('rp_related_products') ){
	function rp_related_products(){
		global $post,$product,
			$default_rp_show_product_price,
			$default_rp_show_product_name,
			$default_rp_show_product_btn_add,
			$default_rp_number_related_products,
			$default_rp_columns_related_products,
			$default_rp_related_products_by,
			$default_rp_slider_type,
			$default_rp_show_type,
			$default_rp_ribbon_sale_text,
			$default_rp_ribbon_sale_position,
			$default_rp_columns_desktop,
			$default_rp_columns_desktop_small,
			$default_rp_columns_tablet,
			$default_rp_columns_mobile,
			$default_rp_slider_auto_play,
			$default_rp_slider_auto_play_speed,
			$default_rp_slider_pagination,
			$default_rp_slider_navigation,
			$default_rp_slider_navigation_prev_text,
			$default_rp_slider_navigation_next_text,
			$default_rp_slider_paginationNumbers,
			$default_rp_slider_direction;

		if ( empty( $product ) || ! $product->exists() ) {
			return;
		}


		$custom_terms = get_terms(get_option_value(get_option('rp_related_products_by'),$default_rp_related_products_by));//product_type
		foreach($custom_terms as $term)
		{
			$product_based_id[] = $term->term_id;
		}

			$args = array(
				'post__not_in' 			=> 	array( $product->id ),
				//'post__in' 				=> 	$related,
				'posts_per_page'		=>	get_option_value(get_option('rp_number_related_products'),$default_rp_number_related_products),
				'post_type' 			=> 	'product',
				'orderby' 				=> 	'rand',
				'order'   				=> 	'DESC',
				'ignore_sticky_posts' 	=> 	1,
				'no_found_rows'        	=> 	1,
				'tax_query' => array(
            array(
                'taxonomy' => get_option_value(get_option('rp_related_products_by'),$default_rp_related_products_by),
                'field' => 'id',
                'terms' => $product_based_id,
            ),
        ),

			);

			$wp_query = new WP_Query( $args );

			?>
			<?php if ($wp_query->have_posts()):?>
				<div class="rp_related_products_area <?php echo get_option_value(get_option('rp_slider_navigation_position'),$default_rp_slider_navigation_position)?>">

					<h2 class="rp_related_products_area_title"><span><?php echo apply_filters('rp_title', get_option('rp_title'));  ?></span></h2>
					<div class="rp_related_products  <?php echo get_option('rp_slider_type')=='theme_basic'?'rp_theme_basic':('rp_theme_hover rp_'.get_option_value(get_option('rp_slider_type'),$default_rp_slider_type)) ?>   ">

						<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>

							<?php
								global $post,$product;
								$price_html = $product->get_price_html();
							?>
								<div class="rp-item <?php echo implode( get_post_class()," " ) ?>">


								<?php
									if ( $product->is_on_sale() ) {
							        	echo apply_filters( 'woocommerce_sale_flash', '<span class="rp_onsale rp_ribbon_top_right">Sale</span>', $post, $product );
							        }
								?>

								<figure>
									<a href="<?php the_permalink(); ?>" class="rp_img_url"><?php echo woocommerce_get_product_thumbnail(); ?></a>
									<figcaption >



										<?php

												echo '
											<h3 class="rp_title">
												<a href="'.post_permalink( $post->ID ).'">'.$post->post_title.'</a>
											</h3>';


										?>


										<?php

										echo ( $price_html ? '<a href="'.post_permalink( $post->ID ).'"><div class="rp_price">'.$price_html.'</div></a>' : '' );

										 ?>


										<div class="rp_cart_btn">
											<?php

											 	woocommerce_template_loop_add_to_cart();

											 ?>
										</div>

									</figcaption>
								</figure>

</div>
						<?php endwhile; ?>

					</div><!-- rp_related_products_area -->

				</div>

				 <script>
					jQuery(".rp_related_products").owlCarousel({
							items :<?php echo get_option_value(get_option('rp_number_related_products_columns'),$default_rp_columns_related_products);?>,
							itemsDesktop : [1199,4],
					    itemsDesktopSmall : [980,3],
					    itemsTablet: [768,2],
					    itemsMobile : [479,1],

							//Autoplay
					    autoPlay : <?php echo get_option_value(get_option('rp_slider_auto_play'),$default_rp_slider_auto_play);?>,
					    stopOnHover : true,

					    // Navigation
					    navigation : <?php echo get_option_value(get_option('rp_slider_navigation'),$default_rp_slider_navigation);?>,
					    navigationText : ['<?php echo get_option_value(get_option('rp_slider_navigation_prev_text'),$default_rp_slider_navigation_prev_text);?>','<?php echo get_option_value(get_option('rp_slider_navigation_next_text'),$default_rp_slider_navigation_next_text);?>'],
					    rewindNav : true,
					    scrollPerPage : false,

					    //Pagination
					    pagination : <?php echo get_option_value(get_option('rp_slider_pagination'),$default_rp_slider_pagination);?>,
					    paginationNumbers: <?php echo get_option_value(get_option('rp_slider_pagination_number'),$default_rp_slider_paginationNumbers);?>,

					    //Basic Speeds
					    slideSpeed : 1800,
					    paginationSpeed : 1800,
					    rewindSpeed : 1000,
							direction:'<?php echo get_option_value(get_option('rp_slider_direction'),$default_rp_slider_direction);?>'


					});
				</script>

			<?php
			endif;
			wp_reset_postdata();

		//}
	}
}



/**
 * Removing WooCommerce default relative products form @woocommerce_after_single_product_summary
 */
 function wc_remove_related_products( $args ) {
 	return array();
 }
 add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

/**
 * Adding this plugin relative products slider to @woocommerce_after_single_product_summary
 */

add_action( 'woocommerce_after_single_product_summary', 'rp_related_products',22 );


?>
