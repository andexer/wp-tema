<?php

/**
 * WooCommerce Template Override: cart/mini-cart.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/mini-cart.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.mini-cart', get_defined_vars())->render();
