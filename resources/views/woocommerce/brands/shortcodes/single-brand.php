<?php

/**
 * WooCommerce Template Override: brands/shortcodes/single-brand.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see brands/shortcodes/single-brand.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.brands.shortcodes.single-brand', get_defined_vars())->render();
