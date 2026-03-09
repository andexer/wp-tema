<?php

/**
 * WooCommerce Template Override: checkout/order-receipt.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/order-receipt.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.order-receipt', get_defined_vars())->render();
