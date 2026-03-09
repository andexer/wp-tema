<?php

/**
 * WooCommerce Template Override: notices/success.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see notices/success.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.notices.success', get_defined_vars())->render();
