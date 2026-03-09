<?php

/**
 * WooCommerce Template Override: myaccount/form-edit-account.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/form-edit-account.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.form-edit-account', get_defined_vars())->render();
