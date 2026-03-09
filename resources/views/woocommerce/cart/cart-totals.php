<?php

/**
 * WooCommerce Template Override: cart/cart-totals.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/cart-totals.blade.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.cart-totals', get_defined_vars())->render();
