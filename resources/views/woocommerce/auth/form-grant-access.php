<?php

/**
 * WooCommerce Template Override: auth/form-grant-access.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see auth/form-grant-access.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.auth.form-grant-access', get_defined_vars())->render();
