<?php

/**
 * WooCommerce Template Override: content-widget-price-filter.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see content-widget-price-filter.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.content-widget-price-filter', get_defined_vars())->render();
