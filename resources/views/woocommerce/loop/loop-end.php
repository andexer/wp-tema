<?php

/**
 * WooCommerce Template Override: loop/loop-end.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/loop-end.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.loop-end', get_defined_vars())->render();
