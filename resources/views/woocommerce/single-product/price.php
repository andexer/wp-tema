<?php

/**
 * WooCommerce Template Override: single-product/price.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/price.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.price', get_defined_vars())->render();
