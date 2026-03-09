<?php

/**
 * WooCommerce Template Override: brands/shortcodes/brands-a-z.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see brands/shortcodes/brands-a-z.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.brands.shortcodes.brands-a-z', get_defined_vars())->render();
