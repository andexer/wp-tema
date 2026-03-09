<?php

/**
 * WooCommerce Template Override: block-notices/error.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see block-notices/error.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.block-notices.error', get_defined_vars())->render();
