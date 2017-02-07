<?php
/**
 * Show options for ordering
 *
 * @author                 WooThemes
 * @package         WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
        return;
?>
<form class="woocommerce-ordering" method="get">
        <select name="orderby" class="orderby form-control">
            <?php
                $catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
                    'menu_order' => __( 'Sort Products By...', 'woocommerce' ),
                    'popularity' => __( 'Popularity', 'woocommerce' ),
                    'rating'     => __( 'Average Rating', 'woocommerce' ),
                    'date'       => __( 'Newness', 'woocommerce' ),
                    'price'      => __( 'Price: Low to High', 'woocommerce' ),
                    'price-desc' => __( 'Price: High to Low', 'woocommerce' )
                ) );

                if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
                    unset( $catalog_orderby['rating'] );

                foreach ( $catalog_orderby as $id => $name )
                    echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
            ?>
        </select>
        <?php
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' == $key )
                    continue;
                
                if (is_array($val)) {
                    foreach($val as $innerVal) {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                    }
                
                } else {
                   echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                }
            }
        ?>
</form>