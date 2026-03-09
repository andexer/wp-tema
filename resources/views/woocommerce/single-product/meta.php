<?php

/**
 * WooCommerce Template Override: single-product/meta.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/meta.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.meta', get_defined_vars())->render();
