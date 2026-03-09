<?php

/**
 * WooCommerce Template Override: checkout/form-login.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-login.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-login', get_defined_vars())->render();
