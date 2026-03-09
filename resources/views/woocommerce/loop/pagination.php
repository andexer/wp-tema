<?php

/**
 * WooCommerce Template Override: loop/pagination.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/pagination.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.pagination', get_defined_vars())->render();
