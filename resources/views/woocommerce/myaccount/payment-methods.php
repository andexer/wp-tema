<?php

/**
 * WooCommerce Template Override: myaccount/payment-methods.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/payment-methods.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.payment-methods', get_defined_vars())->render();
