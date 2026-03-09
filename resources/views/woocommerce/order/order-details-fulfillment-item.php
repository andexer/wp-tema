<?php

/**
 * WooCommerce Template Override: order/order-details-fulfillment-item.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/order-details-fulfillment-item.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.order-details-fulfillment-item', get_defined_vars())->render();
