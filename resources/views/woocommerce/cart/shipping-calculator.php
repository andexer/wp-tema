<?php

/**
 * WooCommerce Template Override: cart/shipping-calculator.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see cart/shipping-calculator.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.cart.shipping-calculator', get_defined_vars())->render();
