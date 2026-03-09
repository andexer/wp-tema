<?php

/**
 * WooCommerce Template Override: loop/orderby.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see loop/orderby.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.loop.orderby', get_defined_vars())->render();
