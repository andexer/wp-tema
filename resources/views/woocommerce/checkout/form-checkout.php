<?php

/**
 * WooCommerce Template Override: checkout/form-checkout.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-checkout.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-checkout', get_defined_vars())->render();
