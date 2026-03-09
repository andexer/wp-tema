<?php

/**
 * WooCommerce Template Override: brands/widgets/brand-thumbnails-description.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see brands/widgets/brand-thumbnails-description.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.brands.widgets.brand-thumbnails-description', get_defined_vars())->render();
