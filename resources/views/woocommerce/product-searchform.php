<?php

/**
 * WooCommerce Template Override: product-searchform.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see product-searchform.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.product-searchform', get_defined_vars())->render();
