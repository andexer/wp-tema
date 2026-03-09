<?php

/**
 * WooCommerce Template Override: checkout/payment.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/payment.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.payment', get_defined_vars())->render();
