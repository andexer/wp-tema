<?php

/**
 * WooCommerce Template Override: order/order-details-customer.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/order-details-customer.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.order-details-customer', get_defined_vars())->render();
