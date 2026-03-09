<?php

/**
 * WooCommerce Template Override: order/order-details.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/order-details.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.order-details', get_defined_vars())->render();
