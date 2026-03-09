<?php

/**
 * WooCommerce Template Override: myaccount/form-edit-address.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see myaccount/form-edit-address.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.myaccount.form-edit-address', get_defined_vars())->render();
