<?php

/**
 * WooCommerce Template Override: checkout/form-verify-email.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-verify-email.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-verify-email', get_defined_vars())->render();
