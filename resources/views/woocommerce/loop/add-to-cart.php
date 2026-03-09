<?php

/**
 * WooCommerce Template Override: loop/add-to-cart.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/add-to-cart.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.add-to-cart', get_defined_vars())->render();
