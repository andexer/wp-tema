<?php

/**
 * WooCommerce Template Override: single-product/product-attributes.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/product-attributes.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.product-attributes', get_defined_vars())->render();
