<?php

/**
 * WooCommerce Template Override: loop/header.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/header.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.header', get_defined_vars())->render();
