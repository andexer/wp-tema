<?php

/**
 * WooCommerce Template Override: single-product/product-thumbnails.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/product-thumbnails.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.product-thumbnails', get_defined_vars())->render();
