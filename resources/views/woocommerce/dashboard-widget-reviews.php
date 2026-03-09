<?php

/**
 * WooCommerce Template Override: dashboard-widget-reviews.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see dashboard-widget-reviews.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.dashboard-widget-reviews', get_defined_vars())->render();
