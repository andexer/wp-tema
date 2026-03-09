<?php

/**
 * WooCommerce Template Override: myaccount/navigation.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/navigation.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.navigation', get_defined_vars())->render();
