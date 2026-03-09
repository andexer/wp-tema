<?php

/**
 * WooCommerce Template Override: single-product/title.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/title.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.title', get_defined_vars())->render();
