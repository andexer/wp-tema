<?php

/**
 * WooCommerce Template Override: taxonomy-product-attribute.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see taxonomy-product-attribute.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.taxonomy-product-attribute', get_defined_vars())->render();
