<?php

/**
 * WooCommerce Template Override: single-product/review-meta.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/review-meta.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.review-meta', get_defined_vars())->render();
