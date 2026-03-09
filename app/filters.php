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
