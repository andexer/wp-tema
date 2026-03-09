<?php

/**
 * WooCommerce Template Override: global/wrapper-start.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see global/wrapper-start.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.global.wrapper-start', get_defined_vars())->render();
