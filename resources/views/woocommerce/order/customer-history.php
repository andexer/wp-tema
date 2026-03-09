<?php

/**
 * WooCommerce Template Override: order/customer-history.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/customer-history.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.customer-history', get_defined_vars())->render();
