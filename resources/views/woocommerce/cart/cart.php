<?php

/**
 * WooCommerce Template Override: cart/cart.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/cart.blade.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.cart', get_defined_vars())->render();
