<?php

/**
 * WooCommerce Template Override: order/form-tracking.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see order/form-tracking.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.order.form-tracking', get_defined_vars())->render();
