<?php
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="cwfw-section-left">
    <div class="cwfw-table-main res-cl">
        <h2><?php esc_html_e('Quick info',  'cart-weight-for-woocommerce') ?></h2>
        <table class="cwfw-tableouter">
            <tbody>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Product Type',  'cart-weight-for-woocommerce') ?></td>
                    <td class="fr-2"><?php esc_html_e('WordPress Plugin',  'cart-weight-for-woocommerce') ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Product Name',  'cart-weight-for-woocommerce') ?></td>
                    <td class="fr-2"><?php echo esc_html(CWFW_PLUGIN_NAME); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Installed Version',  'cart-weight-for-woocommerce') ?></td>
                    <td class="fr-2"><?php echo esc_html(CWFW_PLUGIN_VERSION); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('License & Terms of use',  'cart-weight-for-woocommerce') ?></td>
                    <td class="fr-2"><a href="https://www.thedotstore.com/terms-and-conditions/"><?php esc_html_e('Click here',  'cart-weight-for-woocommerce') ?></a><?php esc_html_e(' to view license and terms of use.',  'cart-weight-for-woocommerce') ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Help & Support',  'cart-weight-for-woocommerce') ?></td>
                    <td class="fr-2">
                        <ul class="help-support">
                            <li><a target="_blank" href="<?php echo esc_url(site_url('wp-admin/admin.php?page=cart_weight_for_woocommerce&tab=cwfw-plugin-getting-started'));
                            ?>"><?php esc_html_e('Quick Start Guide',  'cart-weight-for-woocommerce') ?></a></li>
                            <li><a target="_blank" href="<?php echo esc_url('#'); ?>"><?php esc_html_e('Documentation',  'cart-weight-for-woocommerce') ?></a>
                            </li>
                            <li><a target="_blank" href="https://www.thedotstore.com/support/"><?php esc_html_e('Support Forum',  'cart-weight-for-woocommerce') ?></a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Localization',  'cart-weight-for-woocommerce') ?></td>
                    <td class="fr-2"><?php esc_html_e('English',  'cart-weight-for-woocommerce') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>