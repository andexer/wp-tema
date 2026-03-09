<?php

/**
 * WooCommerce Template Override: checkout/cart-errors.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/cart-errors.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.cart-errors', get_defined_vars())->render();
