<?php

/**
 * WooCommerce Template Override: myaccount/form-add-payment-method.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/form-add-payment-method.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.form-add-payment-method', get_defined_vars())->render();
