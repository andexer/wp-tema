<?php

/**
 * WooCommerce Template Override: order/order-details-fulfillments.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/order-details-fulfillments.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.order-details-fulfillments', get_defined_vars())->render();
