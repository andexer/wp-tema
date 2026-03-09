<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
	return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Change the default WooCommerce template path to `resources/views/woocommerce/`.
 * This allows keeping dummy PHP files alongside Blade views instead of cluttering the theme root.
 *
 * @return string
 */
add_filter('woocommerce_template_path', function () {
	return 'resources/views/woocommerce/';
});

/**
 * Force theme templates over plugins (like WP Marketplace Split Order).
 * The split order plugin hijacks `checkout/thankyou.php` and `order/order-details.php`.
 * We use priority 99 to ensure our Blade overrides always load for these specific files.
 *
 * @param string $located       The current located template.
 * @param string $template_name The template name.
 * @return string
 */
add_filter('wc_get_template', function ($located, $template_name) {
	// Only intercept templates known to be hijacked by the marketplace plugin
	$hijacked_templates = [
		'checkout/thankyou.php',
		'order/order-details.php',
	];

	if (in_array($template_name, $hijacked_templates)) {
		$theme_template = locate_template('resources/views/woocommerce/' . $template_name);
		if ($theme_template) {
			return $theme_template;
		}
	}
	return $located;
}, 99, 2);
