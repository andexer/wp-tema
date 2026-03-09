<?php

/**
 * WooCommerce Template Override: brands/brand-description.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see brands/brand-description.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.brands.brand-description', get_defined_vars())->render();
