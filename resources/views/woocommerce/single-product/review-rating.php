<?php

/**
 * WooCommerce Template Override: single-product/review-rating.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/review-rating.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.review-rating', get_defined_vars())->render();
