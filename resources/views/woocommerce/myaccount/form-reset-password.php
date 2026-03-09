<?php

/**
 * WooCommerce Template Override: myaccount/form-reset-password.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/form-reset-password.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.form-reset-password', get_defined_vars())->render();
