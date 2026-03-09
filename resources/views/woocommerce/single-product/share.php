<?php

/**
 * WooCommerce Template Override: single-product/share.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/share.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.share', get_defined_vars())->render();
