<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$image_url         = CWFW_PLUGIN_URL.'admin/images/right_click.png';
?>
<div class="dotstore_plugin_sidebar">
	<?php
		$review_url = esc_url( 'https://wordpress.org/plugins/cart-weight-for-woocommerce/#reviews' );
		$plugin_at  = 'WP.org';

    ?>
    <div class="dotstore-important-link">
        <div class="image_box">
            <img src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/rate-us.png' ); ?>" alt="<?php esc_attr_e( 'Rate us', 'cart-weight-for-woocommerce' ); ?> ">
        </div>
        <div class="content_box">
            <h3>Like This Plugin?</h3>
            <p>Your Review is very important to us as it helps us to grow more.</p>
            <a class="btn_style" href="<?php echo $review_url;?>" target="_blank">Review Us on <?php echo $plugin_at; ?></a>
        </div>
    </div>
	<div class="dotstore-important-link">
		<h2><span class="dotstore-important-link-title"><?php esc_html_e( 'Important link', 'cart-weight-for-woocommerce' ); ?></span></h2>
		<div class="video-detail important-link">
			<ul>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://www.wordpress.org/plugins/cart-weight-for-woocommerce/" ); ?>"><?php esc_html_e( 'Plugin documentation', 'cart-weight-for-woocommerce' ); ?></a>
				</li>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://www.thedotstore.com/support/" ); ?>"><?php esc_html_e( 'Support platform', 'cart-weight-for-woocommerce' ); ?></a>
				</li>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://www.thedotstore.com/suggest-a-feature/" ); ?>"><?php esc_html_e( 'Suggest A Feature', 'cart-weight-for-woocommerce' ); ?></a>
				</li>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://www.wordpress.org/plugins/cart-weight-for-woocommerce/" ); ?>"><?php esc_html_e( 'Changelog', 'cart-weight-for-woocommerce' ); ?></a>
				</li>
			</ul>
		</div>
	</div>
    <!-- html for popular plugin !-->

    <div class="dotstore-important-link">
        <h2>
            <span class="dotstore-important-link-title">
                <?php esc_html_e( 'Our Popular plugins', 'cart-weight-for-woocommerce' ); ?>
            </span>
        </h2>
        <div class="video-detail important-link">
            <ul>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Advanced-Flat-Rate-Shipping-Method.png' ); ?>" alt="<?php esc_attr_e( 'Advanced Flat Rate Shipping Method', 'cart-weight-for-woocommerce' ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/advanced-flat-rate-shipping-method-for-woocommerce" ); ?>">
						<?php esc_html_e( 'Advanced Flat Rate Shipping Method', 'cart-weight-for-woocommerce' ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Conditional-Product-Fees-For-WooCommerce-Checkout.png' ); ?>" alt="<?php esc_attr_e( 'Conditional Product Fees For WooCommerce Checkout', 'cart-weight-for-woocommerce' ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-conditional-product-fees-checkout/" ); ?>">
						<?php esc_html_e( 'Conditional Product Fees For WooCommerce Checkout', 'cart-weight-for-woocommerce' ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Advance-Menu-Manager-For-WordPress.png' ); ?>" alt="<?php esc_attr_e( 'Advance Menu Manager For WordPress', 'cart-weight-for-woocommerce' ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/advance-menu-manager-wordpress/" ); ?>">
						<?php esc_html_e( 'Advance Menu Manager For WordPress', 'cart-weight-for-woocommerce' ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Enhanced-Ecommerce-Google-Analytics-For-WooCommerce.png' ); ?>" alt="<?php esc_attr_e( 'Enhanced Ecommerce Google Analytics for WooCommerce', 'cart-weight-for-woocommerce' ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-enhanced-ecommerce-analytics-integration-with-conversion-tracking" ); ?>">
						<?php esc_html_e( 'Enhanced Ecommerce Google Analytics for WooCommerce', 'cart-weight-for-woocommerce' ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/WooCommerce-Blocker-Prevent-Fake-Orders.png' ); ?>" alt="<?php esc_attr_e( 'WooCommerce Blocker – Prevent Fake Orders', 'cart-weight-for-woocommerce' ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/product/woocommerce-blocker-lite-prevent-fake-orders-blacklist-fraud-customers/" ); ?>">
						<?php esc_html_e( 'WooCommerce Blocker – Prevent Fake Orders', 'cart-weight-for-woocommerce' ); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div class="view-button">
            <a class="view_button_dotstore" href="<?php echo esc_url( "http://www.thedotstore.com/plugins/" ); ?>"  target="_blank"><?php esc_html_e( 'View All', 'cart-weight-for-woocommerce' ); ?></a>
        </div>
    </div>
</div>
</div>
</body>
</html>