<?php

/**
 * WooCommerce Template Override: single-product/up-sells.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/up-sells.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.up-sells', get_defined_vars())->render();
