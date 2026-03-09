<?php

/**
 * WooCommerce Template Override: single-product/review.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/review.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.review', get_defined_vars())->render();
