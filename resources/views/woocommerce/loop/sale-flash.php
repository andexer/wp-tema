<?php

/**
 * WooCommerce Template Override: loop/sale-flash.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/sale-flash.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.sale-flash', get_defined_vars())->render();
