<?php

/**
 * WooCommerce Template Override: single-product/sale-flash.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/sale-flash.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.sale-flash', get_defined_vars())->render();
