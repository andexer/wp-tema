<?php

/**
 * WooCommerce Template Override: cart/cross-sells.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/cross-sells.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.cross-sells', get_defined_vars())->render();
