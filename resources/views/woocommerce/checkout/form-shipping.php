<?php

/**
 * WooCommerce Template Override: checkout/form-shipping.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-shipping.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-shipping', get_defined_vars())->render();
