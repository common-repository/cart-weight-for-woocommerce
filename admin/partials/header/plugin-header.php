<?php
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="dotsstoremain">
	<div class="all-pad">
		<header class="dots-header">
			<div class="dots-logo-main">
				<img src="<?php echo esc_url( CWFW_PLUGIN_URL . '/admin/images/woo-product-att-logo.png' ); ?>">
			</div>
			<div class="dots-header-right">
				<div class="logo-detail">
					<strong><?php echo wp_kses_post( CWFW_PLUGIN_NAME ); ?></strong>
					<span><?php esc_html_e( 'Free Version ' ); ?><?php echo esc_html( '1.0.7' ) ?></span>
				</div>
				<div class="button-dots">
                    <span class="upgrade_pro_image" style="display: none; ">
                        <a target="_blank" href="<?php echo esc_url( 'http://thedotstore.com/cart-weight-for-woocommerce' ); ?>">
                            <img src="<?php echo esc_url( CWFW_PLUGIN_URL . '/admin/images/upgrade_new.png' ); ?>">
                        </a>
                    </span>
					<span class="support_dotstore_image">
                        <a target="_blank" href="<?php echo esc_url( 'https://www.thedotstore.com/support' ); ?>">
                            <img src="<?php echo esc_url( CWFW_PLUGIN_URL . '/admin/images/support_new.png' ); ?>">
                        </a>
                    </span>
				</div>
			</div>
			<?php
			$about_plugin_setting_menu_enable = '';
			$about_plugin_get_started         = '';
			$about_plugin_quick_info          = '';
			$dotstore_setting_menu_enable     = '';
			$cwfw_plugin_setting_page         = '';
			$cwfw_pro_details                 = '';
			$custom_tab                       = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
			$custom_page                      = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );

			if ( ! empty( $custom_tab ) && 'cwfw_plugin_setting_page' === $custom_tab ) {
				$cwfw_plugin_setting_page = "acitve";
			}
			if ( empty( $custom_tab ) && 'cart_weight_for_woocommerce' === $custom_page ) {
				$cwfw_plugin_setting_page = "acitve";
			}
			if ( ! empty( $custom_tab ) && 'cwfw-pro-details-page' === $custom_tab ) {
				$cwfw_pro_details = "acitve";
			}
			if ( ! empty( $custom_tab ) && 'cwfw-plugin-getting-started' === $custom_tab ) {
				$about_plugin_setting_menu_enable = "acitve";
				$about_plugin_get_started         = "acitve";
			}
			if ( ! empty( $custom_tab ) && 'cwfw-plugin-quick-info' === $custom_tab ) {
				$about_plugin_setting_menu_enable = "acitve";
				$about_plugin_quick_info          = "acitve";
			}
			?>

			<div class="dots-menu-main">
				<nav>
					<ul>
						<li><a class="dotstore_plugin <?php echo esc_attr( $cwfw_plugin_setting_page ); ?>"
						       href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=cart_weight_for_woocommerce&tab=cwfw_plugin_setting_page' ) ); ?>"><?php esc_html_e( 'Settings', 'cart-weight-for-woocommerce' ) ?></a>
						</li>
						<li>
							<a class="dotstore_plugin <?php echo esc_attr( $about_plugin_setting_menu_enable ); ?>"
							   href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=cart_weight_for_woocommerce&tab=cwfw-plugin-getting-started' ) ); ?>"><?php esc_html_e(
									'About Plugin', 'cart-weight-for-woocommerce' ) ?></a>
							<ul class="sub-menu">
								<li>
									<a class="dotstore_plugin <?php echo esc_attr( $about_plugin_get_started ); ?>"
									   href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=cart_weight_for_woocommerce&tab=cwfw-plugin-getting-started' ) ); ?>"><?php
										esc_html_e( 'Getting Started', 'cart-weight-for-woocommerce' ) ?></a>
								</li>
								<li>
									<a class="dotstore_plugin <?php echo esc_attr( $about_plugin_quick_info ); ?>"
									   href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=cart_weight_for_woocommerce&tab=cwfw-plugin-quick-info' ) ); ?>"><?php
										esc_html_e( 'Quick info', 'cart-weight-for-woocommerce' ) ?></a>
								</li>
							</ul>
						</li>
						<li>
							<a class="dotstore_plugin <?php echo esc_attr( $dotstore_setting_menu_enable ); ?>"
							   href="#"><?php esc_html_e( 'Dotstore', 'cart-weight-for-woocommerce' ); ?></a>
							<ul class="sub-menu">
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-plugins/" ); ?>"><?php esc_html_e( 'WooCommerce Plugins', 'cart-weight-for-woocommerce' ); ?></a>
								</li>
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/wordpress-plugins/" ); ?>"><?php esc_html_e( 'Wordpress Plugins', 'cart-weight-for-woocommerce' ); ?></a>
								</li>
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/support/" ); ?>"><?php esc_html_e( 'Contact Support', 'cart-weight-for-woocommerce' ); ?></a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</header>