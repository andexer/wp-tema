<?php

/**
 * WooCommerce Template Override: loop/no-products-found.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/no-products-found.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.no-products-found', get_defined_vars())->render();
