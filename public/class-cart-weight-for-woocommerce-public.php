<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    CWFW_Cart_Weight_For_Woocommerce
 * @subpackage CWFW_Cart_Weight_For_Woocommerce/public
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CWFW_Cart_Weight_For_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function cwfw_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CWFW_Cart_Weight_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CWFW_Cart_Weight_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name . 'aaa', plugin_dir_url( __FILE__ ) . 'css/cart-weight-for-woocommerce-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Add Cart Weight to Cart and Checkout
	 *
	 * @since    1.0.0
	 */
	public function cwfw_woocommerce_order_total_action() {
		$plugin = new CWFW_Cart_Weight_For_Woocommerce();

		$cwfw_active_status      = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_status' );
		$cwfw_total_weight_label = $plugin->cwfw_get_global_setting_by_key( 'cwfw_total_weight_label' );

		if ( 'on' === $cwfw_active_status ) {
			$cart_weight = WC()->cart->get_cart_contents_weight();
			if ( WC()->cart->needs_shipping() && ! empty( $cart_weight ) ) {
				?>
				<tr class="total-weight">
					<th><?php esc_attr_e( $cwfw_total_weight_label, 'woocommerce-cart-weight' ); ?></th>
					<td data-title="<?php echo esc_attr__( $cwfw_total_weight_label, 'woocommerce-cart-weight' ); ?>"><strong><?php echo esc_html( $cart_weight . ' ' .
					                                                                                                                               get_option( 'woocommerce_weight_unit' ) ); ?></strong>
					</td>
				</tr>
				<?php
			}
		}
	}

	/**
	 * @param $message
	 *
	 * @since    1.0.0
	 *
	 * @return string
	 */
	function cwfw_add_to_cart_filter_callback( $message ) {

		global $woocommerce;
		$plugin             = new CWFW_Cart_Weight_For_Woocommerce();
		$cwfw_active_notice = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_notice' );
		$cwfw_weight_notice = $plugin->cwfw_get_global_setting_by_key( 'cwfw_weight_notice' );
		if ( 'on' === $cwfw_active_notice ) {

			$cart_weight = $woocommerce->cart->cart_contents_weight . ' ' . get_option( 'woocommerce_weight_unit' );
			$message     = $message . sprintf( esc_html__( ' ' . $cwfw_weight_notice . ': %s', 'woocommerce' ), $cart_weight );
		}

		return $message;
	}

	function cwfw_add_custom_weight_data( $item_id, $item, $order, $flag = false ) {
		$plugin              = new CWFW_Cart_Weight_For_Woocommerce();
		$cwfw_active_status  = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_status' );
		$cwfw_product_weight = $plugin->cwfw_get_global_setting_by_key( 'cwfw_product_weight' );
		$item_array          = $item->get_data();

		$product_id = ( isset( $item_array['variation_id'] ) && ! empty( $item_array['variation_id'] ) ) ? $item_array['variation_id'] : $item_array['product_id'];
		$_product   = wc_get_product( $product_id );

		if ( 'on' === $cwfw_active_status ) {
			$item_weight = floatval( $_product->get_weight() ) * $item_array['quantity'];

			if ( isset( $item_weight ) && ! empty( $item_weight ) && true !== $_product->is_virtual() ) {
				wc_add_order_item_meta( $item_id, $cwfw_product_weight, $item_weight . ' ' . get_option( 'woocommerce_weight_unit' ), true );
			}
		}
	}

	/**
	 * Add the weight for each product in the cart
	 *
	 * @param $item_data
	 * @param $cart_item
	 *
	 * @return array
	 */
	function cwfw_displaying_cart_items_weight( $item_data, $cart_item ) {

		$plugin = new CWFW_Cart_Weight_For_Woocommerce();

		$cwfw_active_status  = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_status' );
		$cwfw_product_weight = $plugin->cwfw_get_global_setting_by_key( 'cwfw_product_weight' );

		$show_product_based_weight = apply_filters('show_product_based_weight',true);
		if ( 'on' === $cwfw_active_status && true === $show_product_based_weight) {
			$item_weight = floatval( $cart_item['data']->get_weight() ) * $cart_item['quantity'];
			if ( isset( $item_weight ) && ! empty( $item_weight ) && true !== $cart_item['data']->is_virtual() ) {
				$item_data[] = array(
					'key'     => __( $cwfw_product_weight, 'cart-weight-for-woocommerce' ),
					'value'   => $item_weight,
					'display' => $item_weight . ' ' . get_option( 'woocommerce_weight_unit' ),
				);
			}
		}

		return $item_data;
	}

	/**
	 * Save the meta for total order weight and display on thank you page.
	 *
	 * @param $total_rows
	 * @param $order
	 *
	 * @return mixed
	 */
	function cwfw_get_item_weight_total( $total_rows, $order ) {
		$plugin = new CWFW_Cart_Weight_For_Woocommerce();

		$cwfw_active_status      = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_status' );
		$cwfw_total_weight_label = $plugin->cwfw_get_global_setting_by_key( 'cwfw_total_weight_label' );
		if ( 'on' === $cwfw_active_status ) {
			$order_id     = $order->get_id();
			$total_weight = cwfw_get_total_weight_from_order_object( $order );
			update_post_meta( $order_id, '_cart_weight', $total_weight );
			$total_rows['order_total_weight'] = array(
				'label' => __( $cwfw_total_weight_label, 'cart-weight-for-woocommerce' ),
				'value' => $total_weight,
			);
		}

		return $total_rows;
	}
}