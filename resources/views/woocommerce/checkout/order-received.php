<?php

/**
 * WooCommerce Template Override: checkout/order-received.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/order-received.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.order-received', get_defined_vars())->render();
