<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    CWFW_Cart_Weight_For_Woocommerce
 * @subpackage CWFW_Cart_Weight_For_Woocommerce/includes
 * @author     multidots
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CWFW_Cart_Weight_For_Woocommerce_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cart-weight-for-woocommerce', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}