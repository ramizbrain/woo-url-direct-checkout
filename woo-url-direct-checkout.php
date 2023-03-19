<?php
/**
 * Plugin Name: Woo URL Direct Checkout
 * Plugin URI: https://instagram.com/ramizbrain/
 * Description: Add multiple items to cart on the URL parameter.
 * Version: 1.0.0
 * Author: Ramiz Brain
 * Author URI: https://instagram.com/ramizbrain/
 */

/**
 * Add multiple products with quantities to cart using "add-to-cart" URL parameter.
 * Format: https://example.com/?add-to-cart=product_id:quantity,product_id:quantity,...
 * Example: https://example.com/?add-to-cart=141:2,170:4
 */

add_action( 'init', 'add_multiple_products_to_cart' );
function add_multiple_products_to_cart() {
    if ( isset( $_GET['add-to-cart'] ) && strpos( $_GET['add-to-cart'], ':' ) !== false ) {
        // Clear the cart before adding new items
        WC()->cart->empty_cart();

        $products = explode( ',', $_GET['add-to-cart'] );
        $cart = WC()->cart;
        foreach ( $products as $product ) {
            list( $product_id, $quantity ) = explode( ':', $product );
            $cart->add_to_cart( $product_id, $quantity );
        }
    }
}
