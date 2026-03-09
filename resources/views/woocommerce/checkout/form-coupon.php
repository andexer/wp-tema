<?php

/**
 * WooCommerce Template Override: checkout/form-coupon.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/form-coupon.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.form-coupon', get_defined_vars())->render();
