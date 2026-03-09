<?php

/**
 * WooCommerce Template Override: single-product/back-in-stock-form.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see single-product/back-in-stock-form.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.single-product.back-in-stock-form', get_defined_vars())->render();
