<?php

/**
 * WooCommerce Template Override: auth/header.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see auth/header.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.auth.header', get_defined_vars())->render();
