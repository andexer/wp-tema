<?php

/**
 * WooCommerce Template Override: order/order-downloads.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/order-downloads.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.order-downloads', get_defined_vars())->render();
