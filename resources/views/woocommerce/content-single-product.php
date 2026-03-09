<?php

/**
 * WooCommerce Template Override: content-single-product.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see content-single-product.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.content-single-product', get_defined_vars())->render();
