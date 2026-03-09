<?php

/**
 * WooCommerce Template Override: single-product/add-to-cart/simple.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/add-to-cart/simple.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.add-to-cart.simple', get_defined_vars())->render();
