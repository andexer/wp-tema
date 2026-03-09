<?php

/**
 * WooCommerce Template Override: auth/form-login.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see auth/form-login.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.auth.form-login', get_defined_vars())->render();
