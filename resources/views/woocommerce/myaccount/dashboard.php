<?php

/**
 * WooCommerce Template Override: myaccount/dashboard.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/dashboard.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.dashboard', get_defined_vars())->render();
