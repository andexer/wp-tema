<?php

/**
 * WooCommerce Template Override: brands/taxonomy-product_brand.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see brands/taxonomy-product_brand.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.brands.taxonomy-product_brand', get_defined_vars())->render();
