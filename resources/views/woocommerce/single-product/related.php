<?php

/**
 * WooCommerce Template Override: single-product/related.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/related.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.related', get_defined_vars())->render();
