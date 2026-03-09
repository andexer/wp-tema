<?php

/**
 * WooCommerce Template Override: global/sidebar.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see global/sidebar.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.global.sidebar', get_defined_vars())->render();
