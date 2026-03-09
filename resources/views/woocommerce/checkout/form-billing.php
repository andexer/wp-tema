<?php

/**
 * WooCommerce Template Override: checkout/form-billing.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-billing.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-billing', get_defined_vars())->render();
