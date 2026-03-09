<?php

/**
 * WooCommerce Template Override: single-product/short-description.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/short-description.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.short-description', get_defined_vars())->render();
