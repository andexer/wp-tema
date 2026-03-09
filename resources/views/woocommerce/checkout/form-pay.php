<?php

/**
 * WooCommerce Template Override: checkout/form-pay.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-pay.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-pay', get_defined_vars())->render();
