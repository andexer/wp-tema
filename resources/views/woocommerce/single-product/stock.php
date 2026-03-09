<?php

/**
 * WooCommerce Template Override: single-product/stock.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/stock.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.stock', get_defined_vars())->render();
