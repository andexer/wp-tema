<?php

/**
 * WooCommerce Template Override: loop/rating.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/rating.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.rating', get_defined_vars())->render();
