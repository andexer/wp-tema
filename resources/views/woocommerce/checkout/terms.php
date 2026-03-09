<?php

/**
 * WooCommerce Template Override: checkout/terms.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see checkout/terms.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.checkout.terms', get_defined_vars())->render();
