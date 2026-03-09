<?php

/**
 * WooCommerce Template Override: loop/result-count.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/result-count.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.result-count', get_defined_vars())->render();
