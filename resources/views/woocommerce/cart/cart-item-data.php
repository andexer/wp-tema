<?php

/**
 * WooCommerce Template Override: cart/cart-item-data.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/cart-item-data.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.cart-item-data', get_defined_vars())->render();
