<?php

/**
 * WooCommerce Template Override: taxonomy-product-tag.php
 *
 * Este archivo sirve como puente para que WooCommerce detecte el override.
 * El renderizado real se delega a la plantilla Blade.
 *
 * @see taxonomy-product-tag.php
 */

defined('ABSPATH') || exit;

echo view('woocommerce.taxonomy-product-tag', get_defined_vars())->render();
