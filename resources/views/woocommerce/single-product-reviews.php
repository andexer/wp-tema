<?php

/**
 * WooCommerce Template Override: single-product-reviews.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product-reviews.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product-reviews', get_defined_vars())->render();
