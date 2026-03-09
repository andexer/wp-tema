<?php

/**
 * WooCommerce Template Override: archive-product.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see archive-product.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.archive-product', get_defined_vars())->render();
