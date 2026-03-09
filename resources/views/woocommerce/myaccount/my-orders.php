<?php

/**
 * WooCommerce Template Override: myaccount/my-orders.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/my-orders.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.my-orders', get_defined_vars())->render();
