<?php

/**
 * WooCommerce Template Override: global/form-login.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see global/form-login.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.global.form-login', get_defined_vars())->render();
