<?php

/**
 * WooCommerce Template Override: cart/cart-shipping.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/cart-shipping.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.cart-shipping', get_defined_vars())->render();
