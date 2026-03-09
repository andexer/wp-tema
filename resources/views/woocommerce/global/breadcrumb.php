<?php

/**
 * WooCommerce Template Override: global/breadcrumb.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see global/breadcrumb.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.global.breadcrumb', get_defined_vars())->render();
