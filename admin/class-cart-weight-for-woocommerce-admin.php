<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CWFW_Cart_Weight_For_Woocommerce
 * @subpackage CWFW_Cart_Weight_For_Woocommerce/admin
 * @author     multidots
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CWFW_Cart_Weight_For_Woocommerce_Admin {

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
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 *
	 * @since    1.0.0
	 *
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function cwfw_enqueue_styles( $hook ) {
		global $typenow;


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
		if ( isset( $hook ) && ! empty( $hook ) && ( "dotstore-plugins_page_cart_weight_for_woocommerce" === $hook ) || ! empty( $typenow ) && ( 'product' === $typenow ) ) {

			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( $this->plugin_name . '-wcosi-main-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cart-weight-for-woocommerce-admin.css', array(), $this->version, 'all' );
			wp_enqueue_script( $this->plugin_name . '-wcosi-main-script', plugin_dir_url( __FILE__ ) . 'js/cart-weight-for-woocommerce-admin.js', array(), $this->version, 'all' );
		}
	}
	/**
	 *
	 * Dotstore menu add
	 *
	 * @since    1.0.0
	 */
	public function dot_store_menu() {
		global $GLOBALS;

		if ( empty( $GLOBALS['admin_page_hooks']['dots_store'] ) ) {
			add_menu_page(
				'DotStore Plugins', __( 'DotStore Plugins', 'cart-weight-for-woocommerce' ), 'NULL', 'dots_store', array(
				$this,
				'dot_store_menu_page',
			), plugin_dir_url( __FILE__ ) . 'images/menu-icon.png', 25
			);
		}
	}

	/**
	 *
	 * Cart Weight for WooCommerce menu add
	 *
	 * @since    1.0.0
	 */
	public function cwfw_plugin_menu() {
		add_submenu_page( "dots_store", __( 'Cart Weight for WooCommerce', 'cart-weight-for-woocommerce' ), "Cart Weight for WooCommerce",
			"manage_options", "cart_weight_for_woocommerce", array(
				$this,
				"cwfw_options_page",
			) );
	}

	/**
	 * Cart Weight for WooCommerce Option Page HTML
	 *
	 * @since    1.0.0
	 */
	public function cwfw_options_page() {
		$file_dir_path = 'partials/header/plugin-header.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			include_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}

		$custom_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
		if ( ! empty( $custom_tab ) ) {
			if ( "cwfw_plugin_setting_page" === $custom_tab ) {
				self::cwfw_setting_page();
			}
			if ( "cwfw-plugin-getting-started" === $custom_tab ) {
				self::cwfw_get_started_dots_about_plugin_settings();
			}
			if ( "cwfw-plugin-quick-info" === $custom_tab ) {
				self::cwfw_dotstore_about_plugin_store_pro();
			}
		} else {
			self::cwfw_setting_page();
		}

		$file_dir_path = 'partials/header/plugin-sidebar.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			include_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}
	}

	/**
	 * Function to return Setting Page HTML
	 *
	 * @since    1.0.0
	 */
	public function cwfw_setting_page() {
		$plugin = new CWFW_Cart_Weight_For_Woocommerce();

		$cwfw_weight_notice      = filter_input( INPUT_POST, 'cwfw_weight_notice', FILTER_SANITIZE_STRING );
		$cwfw_product_weight     = filter_input( INPUT_POST, 'cwfw_product_weight', FILTER_SANITIZE_STRING );
		$cwfw_total_weight_label = filter_input( INPUT_POST, 'cwfw_total_weight_label', FILTER_SANITIZE_STRING );
		$cwfw_active_status      = filter_input( INPUT_POST, 'cwfw_active_status', FILTER_SANITIZE_STRING );
		$cwfw_active_notice      = filter_input( INPUT_POST, 'cwfw_active_notice', FILTER_SANITIZE_STRING );
		$cwfw_product_weight     = isset( $cwfw_product_weight ) && ! empty( $cwfw_product_weight ) ? $cwfw_product_weight : esc_html( 'Weight', 'cart-weight-for-woocommerce' );
		$cwfw_weight_notice      = isset( $cwfw_weight_notice ) && ! empty( $cwfw_weight_notice ) ? $cwfw_weight_notice : esc_html( 'Cart weight is', 'cart-weight-for-woocommerce' );

		$cwfw_total_weight_label = isset( $cwfw_total_weight_label ) && ! empty( $cwfw_total_weight_label ) ? $cwfw_total_weight_label : esc_html( 'Total weight', 'cart-weight-for-woocommerce' );
		$cwfw_active_status      = isset( $cwfw_active_status ) && ! empty( $cwfw_active_status ) ? $cwfw_active_status : '';
		$cwfw_active_notice      = isset( $cwfw_active_notice ) && ! empty( $cwfw_active_notice ) ? $cwfw_active_notice : '';

		$btn_submit                    = filter_input( INPUT_POST, 'submit', FILTER_SANITIZE_STRING );
		$custom_page                   = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
		$cwfw_attachment_setting_nonce = filter_input( INPUT_POST, 'cwfw_attachment_setting_nonce', FILTER_SANITIZE_STRING );
		if ( isset( $btn_submit ) && isset( $custom_page ) && 'cart_weight_for_woocommerce' === $custom_page ) {
			// verify nonce
			if ( ! isset( $cwfw_attachment_setting_nonce ) || ! wp_verify_nonce( $cwfw_attachment_setting_nonce, basename( __FILE__ ) ) ) {
				die( 'Failed security check' );
			}
			$single_setting_array = array(
				'cwfw_weight_notice'      => $cwfw_weight_notice,
				'cwfw_product_weight'     => $cwfw_product_weight,
				'cwfw_total_weight_label' => $cwfw_total_weight_label,
				'cwfw_active_status'      => $cwfw_active_status,
				'cwfw_active_notice'      => $cwfw_active_notice,
			);
			$single_setting_array = wp_json_encode( $single_setting_array );
			update_option( 'cwfw_setting_array', $single_setting_array );
		}

		$cwfw_active_status = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_status' );
		$cwfw_active_notice = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_notice' );

		$cwfw_total_weight_label = $plugin->cwfw_get_global_setting_by_key( 'cwfw_total_weight_label' );
		$cwfw_product_weight     = $plugin->cwfw_get_global_setting_by_key( 'cwfw_product_weight' );
		$cwfw_weight_notice      = $plugin->cwfw_get_global_setting_by_key( 'cwfw_weight_notice' );

		$cwfw_active_status = ( ! empty( $cwfw_active_status ) && 'on' === $cwfw_active_status && "" !== $cwfw_active_status ) ? 'checked' : '';
		$cwfw_active_notice = ( ! empty( $cwfw_active_notice ) && 'on' === $cwfw_active_notice && "" !== $cwfw_active_notice ) ? 'checked' : '';
		?>
		<div class="cwfw-section-left cwfw_wrapper">
			<?php
			if ( isset( $btn_submit ) && isset( $custom_page ) && 'cart_weight_for_woocommerce' === $custom_page ) { ?>
				<div class="ms-msg"><?php esc_html_e( 'Settings has been saved.', 'cart-weight-for-woocommerce' ); ?></div>
			<?php }
			?>
			<div class="cwfw-table-main">
				<form method="post" action="">
					<?php wp_nonce_field( basename( __FILE__ ), 'cwfw_attachment_setting_nonce' ); ?>
					<table class="cwfw-tableouter">
						<tbody>
						<tr>
							<th>
								<label class="cwfw-name"
								       for="cwfw_active_status"><?php esc_html_e( 'Showcase weight on checkout process', 'cart-weight-for-woocommerce' ) ?></label>
							</th>
							<td class="">
								<div class="switch_status_div">
									<label class="switch switch_in_pricing_rules">
										<input type="checkbox" name="cwfw_active_status"
										       value="on" <?php echo esc_attr( $cwfw_active_status ); ?>>
										<div class="slider round"></div>
									</label>
									<span class="cwfw_tooltip_icon"></span>
									<p class="cwfw_tooltip_desc description">
										<?php
										esc_html_e( 'Active to showcase total cart weight on cart and checkout page after total amount.', 'cart-weight-for-woocommerce' );
										?>
									</p>
								</div>
							</td>
						</tr>
						<tr>
							<th>
								<label class="cwfw-name" for="cwfw_active_notice"><?php esc_html_e( 'Showcase total cart weight notice', 'cart-weight-for-woocommerce' ) ?></label>
							</th>
							<td class="">
								<div class="switch_status_div">
									<label class="switch switch_in_pricing_rules">
										<input type="checkbox" name="cwfw_active_notice"
										       value="on" <?php echo esc_attr( $cwfw_active_notice ); ?>>
										<div class="slider round"></div>
									</label>
									<span class="cwfw_tooltip_icon"></span>
									<p class="cwfw_tooltip_desc description">
										<?php
										esc_html_e( 'Showcase total cart weight after adding product to the cart in product detail page.', 'cart-weight-for-woocommerce' );
										?>
									</p>
								</div>
							</td>
						</tr>
						<tr>
							<th>
								<label class="cwfw-name" for="cwfw_total_weight"><?php esc_html_e( 'Custom label for total cart weight', 'cart-weight-for-woocommerce' ) ?></label>
							</th>
							<td class="">
								<div class="cwfw-name-txtbox">
									<input id="cwfw_total_weight_label" name="cwfw_total_weight_label" type="text" placeholder="Total Weight" value="<?php esc_html_e
									( $cwfw_total_weight_label ) ?>">
									<span class="cwfw_tooltip_icon"></span>
									<p class="cwfw_tooltip_desc description">
										<?php
										esc_html_e( 'This custom label showcase on cart and checkout page during the checkout process.', 'cart-weight-for-woocommerce' );
										?>
									</p>
								</div>

							</td>
						</tr>
						<tr>
							<th>
								<label class="cwfw-name"
								       for="cwfw_product_weight"><?php esc_html_e( 'Custom label for each product weight', 'cart-weight-for-woocommerce' ) ?></label>
							</th>
							<td class="">
								<div class="cwfw-name-txtbox">
									<input id="cwfw_product_weight" name="cwfw_product_weight" type="text" placeholder="Product based weight title" value="<?php esc_html_e
									( $cwfw_product_weight ) ?>">
									<span class="cwfw_tooltip_icon"></span>
									<p class="cwfw_tooltip_desc description">
										<?php
										esc_html_e( 'This label will display on cart and checkout page for each product row.', 'cart-weight-for-woocommerce' );
										?>
									</p>
								</div>
							</td>
						</tr>
						<tr>
							<th>
								<label class="cwfw-name"
								       for="cwfw_weight_notice"><?php esc_html_e( 'Custom label for showcase notice on product detail page', 'cart-weight-for-woocommerce' ) ?></label>
							</th>
							<td class="">
								<div class="cwfw-name-txtbox">
									<input id="cwfw_weight_notice" name="cwfw_weight_notice" type="text" placeholder="Message for the weight notice" value="<?php esc_html_e
									( $cwfw_weight_notice ) ?>">
									<span class="cwfw_tooltip_icon"></span>
									<p class="cwfw_tooltip_desc description">
										<?php
										esc_html_e( 'This label will display on product detail page after adding the product to the cart.', 'cart-weight-for-woocommerce' );
										?>
									</p>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="cwfw-setting-btn">
								<p class="submit-cart-weight">
									<input type="submit" name="submit" id="submit" class="button button-primary"
									       value="<?php esc_html_e( 'Save Changes', 'cart-weight-for-woocommerce' ) ?>">
								</p>
							</td>
						</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * function for custom get started page
	 *
	 * @since    1.0.0
	 */
	function cwfw_get_started_dots_about_plugin_settings() {
		$file_dir_path = 'partials/cwfw-plugin-get-started.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			require_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}
	}

	/**
	 * Custom menu html for information about plugin
	 *
	 * @since    1.0.0
	 */
	function cwfw_dotstore_about_plugin_store_pro() {
		$file_dir_path = 'partials/cwfw-plugin-quick-info.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			require_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}
	}

	/**
	 * Display the total order weight on order detail for admin.
	 *
	 * @param $order_id
	 */
	function cwfw_custom_admin_order_totals_after_tax( $order_id ) {

		$plugin                  = new CWFW_Cart_Weight_For_Woocommerce();
		$cwfw_active_status      = $plugin->cwfw_get_global_setting_by_key( 'cwfw_active_status' );
		$cwfw_total_weight_label = $plugin->cwfw_get_global_setting_by_key( 'cwfw_total_weight_label' );

		if ( 'on' === $cwfw_active_status ) {
			$cwfw_total_order_weight = get_post_meta( $order_id, '_cart_weight', true );

			?>
			<tr>
				<td class="label"><?php echo esc_html( $cwfw_total_weight_label, 'cart-weight-for-woocommerce' ); ?>:</td>
				<td width="1%"></td>
				<td class="order-weight"><span class="amount"><?php echo esc_html( $cwfw_total_order_weight ); ?></span></td>
			</tr>
			<?php
		}
	}
}