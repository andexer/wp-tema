<?php

/**
 * WooCommerce Template Override: order/attribution-details.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/attribution-details.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.attribution-details', get_defined_vars())->render();
