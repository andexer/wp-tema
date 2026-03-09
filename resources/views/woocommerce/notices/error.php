<?php

/**
 * WooCommerce Template Override: notices/error.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see notices/error.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.notices.error', get_defined_vars())->render();
