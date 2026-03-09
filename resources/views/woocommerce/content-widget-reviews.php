<?php

/**
 * WooCommerce Template Override: content-widget-reviews.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see content-widget-reviews.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.content-widget-reviews', get_defined_vars())->render();
