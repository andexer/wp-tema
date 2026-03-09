<?php

/**
 * WooCommerce Template Override: single-product/rating.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/rating.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.rating', get_defined_vars())->render();
