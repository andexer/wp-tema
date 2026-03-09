<?php

/**
 * WooCommerce Template Override: checkout/payment-method.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/payment-method.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.payment-method', get_defined_vars())->render();
