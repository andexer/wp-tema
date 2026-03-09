<?php

/**
 * WooCommerce Template Override: taxonomy-product-cat.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see taxonomy-product-cat.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.taxonomy-product-cat', get_defined_vars())->render();
