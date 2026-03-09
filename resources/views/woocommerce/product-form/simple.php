<?php

/**
 * WooCommerce Template Override: product-form/simple.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see product-form/simple.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.product-form.simple', get_defined_vars())->render();
