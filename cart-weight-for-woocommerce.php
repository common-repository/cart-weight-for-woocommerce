<?php

/**
 *
 * Plugin Name:       Cart Weight for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/cart-weight-for-woocommerce/
 * Description:       Display the product weight and total order weight in cart, mini cart and checkout page
 * Version:           1.0.7
 * Author:            theDotstore
 * Author URI:        https://www.thedotstore.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cart-weight-for-woocommerce
 * Domain Path:       /languages
 * WC tested up to: 4.9
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( function_exists( 'cwfw_fs' ) ) {
    cwfw_fs()->set_basename( false, __FILE__ );
    return;
}

add_action( 'plugins_loaded', 'cwfw_plugin_init' );
$wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );
if ( !defined( 'CWFW_PLUGIN_URL' ) ) {
    define( 'CWFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( true === $wc_active ) {
    
    if ( !function_exists( 'cwfw_fs' ) ) {
        // Create a helper function for easy SDK access.
        function cwfw_fs()
        {
            global  $cwfw_fs ;
            
            if ( !isset( $cwfw_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $cwfw_fs = fs_dynamic_init( array(
                    'id'             => '5381',
                    'slug'           => 'cart-weight-for-woocommerce',
                    'premium_slug'   => 'woo-product-attachment-premium',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_086c312a24f41865ec565e2548f3b',
                    'is_premium'     => false,
                    'premium_suffix' => 'Pro',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'menu'           => array(
                    'slug'       => 'cart_weight_for_woocommerce',
                    'first-path' => 'admin.php?page=cart_weight_for_woocommerce',
                    'contact'    => false,
                    'support'    => false,
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $cwfw_fs;
        }
        
        // Init Freemius.
        cwfw_fs();
        // Signal that SDK was initiated.
        do_action( 'cwfw_fs_loaded' );
        // Not like register_uninstall_hook(), you do NOT have to use a static function.
        cwfw_fs()->add_action( 'after_uninstall', 'cwfw_fs_uninstall_cleanup' );
    }
    
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-cart-weight-for-woocommerce-activator.php
     */
    function cwfw_activate_cart_weight_for_woocommerce()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-cart-weight-for-woocommerce-activator.php';
        CWFW_Cart_Weight_For_Woocommerce_Activator::activate();
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-cart-weight-for-woocommerce-deactivator.php
     */
    function cwfw_deactivate_cart_weight_for_woocommerce()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-cart-weight-for-woocommerce-deactivator.php';
        CWFW_Cart_Weight_For_Woocommerce_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'cwfw_activate_cart_weight_for_woocommerce' );
    register_deactivation_hook( __FILE__, 'cwfw_deactivate_cart_weight_for_woocommerce' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-cart-weight-for-woocommerce.php';
    /**
     * Define all constants
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-cart-weight-for-woocommerce-constants.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    function cwfw_run_cart_weight_for_woocommerce()
    {
        $plugin = new CWFW_Cart_Weight_For_Woocommerce();
        $plugin->cwfw_run();
    }

}

/**
 * Check plugin requirement on plugins loaded
 * this plugin requires WooCommerce to be installed and active
 */
function cwfw_plugin_init()
{
    $wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );
    
    if ( current_user_can( 'activate_plugins' ) && $wc_active !== true || $wc_active !== true ) {
        add_action( 'admin_notices', 'cwfw_plugin_admin_notice' );
    } else {
        cwfw_run_cart_weight_for_woocommerce();
    }

}

/**
 * Show admin notice in case of WooCommerce plugin is missing.
 */
function cwfw_plugin_admin_notice()
{
    $vpe_plugin = esc_html__( 'Cart Weight for WooCommerce', 'cart-weight-for-woocommerce' );
    $wc_plugin = esc_html__( 'WooCommerce', 'cart-weight-for-woocommerce' );
    ?>
	<div class="error">
		<p>
			<?php 
    echo  sprintf( esc_html__( '%1$s is ineffective as it requires %2$s to be installed and active.', 'cart-weight-for-woocommerce' ), '<strong>' . esc_html( $vpe_plugin ) . '</strong>', '<strong>' . esc_html( $wc_plugin ) . '</strong>' ) ;
    ?>
		</p>
	</div>
	<?php 
}

/**
 * Get the total cart weight from the order object
 *
 * @param $order
 *
 * @return string
 */
function cwfw_get_total_weight_from_order_object( $order )
{
    $total_weight = 0;
    foreach ( $order->get_items() as $item_id => $product_item ) {
        $quantity = $product_item->get_quantity();
        // get quantity
        $product = $product_item->get_product();
        // get the WC_Product object
        $item_weight = $product->get_weight();
        // get the product weight
        if ( isset( $item_weight ) && !empty($item_weight) && true !== $product->is_virtual() ) {
            $total_weight += floatval( $item_weight * $quantity );
        }
    }
    return $total_weight . ' ' . get_option( 'woocommerce_weight_unit' );
}