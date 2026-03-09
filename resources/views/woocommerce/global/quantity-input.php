<?php

/**
 * WooCommerce Template Override: global/quantity-input.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see global/quantity-input.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.global.quantity-input', get_defined_vars())->render();
