<?php

/**
 * WooCommerce Template Override: myaccount/my-address.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/my-address.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.my-address', get_defined_vars())->render();
