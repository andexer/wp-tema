<?php

/**
 * WooCommerce Template Override: global/wrapper-end.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see global/wrapper-end.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.global.wrapper-end', get_defined_vars())->render();
