<?php

/**
 * WooCommerce Template Override: order/order-again.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/order-again.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.order-again', get_defined_vars())->render();
