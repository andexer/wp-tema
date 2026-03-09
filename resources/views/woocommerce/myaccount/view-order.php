<?php

/**
 * WooCommerce Template Override: myaccount/view-order.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/view-order.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.view-order', get_defined_vars())->render();
