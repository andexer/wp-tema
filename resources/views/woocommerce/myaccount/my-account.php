<?php

/**
 * WooCommerce Template Override: myaccount/my-account.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/my-account.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.my-account', get_defined_vars())->render();
