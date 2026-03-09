<?php

/**
 * WooCommerce Template Override: loop/price.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/price.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.price', get_defined_vars())->render();
