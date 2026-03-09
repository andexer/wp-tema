<?php

/**
 * WooCommerce Template Override: myaccount/orders.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/orders.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.orders', get_defined_vars())->render();
