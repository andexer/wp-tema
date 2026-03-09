<?php

/**
 * WooCommerce Template Override: loop/loop-start.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/loop-start.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.loop-start', get_defined_vars())->render();
