<?php

/**
 * WooCommerce Template Override: myaccount/form-lost-password.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/form-lost-password.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.form-lost-password', get_defined_vars())->render();
