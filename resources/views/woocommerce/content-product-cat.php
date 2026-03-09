<?php

/**
 * WooCommerce Template Override: content-product-cat.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see content-product-cat.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.content-product-cat', get_defined_vars())->render();
