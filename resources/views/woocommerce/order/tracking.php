<?php

/**
 * WooCommerce Template Override: order/tracking.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/tracking.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.tracking', get_defined_vars())->render();
