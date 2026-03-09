<?php

/**
 * WooCommerce Template Override: cart/cart-empty.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/cart-empty.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.cart-empty', get_defined_vars())->render();
