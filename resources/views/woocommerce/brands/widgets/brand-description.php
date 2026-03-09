<?php

/**
 * WooCommerce Template Override: brands/widgets/brand-description.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see brands/widgets/brand-description.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.brands.widgets.brand-description', get_defined_vars())->render();
