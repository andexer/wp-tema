<?php

/**
 * WooCommerce Template Override: cart/proceed-to-checkout-button.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/proceed-to-checkout-button.blade.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.proceed-to-checkout-button', get_defined_vars())->render();
