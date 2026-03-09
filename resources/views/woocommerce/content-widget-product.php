<?php

/**
 * WooCommerce Template Override: content-widget-product.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see content-widget-product.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.content-widget-product', get_defined_vars())->render();
