<?php

/**
 * WooCommerce Template Override: block-notices/success.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see block-notices/success.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.block-notices.success', get_defined_vars())->render();
