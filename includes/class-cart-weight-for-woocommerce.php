<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    CWFW_Cart_Weight_For_Woocommerce
 * @subpackage CWFW_Cart_Weight_For_Woocommerce/includes
 * @author     Thedotstore
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class CWFW_Cart_Weight_For_Woocommerce
 */
class CWFW_Cart_Weight_For_Woocommerce {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      CWFW_Cart_Weight_For_Woocommerce_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'cart-weight-for-woocommerce';
		$this->version     = '1.0.3';

		$this->cwfw_load_dependencies();
		$this->cwfw_set_locale();
		$this->cwfw_define_admin_hooks();
		$this->cwfw_define_public_hooks();
		$prefix    = is_network_admin() ? 'network_admin_' : '';
		$file_path = 'cart-weight-for-woocommerce/cart-weight-for-woocommerce.php';
		add_filter( "{$prefix}plugin_action_links_" . $file_path, array( $this, 'cwfw_plugin_action_links' ), 10, 1 );

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CWFW_Cart_Weight_For_Woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - CWFW_Cart_Weight_For_Woocommerce_i18n. Defines internationalization functionality.
	 * - CWFW_Cart_Weight_For_Woocommerce_Admin. Defines all hooks for the admin area.
	 * - CWFW_Cart_Weight_For_Woocommerce_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function cwfw_load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cart-weight-for-woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cart-weight-for-woocommerce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cart-weight-for-woocommerce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cart-weight-for-woocommerce-public.php';

		/**
		 * Admin side review block
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cart-weight-for-woocommerce-user-feedback.php';

		$this->loader = new CWFW_Cart_Weight_For_Woocommerce_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CWFW_Cart_Weight_For_Woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function cwfw_set_locale() {
		$plugin_i18n = new CWFW_Cart_Weight_For_Woocommerce_i18n();
		$this->loader->cwfw_add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function cwfw_define_admin_hooks() {
		$plugin_admin = new CWFW_Cart_Weight_For_Woocommerce_Admin( $this->cwfw_get_plugin_name(), $this->cwfw_get_version() );
		$this->loader->cwfw_add_action( 'admin_enqueue_scripts', $plugin_admin, 'cwfw_enqueue_styles' );
		if ( empty( $GLOBALS['admin_page_hooks']['dots_store'] ) ) {
			$this->loader->cwfw_add_action( 'admin_menu', $plugin_admin, 'dot_store_menu' );
		}
		$this->loader->cwfw_add_action( 'admin_menu', $plugin_admin, 'cwfw_plugin_menu' );
		$this->loader->cwfw_add_action( 'admin_wcpoa_setting_page', $plugin_admin, 'wcpoa_setting_page' );
		$this->loader->cwfw_add_action( 'woocommerce_admin_order_totals_after_tax', $plugin_admin, 'cwfw_custom_admin_order_totals_after_tax', 10, 1  );
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function cwfw_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function cwfw_get_version() {
		return $this->version;
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function cwfw_define_public_hooks() {
		$plugin_public = new CWFW_Cart_Weight_For_Woocommerce_Public( $this->cwfw_get_plugin_name(), $this->cwfw_get_version() );
		$this->loader->cwfw_add_action( 'wp_enqueue_scripts', $plugin_public, 'cwfw_enqueue_styles' );
		$this->loader->cwfw_add_action( 'woocommerce_cart_totals_after_order_total', $plugin_public, 'cwfw_woocommerce_order_total_action' );
		$this->loader->cwfw_add_action( 'woocommerce_review_order_after_order_total', $plugin_public, 'cwfw_woocommerce_order_total_action' );
		$this->loader->cwfw_add_action( 'woocommerce_get_order_item_totals', $plugin_public, 'cwfw_get_item_weight_total', 10, 2  );

		/**
		 * Display the message on product detail page after product added to the cart
		 */
		$this->loader->cwfw_add_filter(  'wc_add_to_cart_message_html', $plugin_public,'cwfw_add_to_cart_filter_callback', 10, 1 );
		$this->loader->cwfw_add_filter(  'woocommerce_order_item_meta_end', $plugin_public,'cwfw_add_custom_weight_data',10, 4  );
		$this->loader->cwfw_add_filter(  'woocommerce_get_item_data', $plugin_public,'cwfw_displaying_cart_items_weight', 10, 2 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function cwfw_run() {
		$this->loader->cwfw_run();
	}

	/**
	 * Return the plugin action links.  This will only be called if the plugin
	 * is active.
	 *
	 * @since 1.0.0
	 *
	 * @param array $actions associative array of action names to anchor tags
	 *
	 * @return array associative array of plugin action links
	 */
	public function cwfw_plugin_action_links( $actions) {
		$custom_actions = array(
			'configure' => sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=cart_weight_for_woocommerce' ), __( 'Settings', $this->plugin_name ) ),
		);

		return array_merge( $custom_actions, $actions );
	}

	/**
	 * Return the global option value by the key
	 *
	 * @param $option_name
	 *
	 * @return string
	 */
	public function cwfw_get_global_setting_by_key( $option_name = '' ) {

		$retrieve_single_setting_array = get_option( 'cwfw_setting_array' );
		$retrieve_single_setting_array = json_decode( $retrieve_single_setting_array, true );
		if ( '' !== $option_name && isset( $retrieve_single_setting_array[ $option_name ] ) ) {
			return $retrieve_single_setting_array[ $option_name ];
		}

		return '';
	}
}